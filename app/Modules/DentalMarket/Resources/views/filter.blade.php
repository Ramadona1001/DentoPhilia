@extends('layouts.master')

@section('title',$title)

@section('dental_market_active','active')

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
        <form action="{{ route('filter_dental_market') }}" method="post">
            @csrf
            <div class="marketplace-sidebar">
                <!-- SIDEBAR BOX -->
                <div class="form-input">
                    <input placeholder="Search Items" type="text" @if ($request->items_search != null) value="{{ $request->items_search }}" @endif id="items-search" name="items_search">
                  </div>
                  <br>

                <div class="sidebar-box">
                  <!-- SIDEBAR BOX TITLE -->
                  <p class="sidebar-box-title">Categories</p>
                  <!-- /SIDEBAR BOX TITLE -->

                  <!-- SIDEBAR BOX ITEMS -->
                  <div class="sidebar-box-items">
                      @foreach ($firstCat as $first)
                          <div class="checkbox-line">
                              <div class="checkbox-wrap">
                                  @if (isset($request->first_category))
                                    @if (is_array($request->first_category))
                                        @if (in_array($first->id,$request->first_category))
                                            <input type="checkbox" class="first_category" checked id="{{ $first->name }}" name="first_category[]" value="{{ $first->id }}">
                                        @else
                                            <input type="checkbox" class="first_category" id="{{ $first->name }}" name="first_category[]" value="{{ $first->id }}">
                                        @endif
                                    @else
                                        @if ($first->id == $request->first_category[0])
                                        <input type="checkbox" class="first_category" checked id="{{ $first->name }}" name="first_category[]" value="{{ $first->id }}">
                                        @else
                                            <input type="checkbox" class="first_category" id="{{ $first->name }}" name="first_category[]" value="{{ $first->id }}">
                                        @endif
                                    @endif
                                    @else
                                    <input type="checkbox" class="first_category" id="{{ $first->name }}" name="first_category[]" value="{{ $first->id }}">
                                  @endif


                                  <div class="checkbox-box">
                                      <svg class="icon-cross">
                                          <use xlink:href="#svg-cross"></use>
                                      </svg>
                                  </div>
                                  <label for="{{ $first->name }}">{{ $first->name }}</label>
                              </div>
                              <p class="checkbox-line-text">{{ getCategoryItemCount('first_category',$first->id) }}</p>
                          </div>
                      @endforeach
                  </div>
                  <div class="sidebar-box-items" id="second_category">
                      <hr>
                      @if (isset($request->second_category))
                      @foreach (getSecondCategory($request->second_category) as $item)
                      <div class="checkbox-line">
                        <div class="checkbox-wrap">
                            <input type="checkbox" class="second_category" checked checked id="{{ $item->name }}" name="second_category[]" value="{{ $item->id }}">
                            <div class="checkbox-box">
                                <svg class="icon-cross">
                                    <use xlink:href="#svg-cross"></use>
                                </svg>
                            </div>
                            <label for="{{ $item->name }}">{{ $item->name }}</label>
                        </div>
                        </div>
                      @endforeach
                      @endif
                  </div>
                  <!-- /SIDEBAR BOX ITEMS -->

                  <!-- SIDEBAR BOX TITLE -->
                  <p class="sidebar-box-title">{{ transWord('For Labs') }}</p>

                  <div class="sidebar-box-items">

                      <div class="checkbox-line">
                      <div class="checkbox-wrap">
                        <input type="checkbox" id="lab_category" @if($request->lab_category == 'on') {{ "checked" }} @endif name="lab_category">
                        <div class="checkbox-box">
                          <svg class="icon-cross">
                            <use xlink:href="#svg-cross"></use>
                          </svg>
                        </div>
                        <label for="lab_category">{{ transWord('Labs') }}</label>
                      </div>
                    </div>

                  </div>
                  <!-- /SIDEBAR BOX ITEMS -->

                  <!-- SIDEBAR BOX TITLE -->
                  <p class="sidebar-box-title">Price Range</p>
                  <!-- /SIDEBAR BOX TITLE -->

                  <!-- SIDEBAR BOX ITEMS -->
                  <div class="sidebar-box-items small-space">
                    <!-- FORM ITEM -->
                    <div class="form-item split">
                      <!-- FORM INPUT -->
                      <div class="form-input small active always-active currency-decorated">
                        <label for="price-from">From</label>
                        <input type="text" id="price-from" name="price_from" @if ($request->price_from != null) value="{{ $request->price_from }}" @endif>
                      </div>
                      <!-- /FORM INPUT -->

                      <!-- FORM INPUT -->
                      <div class="form-input small active always-active currency-decorated">
                        <label for="price-to">To</label>
                        <input type="text" id="price-to" name="price_to" @if ($request->price_to != null) value="{{ $request->price_to }}" @endif>
                      </div>
                      <!-- /FORM INPUT -->
                    </div>
                    <!-- /FORM ITEM -->
                  </div>
                  <!-- /SIDEBAR BOX ITEMS -->

                  <!-- BUTTON -->
                  <button type="submit" class="button small primary">{{ transWord('Apply Filter') }}</button>
                </div>
                <!-- /SIDEBAR BOX -->
              </div>
        </form>
        <!-- /MARKETPLACE SIDEBAR -->

        <!-- MARKETPLACE CONTENT -->
        <div class="marketplace-content">
          <div class="grid grid-4-4-4 centered">

            @if (count($dentalMarket) > 0)
            @foreach ($dentalMarket as $item)
            <div class="product-preview">
                <a href="marketplace-product.html">
                  <figure class="product-preview-image liquid" style="background: url({{ asset('uploads/business_accounts/items/'.$item->image) }}) center center / cover no-repeat;">
                    <img src="{{ asset('uploads/business_accounts/items/'.$item->image) }}" alt="item-01" style="display: none;">
                  </figure>
                </a>

                <div class="product-preview-info" style="min-height: 132px;">
                  <p class="text-sticker"><span class="highlighted">$</span> {{ $item->price }}</p>
                  <p class="product-preview-title"><a href="marketplace-product.html">{{ $item->name }}</a></p>
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
            @endforeach
            @else
              <h3>{{ transWord('No Item(s)') }}</h3>
            @endif



          </div>

        </div>
      </div>




</div>


@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
    function arrayRemove(arr, value) {
        return arr.filter(function(ele){
            return ele != value;
        });
    }

    $(document).ready(function(){
        var requestSecond = '<?php print_r($request->second_category); ?>';
        if (requestSecond == null) {
            $('#second_category').hide();
        }else{
            $('#second_category').show();
        }
      var firstCatCheckBoxArray = [];
        $('input[class=first_category]').click(function(){
            if($(this).prop("checked") == true){
                firstCatCheckBoxArray.push($(this).val());
            }
            else if($(this).prop("checked") == false){
                firstCatCheckBoxArray = arrayRemove(firstCatCheckBoxArray,$(this).val());
            }
            if (firstCatCheckBoxArray.length > 0) {
                console.log(firstCatCheckBoxArray);
                var getSecondCat = '{{ route("filter_second_cat_dental_market",["firstcat"=>"#id"]) }}';
                getSecondCat = getSecondCat.replace('#id',firstCatCheckBoxArray);
                console.log(getSecondCat);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'GET',
                    url: getSecondCat,
                    dataType: 'json',
                    success: function (data) {
                        if (data.data.length > 0) {
                            var secondCatHtml = '';
                            $.each(data.data , function(index,value){
                                secondCatHtml +='<div class="checkbox-line">';
                                    secondCatHtml +='<div class="checkbox-wrap">';
                                        secondCatHtml +='<input type="checkbox" class="first_category" id="'+value.name+'" name="second_category[]" value="'+value.id+'">';
                                        secondCatHtml +='<div class="checkbox-box">';
                                            secondCatHtml +='<svg class="icon-cross">';
                                                secondCatHtml +='<use xlink:href="#svg-cross"></use>';
                                            secondCatHtml +='</svg>';
                                        secondCatHtml +='</div>';
                                        secondCatHtml +='<label for="'+value.name+'">'+value.name+'</label>';
                                    secondCatHtml +='</div>';
                                secondCatHtml +='</div>';
                                $('#second_category').html(secondCatHtml);
                            });
                            $('#second_category').fadeIn();
                        }else{
                            $('#second_category').html("");
                            $('#second_category').fadeOut();
                        }
                    }
                });
            }else{
                $('#second_category').html("");
                $('#second_category').fadeOut();
            }
        });



    });
</script>
@endsection
