@section('stylesheet')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@php
    if(isset($user)){
        $user = $user;
    }else{
        $user = \Auth::user();
    }
@endphp
<div class="profile-header">
    <figure class="profile-header-cover liquid" style="background: url({{ asset('dento/img/dentist.jpg') }}) center center / cover no-repeat;">
      <img src="{{ asset('dento/img/dentist.jpg') }}" alt="cover-01" style="display: none;">
    </figure>

    <div class="profile-header-info">
      <div class="user-short-description big">
        <a class="user-short-description-avatar user-avatar big" href="profile-timeline.html">
          <div class="user-avatar-border">
            <div class="hexagon-148-164" style="width: 148px; height: 164px; position: relative;"><canvas width="148" height="164" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
          </div>

          <div class="user-avatar-content">
            <div class="hexagon-image-100-110" data-src="{{ asset(getUserAvatar($user->id)) }}" style="width: 100px; height: 110px; position: relative;"><canvas width="100" height="110" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
          </div>
        </a>

        <p class="user-short-description-title"><a href="profile-timeline.html">{{ $user->name }}</a></p>
        <p class="user-short-description-text"><a href="#">{{ '@'.$user->username }}</a></p>
      </div>

      @if ($user->id != Auth::user()->id)
      <div class="profile-header-info-actions">
        <form method="post" id="unfollow-form">
            <input type="hidden" name="userid" value="{{ Crypt::encrypt($user->id) }}">
            <button type="submit" class="profile-header-info-action button secondary btn-unfollow"><span class="hide-text-mobile">UnFollow</span></button>
          </form>

          <form method="post" id="follow-form">
            @csrf
            <input type="hidden" name="userid" value="{{ Crypt::encrypt($user->id) }}">
            <button type="submit" class="profile-header-info-action button secondary btn-follow"><span class="hide-text-mobile">Follow</span></button>
          </form>

        <p class="profile-header-info-action button primary"><span class="hide-text-mobile">Send</span> Message</p>
      </div>
      @endif
    </div>
  </div>


  <nav class="section-navigation">
    <div class="tns-outer" id="section-navigation-slider-ow"><div class="tns-liveregion tns-visually-hidden" aria-live="polite" aria-atomic="true">slide <span class="current">1 to 9</span>  of 11</div><div id="section-navigation-slider-mw" class="tns-ovh"><div class="tns-inner" id="section-navigation-slider-iw"><div id="section-navigation-slider" class="section-menu  tns-slider tns-carousel tns-subpixel tns-calc tns-horizontal" style="transform: translate3d(0px, 0px, 0px);">
      <a class="section-menu-item @yield('aboutme') tns-item tns-slide-active" href="{{ route('profile_users',$user->username) }}" id="section-navigation-slider-item0">
        <svg class="section-menu-item-icon icon-profile">
          <use xlink:href="#svg-profile"></use>
        </svg>

        <p class="section-menu-item-text">{{ transWord('About') }}</p>
      </a>

      @if ($user->hasRole('Doctor'))
      <a class="section-menu-item @yield('cases') tns-item tns-slide-active" href="{{ route('cases_doctors') }}" id="section-navigation-slider-item1">
        <svg class="section-menu-item-icon icon-timeline">
          <use xlink:href="#svg-timeline"></use>
        </svg>

        <p class="section-menu-item-text">{{ transWord('Cases') }}</p>
      </a>
      @endif

      @if ($user->hasRole('Business Account'))
      <a class="section-menu-item @yield('items') tns-item tns-slide-active" href="{{ route('items_business_accounts') }}" id="section-navigation-slider-item1">
        <svg class="section-menu-item-icon icon-timeline">
          <use xlink:href="#svg-timeline"></use>
        </svg>

        <p class="section-menu-item-text">{{ transWord('Items') }}</p>
      </a>
      @endif



      <a class="section-menu-item tns-item tns-slide-active" href="{{ route('me_friends',$user->username) }}" id="section-navigation-slider-item2">
        <svg class="section-menu-item-icon icon-friend">
          <use xlink:href="#svg-friend"></use>
        </svg>

        <p class="section-menu-item-text">Friends</p>
      </a>

      <a class="section-menu-item tns-item tns-slide-active" href="{{ route('profile_videos',$user->username) }}" id="section-navigation-slider-item2">
        <svg class="section-menu-item-icon icon-videos">
          <use xlink:href="#svg-videos"></use>
        </svg>

        <p class="section-menu-item-text">{{ transWord('Videos') }}</p>
      </a>
      <!-- /SECTION MENU ITEM -->

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


  @section('javascript')
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

  <script type="text/javascript">

    var checkFriend = '{{ checkIsFriend($user->id) }}';
    if (checkFriend == 'firend') {
        $('#unfollow-form').fadeIn();
        $('#follow-form').hide();
    }else{
        $('#follow-form').fadeIn();
        $('#unfollow-form').hide();
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".btn-follow").click(function(e){

        e.preventDefault();

        var userid = $("input[name=userid]").val();
        var followUrl = '{{ route("add_friends",["touser"=>"#id"]) }}';
        followUrl = followUrl.replace('#id',userid);

        $.ajax({
           type:'POST',
           url:followUrl,
           success:function(data){
              if (data.success > 0) {
                  $('#follow-form').fadeOut();
                  $('#unfollow-form').fadeIn();
              }
           }
        });

    });

    $(".btn-unfollow").click(function(e){

        e.preventDefault();
        var userid = $("input[name=userid]").val();
        var unfollowUrl = '{{ route("delete_friends",["touser"=>"#id"]) }}';
        unfollowUrl = unfollowUrl.replace('#id',userid);

        $.ajax({
            type:'POST',
            url:unfollowUrl,
            success:function(data){
                if (data.success > 0) {
                    $('#follow-form').fadeIn();
                    $('#unfollow-form').fadeOut();
                }
            }
        });

    });

  </script>
  @endsection
