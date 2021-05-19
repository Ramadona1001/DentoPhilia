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
            @can('create_doctors')
            &nbsp;&nbsp;
            <a href="{{ route('create_doctors') }}" class="text-sticker">
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

      @foreach ($doctors as $doctor)
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
                @if ($doctor->user->gender == 'Male')
                <div class="hexagon-image-82-90" data-src="{{ asset('dento/img/avatar/doctor_male.png') }}" style="width: 82px; height: 90px; position: relative;"><canvas width="82" height="90" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                @else
                    <div class="hexagon-image-82-90" data-src="{{ asset('dento/img/avatar/doctor_female.png') }}" style="width: 82px; height: 90px; position: relative;"><canvas width="82" height="90" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                @endif
              </div>



              <div class="user-avatar-progress-border">
                <div class="hexagon-border-100-110" style="width: 100px; height: 110px; position: relative;"><canvas width="100" height="110" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
              </div>


            </a>

            <p class="user-short-description-title"><a href="profile-timeline.html">{{ $doctor->user->name }}</a></p>
            <p class="user-short-description-text">{{ transWord('username').' '.$doctor->user->username }}</p>
            <p class="user-short-description-text">{{ transWord('email').' '.$doctor->user->email }}</p>
            <p class="user-short-description-text">{{ transWord('mobile').' '.$doctor->mobile }}</p>
          </div>



          <div class="user-preview-actions">

            @can('show_doctors')
            <a href="#" class="button secondary" title="{{ transWord('View Information') }}">
                <svg class="menu-item-link-icon icon-members" style="fill: white;">
                    <use xlink:href="#svg-members"></use>
                </svg>
            </a>
            @endcan

            @can('update_doctors')
            <a href="{{ route('edit_doctors',Crypt::encrypt($doctor->id)) }}" class="button secondary" title="{{ transWord('Update Information') }}">
                <svg class="menu-item-link-icon icon-comment" style="fill: white;">
                    <use xlink:href="#svg-comment"></use>
                </svg>
            </a>
            @endcan

            @can('delete_doctors')
            <a href="{{ route('delete_doctors',Crypt::encrypt($doctor->id)) }}" onclick="return confirm('{{ transWord('Are you sure?') }}')" class="button secondary" title="{{ transWord('Delete') }}">
                <svg class="menu-item-link-icon icon-delete" style="fill: white;">
                    <use xlink:href="#svg-delete"></use>
                </svg>
            </a>
            @endcan



          </div>

        </div>

      </div>
      @endforeach

      {{ $doctors->links() }}

    </div>


</div>


@endsection

@section('javascript')

@endsection
