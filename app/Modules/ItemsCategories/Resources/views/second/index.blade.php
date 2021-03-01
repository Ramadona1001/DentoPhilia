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
            </h2>
        </div>
    </div>

    <div class="grid grid-3-3-3 centered-on-mobile">

      @foreach ($items_categories as $item)
      <div class="section-filters-bar v7">
        <div class="section-filters-bar-actions">
          <div class="section-filters-bar-info">
            <p class="section-filters-bar-title"><a href="#">{{ $item->name }}</a></p>
            <p class="section-filters-bar-text">
              <a href="{{ route('create_third_item_categories',Crypt::encrypt($item->id)) }}" class="button secondary">{{ transWord('Add Sub Category') }}</a>
            </p>
          </div>
        </div>
      </div>
      @endforeach


    </div>


</div>


@endsection

@section('javascript')

@endsection
