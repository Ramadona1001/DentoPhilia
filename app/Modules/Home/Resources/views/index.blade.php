@extends('layouts.master')

@section('title',transWord('Home'))

@section('stylesheet')
<style>
.reaction-stat .reaction-stat-title {
    font-size:0.9rem;
}
</style>
@endsection

@section('content')
<div class="content-grid" style="transform: translate(0px, 0px); transition: transform 0.4s ease-in-out 0s;">
    <div class="section-banner">
        <img class="section-banner-icon" src="{{ asset('dento/img/banner/dashboard.png') }}" style="width: 148px; margin-left: 8px; margin-bottom: 5px;" alt="dentophilia-dashboard">
        <p class="section-banner-title">{{ transWord('DentoPhilia') }}</p>
        <p class="section-banner-text">{{ transWord('Welcome').' '.Auth::user()->name.' to DentoPhilia' }}</p>
    </div>

    <div class="section-header">
        <div class="section-header-info">
          <h2 class="section-title">{{ transWord('Welcome To DentoPhilia') }}</h2>
        </div>
    </div>

    @include('Home::components.doctor')

    @include('Home::components.business_accounts')

    <div class="grid grid-3-3-3-3">
        @can('show_users')
        <a class="product-category-box users-featured" href="{{ route('users') }}">
          <p class="product-category-box-title">{{ transWord('Users') }}</p>
          @can('users_statistics')
          <p class="product-category-box-text">{{ transWord('Accounts Statistics') }}</p>
          <p class="product-category-box-tag">254 {{ transWord('user') }}</p>
          @endcan
        </a>
        @endcan

        @can('show_doctors')
        <a class="product-category-box users-featured" href="{{ route('doctors') }}">
          <p class="product-category-box-title">{{ transWord('Doctors') }}</p>
          @can('doctors_statistics')
          <p class="product-category-box-text">{{ transWord('Doctors Statistics') }}</p>
          <p class="product-category-box-tag">254 {{ transWord('doctors') }}</p>
          @endcan
        </a>
        @endcan

        @can('show_business_accounts')
        <a class="product-category-box users-featured" href="{{ route('business_accounts') }}">
          <p class="product-category-box-title">{{ transWord('Business Accounts') }}</p>
          @can('businessAccounts_statistics')
          <p class="product-category-box-text">{{ transWord('Business Accounts Statistics') }}</p>
          <p class="product-category-box-tag">254 {{ transWord('Business Accounts') }}</p>
          @endcan
        </a>
        @endcan

        @can('show_roles')
        <a class="product-category-box users-featured" href="{{ route('roles') }}">
          <p class="product-category-box-title">{{ transWord('Roles') }}</p>
          @can('roles_statistics')
          <p class="product-category-box-text">{{ transWord('All Roles in System') }}</p>
          <p class="product-category-box-tag">254 {{ transWord('role') }}</p>
          @endcan
        </a>
        @endcan

        @can('show_items_categories')
        <a class="product-category-box users-featured" href="{{ route('items_categories') }}">
          <p class="product-category-box-title">{{ transWord('Items Categories') }}</p>
          @can('itemsCategories_statistics')
          <p class="product-category-box-text">{{ transWord('All Items Categories') }}</p>
          <p class="product-category-box-tag">254 {{ transWord('Items Categories') }}</p>
          @endcan
        </a>
        @endcan

      </div>
</div>


@endsection

@section('javascript')

@endsection
