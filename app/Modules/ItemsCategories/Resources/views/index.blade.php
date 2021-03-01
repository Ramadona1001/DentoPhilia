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
        <div class="section-filters-bar v7">
          <div class="section-filters-bar-actions">
            <div class="section-filters-bar-info">
              <p class="section-filters-bar-title"><a href="#">{{ transWord('Add Items Categories') }}</a></p>
              <p class="section-filters-bar-text">
                <a href="{{ route('first_item_categories') }}" class="button secondary">{{ transWord('First Category') }}</a>
              </p>
            </div>
          </div>
        </div>

        <div class="section-filters-bar v7">
            <div class="section-filters-bar-actions">
              <div class="section-filters-bar-info">
                <p class="section-filters-bar-title"><a href="#">{{ transWord('Add Items Categories') }}</a></p>
                <p class="section-filters-bar-text">
                  <a href="{{ route('second_item_categories') }}" class="button secondary">{{ transWord('Second Category') }}</a>
                </p>
              </div>
            </div>
          </div>

          <div class="section-filters-bar v7">
            <div class="section-filters-bar-actions">
              <div class="section-filters-bar-info">
                <p class="section-filters-bar-title"><a href="#">{{ transWord('Add Items Categories') }}</a></p>
                <p class="section-filters-bar-text">
                  <a href="{{ route('third_item_categories') }}" class="button secondary">{{ transWord('Third Category') }}</a>
                </p>
              </div>
            </div>
          </div>

    </div>


</div>


@endsection

@section('javascript')

@endsection
