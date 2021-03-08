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
          <h2 class="section-title">{{ $title }}</h2>
        </div>
    </div>

      <div class="grid grid-3-9 small-space">

        <!-- MARKETPLACE SIDEBAR -->
        <form action="{{ route('filter_cases_market') }}" method="post">
            @csrf
            <div class="marketplace-sidebar">
                <!-- SIDEBAR BOX -->
                <div class="form-input">
                    <label for="items-search">Search Items</label>
                    <input type="text" id="items-search" name="items_search">
                  </div>
                  <br>
                <div class="sidebar-box">
                  <!-- SIDEBAR BOX TITLE -->
                  <p class="sidebar-box-title">Categories</p>
                  <!-- /SIDEBAR BOX TITLE -->

                  <!-- SIDEBAR BOX ITEMS -->
                  <div class="sidebar-box-items">
                      @foreach (getCases() as $case)
                          <div class="checkbox-line">
                              <div class="checkbox-wrap">
                                  <input type="checkbox" class="case_name" id="{{ $case }}" name="case_name[]" value="{{ $case }}">
                                  <div class="checkbox-box">
                                      <svg class="icon-cross">
                                          <use xlink:href="#svg-cross"></use>
                                      </svg>
                                  </div>
                                  <label for="{{ $case }}">{{ $case }}</label>
                              </div>
                              <p class="checkbox-line-text">{{ getCaseItemCount($case) }}</p>
                          </div>
                      @endforeach
                  </div>

                  <button type="submit" class="button small primary">{{ transWord('Apply Filter') }}</button>
                </div>
                <!-- /SIDEBAR BOX -->
              </div>
        </form>
        <!-- /MARKETPLACE SIDEBAR -->

        <!-- MARKETPLACE CONTENT -->
        <div class="marketplace-content">
          <div class="grid grid-6-6-6 centered">

            @if(count($casesMarket) > 0)
            @foreach ($casesMarket as $item)
            <div class="widget-box">

                <p class="widget-box-title">{{ Str::upper($item->type.' '.transWord('Case')) }}</p>

                <div class="widget-box-content" style="max-height: 100%">

                    <div class="tns-outer reaction-stat-slider-items-ow">

                      <div class="tns-ovh reaction-stat-slider-items-mw">
                        <div class="tns-inner reaction-stat-slider-items-iw">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="product-preview">
                                        <a href="marketplace-product.html">
                                          <figure class="product-preview-image liquid" style="background: url({{ asset('uploads/cases/'.$item->type.'/'.$item->preoperative_image) }}) center center / cover no-repeat;">
                                            <img src="{{ asset('uploads/cases/'.$item->type.'/'.$item->preoperative_image) }}" alt="item-01" style="display: none;">
                                          </figure>
                                        </a>

                                        <div class="product-preview-info" style="min-height: 115px;">
                                          <p class="product-preview-title"><a href="marketplace-product.html">{{ Str::upper(transWord('Case').': '.$item->type) }}</a></p>
                                          <p class="product-preview-category digital"><a href="#">{{ transWord('Type').': '.transWord('Preoperative') }}</a></p>
                                          <p class="product-preview-category digital"><a href="#">{{ transWord('Title').': '.$item->preoperative_title }}</a></p>
                                        </div>

                                        <div class="product-preview-meta">
                                          <div class="product-preview-author">
                                            <a class="product-preview-author-image user-avatar micro no-border" href="profile-timeline.html">
                                              <div class="user-avatar-content">
                                                <div class="hexagon-image-18-20" data-src="{{ asset(getUserAvatar($item->user->id)) }}" style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                                              </div>
                                            </a>
                                            <p class="product-preview-author-title">{{ transWord('Posted By') }}</p>
                                            <p class="product-preview-author-text"><a href="profile-timeline.html">{{ $item->user->name }}</a></p>
                                          </div>


                                        </div>
                                      </div>


                                </div>
                                <div class="col-lg-4">
                                    <div class="product-preview">
                                        <a href="marketplace-product.html">
                                          <figure class="product-preview-image liquid" style="background: url({{ asset('uploads/cases/'.$item->type.'/'.$item->processingoperative_image) }}) center center / cover no-repeat;">
                                            <img src="{{ asset('uploads/cases/'.$item->type.'/'.$item->processingoperative_image) }}" alt="item-01" style="display: none;">
                                          </figure>
                                        </a>

                                        <div class="product-preview-info" style="min-height: 115px;">
                                          <p class="product-preview-title"><a href="marketplace-product.html">{{ Str::upper(transWord('Case').': '.$item->type) }}</a></p>
                                          <p class="product-preview-category digital"><a href="#">{{ transWord('Type').': '.transWord('Processingoperative') }}</a></p>
                                          <p class="product-preview-category digital"><a href="#">{{ transWord('Title').': '.$item->processingoperative_title }}</a></p>
                                        </div>

                                        <div class="product-preview-meta">
                                          <div class="product-preview-author">
                                            <a class="product-preview-author-image user-avatar micro no-border" href="profile-timeline.html">
                                              <div class="user-avatar-content">
                                                <div class="hexagon-image-18-20" data-src="{{ asset(getUserAvatar($item->user->id)) }}" style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                                              </div>
                                            </a>
                                            <p class="product-preview-author-title">{{ transWord('Posted By') }}</p>
                                            <p class="product-preview-author-text"><a href="profile-timeline.html">{{ $item->user->name }}</a></p>
                                          </div>


                                        </div>
                                      </div>


                                </div>
                                <div class="col-lg-4">
                                    <div class="product-preview">
                                        <a href="marketplace-product.html">
                                          <figure class="product-preview-image liquid" style="background: url({{ asset('uploads/cases/'.$item->type.'/'.$item->postoperative_image) }}) center center / cover no-repeat;">
                                            <img src="{{ asset('uploads/cases/'.$item->type.'/'.$item->postoperative_image) }}" alt="item-01" style="display: none;">
                                          </figure>
                                        </a>

                                        <div class="product-preview-info" style="min-height: 115px;">
                                          <p class="product-preview-title"><a href="marketplace-product.html">{{ Str::upper(transWord('Case').': '.$item->type) }}</a></p>
                                          <p class="product-preview-category digital"><a href="#">{{ transWord('Type').': '.transWord('Prostoperative') }}</a></p>
                                          <p class="product-preview-category digital"><a href="#">{{ transWord('Title').': '.$item->postoperative_title }}</a></p>
                                        </div>

                                        <div class="product-preview-meta">
                                          <div class="product-preview-author">
                                            <a class="product-preview-author-image user-avatar micro no-border" href="profile-timeline.html">
                                              <div class="user-avatar-content">
                                                <div class="hexagon-image-18-20" data-src="{{ asset(getUserAvatar($item->user->id)) }}" style="width: 18px; height: 20px; position: relative;"><canvas width="18" height="20" style="position: absolute; top: 0px; left: 0px;"></canvas></div>
                                              </div>
                                            </a>
                                            <p class="product-preview-author-title">{{ transWord('Posted By') }}</p>
                                            <p class="product-preview-author-text"><a href="profile-timeline.html">{{ $item->user->name }}</a></p>
                                          </div>


                                        </div>
                                      </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                  <!-- /WIDGET BOX CONTENT SLIDER -->
                </div>
                <!-- /WIDGET BOX CONTENT -->
              </div>
            @endforeach

            @else
            <h3>{{ transWord('No Item(s)') }}</h3>
            @endif


          </div>

          <div class="section-pager-bar-wrap">
              {{ $casesMarket->links() }}
          </div>
        </div>
      </div>




</div>


@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

@endsection
