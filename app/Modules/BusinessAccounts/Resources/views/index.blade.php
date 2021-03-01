@extends('layouts.master')

@section('title',$title)

@section('stylesheet')

@endsection

@section('content')
<div class="content-grid" style="transform: translate(0px, 0px); transition: transform 0.4s ease-in-out 0s;">

    <div class="section-banner">
        <img class="section-banner-icon" src="{{ asset('dento/img/banner/members-icon.png') }}" alt="dentophilia-dashboard">
        <p class="section-banner-title">{{ $title }}</p>
        <p class="section-banner-text">{{ transWord('Welcome').' '.Auth::user()->name.' to DentoPhilia' }}</p>
    </div>

    <div class="section-header">
        <div class="section-header-info">
          <h2 class="section-title" style="display: flex;">{{ $title }}
            @can('create_business_accounts')
            &nbsp;&nbsp;
            <a href="{{ route('create_business_accounts') }}" class="text-sticker">
                <svg class="text-sticker-icon icon-plus-small">
                  <use xlink:href="#svg-plus-small"></use>
                </svg>
                {{ transWord('Add New') }}
            </a>
            @endcan
            </h2>
        </div>
    </div>

    <div class="grid grid-3-3-3 centered-on-mobile">

      @foreach ($business_accounts as $business)
      <div class="user-preview">

        <figure class="user-preview-cover liquid" style="background: url({{ asset('dento/img/cover/23.jpg') }}) center center / cover no-repeat;">
          <img src="{{ asset('dento/img/cover/23.jpg') }}" alt="cover-23" style="display: none;">
        </figure>

        <div class="user-preview-info">
          <div class="user-short-description">
            <a class="user-short-description-avatar user-avatar medium" href="profile-timeline.html">
              <div class="user-avatar-border">
                <div class="hexagon-120-132" style="width: 120px; height: 132px; position: relative;"><canvas width="120" height="132" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
              </div>

              <div class="user-avatar-content">
                @if ($business->user->gender == 'Male')
                <div class="hexagon-image-82-90" data-src="{{ asset('dento/img/avatar/businessman.png') }}" style="width: 82px; height: 90px; position: relative;"><canvas width="82" height="90" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                @else
                    <div class="hexagon-image-82-90" data-src="{{ asset('dento/img/avatar/businesswoman.png') }}" style="width: 82px; height: 90px; position: relative;"><canvas width="82" height="90" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                @endif
              </div>



              <div class="user-avatar-progress-border">
                <div class="hexagon-border-100-110" style="width: 100px; height: 110px; position: relative;"><canvas width="100" height="110" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
              </div>


            </a>

            <p class="user-short-description-title"><a href="profile-timeline.html">{{ $business->user->name }}</a></p>
            <p class="user-short-description-text">{{ transWord('username').' '.$business->user->username }}</p>
            <p class="user-short-description-text">{{ transWord('email').' '.$business->user->email }}</p>
            <p class="user-short-description-text">{{ transWord('mobile').' '.$business->mobile }}</p>
            <p class="user-short-description-text">{{ transWord('type').' '.transWord($business->type) }}</p>
          </div>



          <div class="user-preview-actions">

            @can('show_business_accounts')
            <a href="{{ route('show_business_accounts',Crypt::encrypt($business->id)) }}" class="button secondary" title="{{ transWord('View Information') }}">
                <svg class="menu-item-link-icon icon-members" style="fill: white;">
                    <use xlink:href="#svg-members"></use>
                </svg>
            </a>
            @endcan

            @can('update_business_accounts')
            <a href="{{ route('edit_business_accounts',Crypt::encrypt($business->id)) }}" class="button secondary" title="{{ transWord('Update Information') }}">
                <svg class="menu-item-link-icon icon-comment" style="fill: white;">
                    <use xlink:href="#svg-comment"></use>
                </svg>
            </a>
            @endcan

            @can('approve_business_accounts')
            @if($business->approve == 0)
            <a href="{{ route('approve_business_accounts',Crypt::encrypt($business->id)) }}" class="button secondary" title="{{ transWord('Approve') }}">
                <svg class="menu-item-link-icon icon-check" style="fill: white;">
                    <use xlink:href="#svg-check"></use>
                </svg>
            </a>
            @else
            <a href="{{ route('disapprove_business_accounts',Crypt::encrypt($business->id)) }}" class="button secondary" title="{{ transWord('Disapprove') }}">
                <svg class="menu-item-link-icon icon-return" style="fill: white;">
                    <use xlink:href="#svg-return"></use>
                </svg>
                @endif
            </a>
            @endcan

            @can('delete_business_accounts')
            <a href="{{ route('delete_business_accounts',Crypt::encrypt($business->id)) }}" onclick="return confirm('{{ transWord('Are you sure?') }}')" class="button secondary" title="{{ transWord('Delete') }}">
                <svg class="menu-item-link-icon icon-delete" style="fill: white;">
                    <use xlink:href="#svg-delete"></use>
                </svg>
            </a>
            @endcan



          </div>

        </div>

      </div>
      @endforeach

      {{ $business_accounts->links() }}

    </div>


</div>


@endsection

@section('javascript')

@endsection
