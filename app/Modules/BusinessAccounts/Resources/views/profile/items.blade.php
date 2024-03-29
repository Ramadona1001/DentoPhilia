@extends('layouts.master')

@section('title',$title)

@section('items','active')

@section('content')

<div class="content-grid" style="transform: translate(0px, 0px); transition: transform 0.4s ease-in-out 0s;">

    @include('BusinessAccounts::profile.components.profile')

    <div class="grid grid-3-3-3 centered-on-mobile">
        <!-- CREATE ENTITY BOX -->
        <div class="create-entity-box v2" style="height: 390px;">
          <!-- CREATE ENTITY BOX COVER -->
          <div class="create-entity-box-cover"></div>
          <!-- /CREATE ENTITY BOX COVER -->

          <!-- CREATE ENTITY BOX AVATAR -->
          <div class="create-entity-box-avatar primary">
            <!-- CREATE ENTITY BOX AVATAR ICON -->
            <svg class="create-entity-box-avatar-icon icon-item">
              <use xlink:href="#svg-item"></use>
            </svg>
            <!-- /CREATE ENTITY BOX AVATAR ICON -->
          </div>
          <!-- /CREATE ENTITY BOX AVATAR -->

          <!-- CREATE ENTITY BOX INFO -->
          <div class="create-entity-box-info">
            <!-- CREATE ENTITY BOX TITLE -->
            <p class="create-entity-box-title">{{ transWord('Your Item Name Here') }}</p>
            <!-- /CREATE ENTITY BOX TITLE -->

            <!-- CREATE ENTITY BOX CATEGORY -->
            <p class="create-entity-box-category">{{ transWord('Category') }}</p>
            <!-- /CREATE ENTITY BOX CATEGORY -->

            <!-- BUTTON -->
            <p class="button primary full">
                <a href="{{ route('create_items') }}" style="color:white;">{{ transWord('Create New Item!') }}</a>
            </p>
            <!-- /BUTTON -->
          </div>
          <!-- /CREATE ENTITY BOX INFO -->
        </div>
        <!-- /CREATE ENTITY BOX -->

        @foreach ($items as $item)
        <div class="product-preview fixed-height" style="height: 390px;">
            <!-- PRODUCT PREVIEW IMAGE -->
            <a href="marketplace-product.html" title="{{ $item->desc }}">
              <figure class="product-preview-image liquid" style="background: url({{ asset('uploads/business_accounts/items/'.$item->image) }}) center center / cover no-repeat;">
                <img src="{{ asset('uploads/business_accounts/items/'.$item->image) }}" alt="item-01" style="display: none;">
              </figure>
            </a>
            <!-- /PRODUCT PREVIEW IMAGE -->

            <!-- PRODUCT PREVIEW INFO -->
            <div class="product-preview-info">
              <!-- TEXT STICKER -->
              <p class="text-sticker"><span class="highlighted">$</span> {{ $item->price }}</p>
              <!-- /TEXT STICKER -->

              <!-- PRODUCT PREVIEW TITLE -->
              <p class="product-preview-title"><a href="marketplace-product.html">{{ $item->name }}</a></p>
              <!-- /PRODUCT PREVIEW TITLE -->

              <!-- PRODUCT PREVIEW CATEGORY -->
                @if ($item->first_category != null)
                <p class="product-preview-category digital">
                    <a href="#">{{ transWord('First Category').': '.$item->firstCat->name }}</a>
                </p>
                @endif
                @if ($item->second_category != null)
                <p class="product-preview-category digital">
                    <a href="#">{{ transWord('Second Category').': '.$item->secondCat->name }}</a>
                </p>
                @endif
                @if ($item->third_category != null)
                <p class="product-preview-category digital">
                    <a href="#">{{ transWord('Third Category').': '.$item->thirdCat->name }}</a>
                </p>
                @endif
              <!-- /PRODUCT PREVIEW CATEGORY -->

              <!-- BUTTON -->
              <div class="user-preview-actions">

                @can('show_items')
                <a href="#" class="button secondary" style="width: 40%" title="{{ transWord('View Information') }}">
                    <svg class="menu-item-link-icon icon-comment" style="fill: white;">
                        <use xlink:href="#svg-comment"></use>
                    </svg>
                </a>
                @endcan

                @can('update_items')
                <a href="#" class="button secondary" style="width: 40%" title="{{ transWord('Update Information') }}">
                    <svg class="menu-item-link-icon icon-delete" style="fill: white;">
                        <use xlink:href="#svg-delete"></use>
                    </svg>
                </a>
                @endcan


              </div>
              <!-- /BUTTON -->
            </div>
            <!-- /PRODUCT PREVIEW INFO -->
          </div>
        @endforeach
      </div>
    <!-- /GRID -->
  </div>
  @endsection

  @section('javascript')

  @endsection
