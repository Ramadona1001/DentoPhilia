@extends('layouts.master')

@section('title',$title)

@section('dental_market_active','active')

@section('stylesheet')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<style>
    #loadingProduct
    {
        text-align:center;
        background: url('{{ asset("dento/img/loader.gif") }}') no-repeat center;
        height: 150px;
    }
</style>
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
                    <label for="items-search">Search Items</label>
                    <input type="text" id="items-search" name="items_search" class="items_search">
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
                                  <input type="checkbox" class="first_category" id="{{ $first->name }}" name="first_category[]" value="{{ $first->id }}">
                                  <div class="checkbox-box">
                                      <svg class="icon-cross">
                                          <use xlink:href="#svg-cross"></use>
                                      </svg>
                                  </div>
                                  <label for="{{ $first->name }}">{{ $first->name }}</label>
                              </div>
                          </div>
                      @endforeach
                  </div>
                  <div class="sidebar-box-items" id="second_category" class="second_category">
                      <hr>
                  </div>
                  <!-- /SIDEBAR BOX ITEMS -->

                  <!-- SIDEBAR BOX TITLE -->
                  <p class="sidebar-box-title">{{ transWord('For Labs') }}</p>

                  <div class="sidebar-box-items">

                      <div class="checkbox-line">
                      <div class="checkbox-wrap">
                        <input type="checkbox" id="lab_category" class="lab_category" name="lab_category">
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

                  <p class="sidebar-box-title" style="margin-bottom: 15px;">Price Range <span id="price_show">[0 - {{ getMaxItemPrice(0) }}]</span></p>
                  <div class="list-group">
					<input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="{{ getMaxItemPrice(0) }}" />
                    <div id="price_range"></div>
                </div>

                </div>
                <!-- /SIDEBAR BOX -->
              </div>
        </form>
        <!-- /MARKETPLACE SIDEBAR -->

        <!-- MARKETPLACE CONTENT -->
        <div class="marketplace-content">
            <div class="grid grid-4-4-4 centered filter_data">
            </div>
        </div>
      </div>




</div>


@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(document).ready(function(){

    filter_data();

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var price_from = $('#hidden_minimum_price').val();
        var price_to = $('#hidden_maximum_price').val();

        var first_category = get_filter('first_category');
        var second_category = get_filter('second_category');
        var lab_category = get_filter('lab_category');
        var items_search = $('.items_search').val();
        $.ajax({
            url: "{{ route('all_dental_market') }}",
            method:"GET",
            data:{action:action, price_from:price_from, price_to:price_to, first_category:first_category, second_category:second_category,lab_category:lab_category,items_search:items_search},
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        // alert(filter);
        return filter;
    }


    $('#price_range').slider({
        range:true,
        min:0,
        max:'{{ getMaxItemPrice(0) }}',
        values:[0, {{ getMaxItemPrice(0) }}],
        step:5,
        stop:function(event, ui)
        {
            $('#price_show').html('['+ui.values[0] + ' - ' + ui.values[1]+']');
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });

    $('.first_category').click(function(){
        filter_data();
    });

    $('#items-search').on('input',function(){
        filter_data();
    });

    $('.second_category').click(function(){
        filter_data();
    });


});

    function arrayRemove(arr, value) {
        return arr.filter(function(ele){
            return ele != value;
        });
    }

    $(document).ready(function(){
      $('#second_category').hide();
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
