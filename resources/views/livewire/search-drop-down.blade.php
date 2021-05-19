<div class="header-actions search-bar">
    <!-- INTERACTIVE INPUT -->
    <div class="interactive-input dark">
      <input wire:model.debounce.500m="search" type="text" id="search-main" name="search_main" placeholder="Search here for people or groups">
      <!-- INTERACTIVE INPUT ICON WRAP -->
      <div class="interactive-input-icon-wrap">
        <!-- INTERACTIVE INPUT ICON -->
        <svg class="interactive-input-icon icon-magnifying-glass">
          <use xlink:href="#svg-magnifying-glass"></use>
        </svg>
        <!-- /INTERACTIVE INPUT ICON -->
      </div>
      <!-- /INTERACTIVE INPUT ICON WRAP -->

      <!-- INTERACTIVE INPUT ACTION -->
      <div class="interactive-input-action">
        <!-- INTERACTIVE INPUT ACTION ICON -->
        <svg class="interactive-input-action-icon icon-cross-thin">
          <use xlink:href="#svg-cross-thin"></use>
        </svg>
        <!-- /INTERACTIVE INPUT ACTION ICON -->
      </div>
      <!-- /INTERACTIVE INPUT ACTION -->
    </div>
    <!-- /INTERACTIVE INPUT -->

    <!-- DROPDOWN BOX -->
    @if (count($searchResults) > 0)
    <div class="dropdown-box padding-bottom-small header-search-dropdown" style="width: 30%;position: absolute;top:70px;">
        <!-- DROPDOWN BOX CATEGORY -->
        <div class="dropdown-box-category">
          <!-- DROPDOWN BOX CATEGORY TITLE -->
          <p class="dropdown-box-category-title">{{ transWord('Search Results').' ('.$search.')' }}</p>
          <!-- /DROPDOWN BOX CATEGORY TITLE -->
        </div>
        <!-- /DROPDOWN BOX CATEGORY -->

        <!-- DROPDOWN BOX LIST -->
        <div class="dropdown-box-list small no-scroll">

          @foreach ($searchResults as $user)
          <a class="dropdown-box-list-item" href="{{ route('profile_users',$user->username) }}" title="{{ transWord('View Profile') }}">
              <!-- USER STATUS -->
              <div class="user-status notification">
                <!-- USER STATUS AVATAR -->
                <div class="user-status-avatar">
                  <!-- USER AVATAR -->
                  <div class="user-avatar small no-outline">
                    <!-- USER AVATAR CONTENT -->
                    <div class="user-avatar-content">
                      <!-- HEXAGON -->
                      <img class="hexagon-image-30-32" style="width: 100%; border-radius: 24%;" src="{{ asset(getUserAvatar($user->id)) }}">
                      <!-- /HEXAGON -->
                    </div>
                    <!-- /USER AVATAR CONTENT -->


                  </div>
                  <!-- /USER AVATAR -->
                </div>
                <!-- /USER STATUS AVATAR -->

                <!-- USER STATUS TITLE -->
                <p class="user-status-title"><span class="bold">{{ $user->name }}</span></p>
                <!-- /USER STATUS TITLE -->

                <!-- USER STATUS TEXT -->
                <p class="user-status-text">
                    @if (checkIsFriend($user->id) == 'firend')
                        <span style="color: green">Following</span>
                    @else
                        <span style="color: red">Not Following</span>
                    @endif
                </p>
                <!-- /USER STATUS TEXT -->

                <!-- USER STATUS ICON -->
                <div class="user-status-icon">
                  <!-- ICON FRIEND -->
                  <svg class="icon-add-friend" title="{{ transWord('Add Friend') }}">
                    <use xlink:href="#svg-add-friend"></use>
                  </svg>
                  <!-- /ICON FRIEND -->
                </div>
                <!-- /USER STATUS ICON -->
              </div>
              <!-- /USER STATUS -->
            </a>
          @endforeach

          <a class="dropdown-box-list-item" href="profile-timeline.html" style="text-align: center; font-size: 20px; font-weight: bold;">
              +{{ transWord("More") }}
          </a>


        </div>
        <!-- /DROPDOWN BOX LIST -->


    </div>

    @endif
    <!-- /DROPDOWN BOX -->
  </div>
