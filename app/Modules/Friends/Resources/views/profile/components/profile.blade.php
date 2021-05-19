<!-- PROFILE HEADER -->
<div class="profile-header">
    <!-- PROFILE HEADER COVER -->
    <figure class="profile-header-cover liquid" style="background: url({{ asset('dento/img/dentist.jpg') }}) center center / cover no-repeat;">
      <img src="{{ asset('dento/img/dentist.jpg') }}" alt="cover-01" style="display: none;">
    </figure>
    <!-- /PROFILE HEADER COVER -->

    <!-- PROFILE HEADER INFO -->
    <div class="profile-header-info">
      <!-- USER SHORT DESCRIPTION -->
      <div class="user-short-description big">
        <!-- USER SHORT DESCRIPTION AVATAR -->
        <a class="user-short-description-avatar user-avatar big" href="profile-timeline.html">
          <!-- USER AVATAR BORDER -->
          <div class="user-avatar-border">
            <!-- HEXAGON -->
            <div class="hexagon-148-164" style="width: 148px; height: 164px; position: relative;"><canvas width="148" height="164" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
            <!-- /HEXAGON -->
          </div>
          <!-- /USER AVATAR BORDER -->

          <!-- USER AVATAR CONTENT -->
          <div class="user-avatar-content">
            <!-- HEXAGON -->
          @if ($doctor->user->gender == 'Male')
          <div class="hexagon-image-100-110" data-src="{{ asset('dento/img/avatar/doctor_male.png') }}" style="width: 100px; height: 110px; position: relative;"><canvas width="100" height="110" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
          @else
          <div class="hexagon-image-100-110" data-src="{{ asset('dento/img/avatar/doctor_female.png') }}" style="width: 100px; height: 110px; position: relative;"><canvas width="100" height="110" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
          @endif
            <!-- /HEXAGON -->
          </div>
          <!-- /USER AVATAR CONTENT -->

          <!-- USER AVATAR PROGRESS -->
          <div class="user-avatar-progress">
            <!-- HEXAGON -->
            <div class="hexagon-progress-124-136" style="width: 124px; height: 136px; position: relative;"><canvas width="124" height="136" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
            <!-- /HEXAGON -->
          </div>
          <!-- /USER AVATAR PROGRESS -->

          <!-- USER AVATAR PROGRESS BORDER -->
          <div class="user-avatar-progress-border">
            <!-- HEXAGON -->
            <div class="hexagon-border-124-136" style="width: 124px; height: 136px; position: relative;"><canvas width="124" height="136" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
            <!-- /HEXAGON -->
          </div>
          <!-- /USER AVATAR PROGRESS BORDER -->

          <!-- USER AVATAR BADGE -->
          <div class="user-avatar-badge">
            <!-- USER AVATAR BADGE BORDER -->
            <div class="user-avatar-badge-border">
              <!-- HEXAGON -->
              <div class="hexagon-40-44" style="width: 40px; height: 44px; position: relative;"><canvas width="40" height="44" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
              <!-- /HEXAGON -->
            </div>
            <!-- /USER AVATAR BADGE BORDER -->

            <!-- USER AVATAR BADGE CONTENT -->
            <div class="user-avatar-badge-content">
              <!-- HEXAGON -->
              <div class="hexagon-dark-32-34" style="width: 32px; height: 34px; position: relative;"><canvas width="32" height="34" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
              <!-- /HEXAGON -->
            </div>
            <!-- /USER AVATAR BADGE CONTENT -->

            <!-- USER AVATAR BADGE TEXT -->
            <p class="user-avatar-badge-text">24</p>
            <!-- /USER AVATAR BADGE TEXT -->
          </div>
          <!-- /USER AVATAR BADGE -->
        </a>
        <!-- /USER SHORT DESCRIPTION AVATAR -->

        <!-- USER SHORT DESCRIPTION AVATAR -->
        <a class="user-short-description-avatar user-short-description-avatar-mobile user-avatar medium" href="profile-timeline.html">
          <!-- USER AVATAR BORDER -->
          <div class="user-avatar-border">
            <!-- HEXAGON -->
            <div class="hexagon-120-132" style="width: 120px; height: 132px; position: relative;"><canvas width="120" height="132" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
            <!-- /HEXAGON -->
          </div>
          <!-- /USER AVATAR BORDER -->

          <!-- USER AVATAR CONTENT -->
          <div class="user-avatar-content">
            <!-- HEXAGON -->
            <div class="hexagon-image-82-90" data-src="img/avatar/01.jpg" style="width: 82px; height: 90px; position: relative;"><canvas width="82" height="90" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
            <!-- /HEXAGON -->
          </div>
          <!-- /USER AVATAR CONTENT -->

          <!-- USER AVATAR PROGRESS -->
          <div class="user-avatar-progress">
            <!-- HEXAGON -->
            <div class="hexagon-progress-100-110" style="width: 100px; height: 110px; position: relative;"><canvas width="100" height="110" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
            <!-- /HEXAGON -->
          </div>
          <!-- /USER AVATAR PROGRESS -->

          <!-- USER AVATAR PROGRESS BORDER -->
          <div class="user-avatar-progress-border">
            <!-- HEXAGON -->
            <div class="hexagon-border-100-110" style="width: 100px; height: 110px; position: relative;"><canvas width="100" height="110" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
            <!-- /HEXAGON -->
          </div>
          <!-- /USER AVATAR PROGRESS BORDER -->

          <!-- USER AVATAR BADGE -->
          <div class="user-avatar-badge">
            <!-- USER AVATAR BADGE BORDER -->
            <div class="user-avatar-badge-border">
              <!-- HEXAGON -->
              <div class="hexagon-32-36" style="width: 32px; height: 36px; position: relative;"><canvas width="32" height="36" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
              <!-- /HEXAGON -->
            </div>
            <!-- /USER AVATAR BADGE BORDER -->

            <!-- USER AVATAR BADGE CONTENT -->
            <div class="user-avatar-badge-content">
              <!-- HEXAGON -->
              <div class="hexagon-dark-26-28" style="width: 26px; height: 28px; position: relative;"><canvas width="26" height="28" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
              <!-- /HEXAGON -->
            </div>
            <!-- /USER AVATAR BADGE CONTENT -->

            <!-- USER AVATAR BADGE TEXT -->
            <p class="user-avatar-badge-text">24</p>
            <!-- /USER AVATAR BADGE TEXT -->
          </div>
          <!-- /USER AVATAR BADGE -->
        </a>
        <!-- /USER SHORT DESCRIPTION AVATAR -->

        <!-- USER SHORT DESCRIPTION TITLE -->
        <p class="user-short-description-title"><a href="profile-timeline.html">{{ $doctor->user->name }}</a></p>
        <!-- /USER SHORT DESCRIPTION TITLE -->

        <!-- USER SHORT DESCRIPTION TEXT -->
        <p class="user-short-description-text"><a href="#">{{ '@'.$doctor->user->username }}</a></p>
        <!-- /USER SHORT DESCRIPTION TEXT -->
      </div>
      <!-- /USER SHORT DESCRIPTION -->



      <!-- USER STATS -->
      <div class="user-stats">
        <!-- USER STAT -->
        <div class="user-stat big">
          <!-- USER STAT TITLE -->
          <p class="user-stat-title">930</p>
          <!-- /USER STAT TITLE -->

          <!-- USER STAT TEXT -->
          <p class="user-stat-text">posts</p>
          <!-- /USER STAT TEXT -->
        </div>
        <!-- /USER STAT -->

        <!-- USER STAT -->
        <div class="user-stat big">
          <!-- USER STAT TITLE -->
          <p class="user-stat-title">82</p>
          <!-- /USER STAT TITLE -->

          <!-- USER STAT TEXT -->
          <p class="user-stat-text">friends</p>
          <!-- /USER STAT TEXT -->
        </div>
        <!-- /USER STAT -->

        <!-- USER STAT -->
        <div class="user-stat big">
          <!-- USER STAT TITLE -->
          <p class="user-stat-title">5.7k</p>
          <!-- /USER STAT TITLE -->

          <!-- USER STAT TEXT -->
          <p class="user-stat-text">visits</p>
          <!-- /USER STAT TEXT -->
        </div>
        <!-- /USER STAT -->

        <!-- USER STAT -->

        <!-- /USER STAT -->
      </div>
      <!-- /USER STATS -->

      <!-- PROFILE HEADER INFO ACTIONS -->
      <div class="profile-header-info-actions">
        <!-- PROFILE HEADER INFO ACTION -->
        @if ($doctor->user->id != Auth::user()->id)
        <p class="profile-header-info-action button secondary"><span class="hide-text-mobile">Add</span> Friend +</p>
        @endif
        <!-- /PROFILE HEADER INFO ACTION -->

        <!-- PROFILE HEADER INFO ACTION -->
        <p class="profile-header-info-action button primary"><span class="hide-text-mobile">Send</span> Message</p>
        <!-- /PROFILE HEADER INFO ACTION -->
      </div>
      <!-- /PROFILE HEADER INFO ACTIONS -->
    </div>
    <!-- /PROFILE HEADER INFO -->
  </div>
  <!-- /PROFILE HEADER -->

  <!-- SECTION NAVIGATION -->
  <nav class="section-navigation">
    <!-- SECTION MENU -->
    <div class="tns-outer" id="section-navigation-slider-ow"><div class="tns-liveregion tns-visually-hidden" aria-live="polite" aria-atomic="true">slide <span class="current">1 to 9</span>  of 11</div><div id="section-navigation-slider-mw" class="tns-ovh"><div class="tns-inner" id="section-navigation-slider-iw"><div id="section-navigation-slider" class="section-menu  tns-slider tns-carousel tns-subpixel tns-calc tns-horizontal" style="transform: translate3d(0px, 0px, 0px);">
      <!-- SECTION MENU ITEM -->
      <a class="section-menu-item @yield('aboutme') tns-item tns-slide-active" href="{{ route('profile_doctors') }}" id="section-navigation-slider-item0">
        <!-- SECTION MENU ITEM ICON -->
        <svg class="section-menu-item-icon icon-profile">
          <use xlink:href="#svg-profile"></use>
        </svg>
        <!-- /SECTION MENU ITEM ICON -->

        <!-- SECTION MENU ITEM TEXT -->
        <p class="section-menu-item-text">{{ transWord('About') }}</p>
        <!-- /SECTION MENU ITEM TEXT -->
      </a>
      <!-- /SECTION MENU ITEM -->

      <!-- SECTION MENU ITEM -->
      <a class="section-menu-item @yield('cases') tns-item tns-slide-active" href="{{ route('cases_doctors') }}" id="section-navigation-slider-item1">
        <!-- SECTION MENU ITEM ICON -->
        <svg class="section-menu-item-icon icon-timeline">
          <use xlink:href="#svg-timeline"></use>
        </svg>
        <!-- /SECTION MENU ITEM ICON -->

        <!-- SECTION MENU ITEM TEXT -->
        <p class="section-menu-item-text">{{ transWord('Cases') }}</p>
        <!-- /SECTION MENU ITEM TEXT -->
      </a>
      <!-- /SECTION MENU ITEM -->

      <!-- SECTION MENU ITEM -->
      <a class="section-menu-item tns-item tns-slide-active" href="profile-friends.html" id="section-navigation-slider-item2">
        <!-- SECTION MENU ITEM ICON -->
        <svg class="section-menu-item-icon icon-friend">
          <use xlink:href="#svg-friend"></use>
        </svg>
        <!-- /SECTION MENU ITEM ICON -->

        <!-- SECTION MENU ITEM TEXT -->
        <p class="section-menu-item-text">Friends</p>
        <!-- /SECTION MENU ITEM TEXT -->
      </a>
      <!-- /SECTION MENU ITEM -->

      <!-- SECTION MENU ITEM -->
      <a class="section-menu-item tns-item tns-slide-active" href="profile-groups.html" id="section-navigation-slider-item3">
        <!-- SECTION MENU ITEM ICON -->
        <svg class="section-menu-item-icon icon-group">
          <use xlink:href="#svg-group"></use>
        </svg>
        <!-- /SECTION MENU ITEM ICON -->

        <!-- SECTION MENU ITEM TEXT -->
        <p class="section-menu-item-text">Groups</p>
        <!-- /SECTION MENU ITEM TEXT -->
      </a>
      <!-- /SECTION MENU ITEM -->

      <!-- SECTION MENU ITEM -->
      <a class="section-menu-item tns-item tns-slide-active" href="profile-photos.html" id="section-navigation-slider-item4">
        <!-- SECTION MENU ITEM ICON -->
        <svg class="section-menu-item-icon icon-photos">
          <use xlink:href="#svg-photos"></use>
        </svg>
        <!-- /SECTION MENU ITEM ICON -->

        <!-- SECTION MENU ITEM TEXT -->
        <p class="section-menu-item-text">Photos</p>
        <!-- /SECTION MENU ITEM TEXT -->
      </a>
      <!-- /SECTION MENU ITEM -->

      <!-- SECTION MENU ITEM -->
      <a class="section-menu-item tns-item tns-slide-active" href="profile-videos.html" id="section-navigation-slider-item5">
        <!-- SECTION MENU ITEM ICON -->
        <svg class="section-menu-item-icon icon-videos">
          <use xlink:href="#svg-videos"></use>
        </svg>
        <!-- /SECTION MENU ITEM ICON -->

        <!-- SECTION MENU ITEM TEXT -->
        <p class="section-menu-item-text">Videos</p>
        <!-- /SECTION MENU ITEM TEXT -->
      </a>
      <!-- /SECTION MENU ITEM -->

      <!-- SECTION MENU ITEM -->
      <a class="section-menu-item tns-item tns-slide-active" href="profile-badges.html" id="section-navigation-slider-item6">
        <!-- SECTION MENU ITEM ICON -->
        <svg class="section-menu-item-icon icon-badges">
          <use xlink:href="#svg-badges"></use>
        </svg>
        <!-- /SECTION MENU ITEM ICON -->

        <!-- SECTION MENU ITEM TEXT -->
        <p class="section-menu-item-text">Badges</p>
        <!-- /SECTION MENU ITEM TEXT -->
      </a>
      <!-- /SECTION MENU ITEM -->

      <!-- SECTION MENU ITEM -->
      <a class="section-menu-item tns-item tns-slide-active" href="profile-stream.html" id="section-navigation-slider-item7">
        <!-- SECTION MENU ITEM ICON -->
        <svg class="section-menu-item-icon icon-streams">
          <use xlink:href="#svg-streams"></use>
        </svg>
        <!-- /SECTION MENU ITEM ICON -->

        <!-- SECTION MENU ITEM TEXT -->
        <p class="section-menu-item-text">Streams</p>
        <!-- /SECTION MENU ITEM TEXT -->
      </a>
      <!-- /SECTION MENU ITEM -->

      <!-- SECTION MENU ITEM -->
      <a class="section-menu-item tns-item tns-slide-active" href="profile-blog.html" id="section-navigation-slider-item8">
        <!-- SECTION MENU ITEM ICON -->
        <svg class="section-menu-item-icon icon-blog-posts">
          <use xlink:href="#svg-blog-posts"></use>
        </svg>
        <!-- /SECTION MENU ITEM ICON -->

        <!-- SECTION MENU ITEM TEXT -->
        <p class="section-menu-item-text">Blog</p>
        <!-- /SECTION MENU ITEM TEXT -->
      </a>
      <!-- /SECTION MENU ITEM -->

      <!-- SECTION MENU ITEM -->
      <a class="section-menu-item tns-item" href="profile-forum.html" id="section-navigation-slider-item9" aria-hidden="true" tabindex="-1">
        <!-- SECTION MENU ITEM ICON -->
        <svg class="section-menu-item-icon icon-forum">
          <use xlink:href="#svg-forum"></use>
        </svg>
        <!-- /SECTION MENU ITEM ICON -->

        <!-- SECTION MENU ITEM TEXT -->
        <p class="section-menu-item-text">Forum</p>
        <!-- /SECTION MENU ITEM TEXT -->
      </a>
      <!-- /SECTION MENU ITEM -->

      <!-- SECTION MENU ITEM -->
      <a class="section-menu-item tns-item" href="profile-store.html" id="section-navigation-slider-item10" aria-hidden="true" tabindex="-1">
        <!-- SECTION MENU ITEM ICON -->
        <svg class="section-menu-item-icon icon-store">
          <use xlink:href="#svg-store"></use>
        </svg>
        <!-- /SECTION MENU ITEM ICON -->

        <!-- SECTION MENU ITEM TEXT -->
        <p class="section-menu-item-text">Store</p>
        <!-- /SECTION MENU ITEM TEXT -->
      </a>
      <!-- /SECTION MENU ITEM -->
    </div></div></div></div>
    <!-- /SECTION MENU -->

    <!-- SLIDER CONTROLS -->
    <div id="section-navigation-slider-controls" class="slider-controls" aria-label="Carousel Navigation" tabindex="0">
      <!-- SLIDER CONTROL -->
      <div class="slider-control left" aria-controls="section-navigation-slider" tabindex="-1" data-controls="prev" aria-disabled="true">
        <!-- SLIDER CONTROL ICON -->
        <svg class="slider-control-icon icon-small-arrow">
          <use xlink:href="#svg-small-arrow"></use>
        </svg>
        <!-- /SLIDER CONTROL ICON -->
      </div>
      <!-- /SLIDER CONTROL -->

      <!-- SLIDER CONTROL -->
      <div class="slider-control right" aria-controls="section-navigation-slider" tabindex="-1" data-controls="next">
        <!-- SLIDER CONTROL ICON -->
        <svg class="slider-control-icon icon-small-arrow">
          <use xlink:href="#svg-small-arrow"></use>
        </svg>
        <!-- /SLIDER CONTROL ICON -->
      </div>
      <!-- /SLIDER CONTROL -->
    </div>
    <!-- /SLIDER CONTROLS -->
  </nav>
