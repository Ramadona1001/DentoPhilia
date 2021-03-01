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
          <h2 class="section-title" style="display: flex;">{{ $title }}</h2>
        </div>
    </div>

    <br>

    <div class="centered-on-mobile">
        @include('components.errors')
        <div class="widget-box">
            <!-- WIDGET BOX TITLE -->
            <p class="widget-box-title">{{ $title }}</p>
            <!-- /WIDGET BOX TITLE -->

            <!-- WIDGET BOX CONTENT -->
            <div class="widget-box-content">
              <form  method="POST" action="{{ route('store_items') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-row split">
                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-name">{{ transWord('Name') }}</label>
                        <input type="text" id="profile-name" name="name" required>
                        </div>
                    </div>

                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-price">{{ transWord('Price') }}</label>
                        <input type="number" id="profile-price" class="other-input" name="price" min="0" step="1" required>
                        </div>
                    </div>
                </div>

                <div class="form-row split">
                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-desc">{{ transWord('Descriptions') }}</label>
                        <textarea name="desc" id="profile-desc" cols="30" rows="10" required></textarea>
                        </div>
                    </div>
                </div>

                <div class="form-row split">

                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-image">{{ transWord('Image') }}</label>
                        <input type="file" id="profile-image"  class="other-input" name="image">
                        </div>
                    </div>

                </div>

                @if (getBusinessAcountTypeByUser(Auth::user()->id) == 'Shop')

                <div class="form-row split">

                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-image">{{ transWord('Item For') }}</label>
                        <select name="item_for" id="item_for">
                            <option value="">{{ transWord('Item For') }}</option>
                            <option value="0">{{ transWord('Item For Marketplace') }}</option>
                            <option value="1">{{ transWord('Item For Labs') }}</option>
                        </select>
                        </div>
                    </div>

                </div>

                <div class="form-row split">

                    <div class="form-item" id="firstForMarket">
                        <div class="form-input small active">
                        <label for="first_category">{{ transWord('First Category') }}</label>
                        <select name="first_category" class="first_category" required>
                            <option value="">{{ transWord('Select Category') }}</option>
                              @foreach (getFirstCategory() as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                              @endforeach
                        </select>
                        </div>
                    </div>

                    <div class="form-item" id="firstForLab">
                        <div class="form-input small active">
                        <label for="first_category">{{ transWord('First Category') }}</label>
                        <select name="first_category" class="first_category" required>
                            <option value="">{{ transWord('Select Category') }}</option>
                              @foreach (getFirstCategoryLab() as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                              @endforeach
                        </select>
                        </div>
                    </div>
                    @endif

                    @if (getBusinessAcountTypeByUser(Auth::user()->id) == 'Lab')
                    <div class="form-row split">
                        <div class="form-item" id="firstForMarket">
                            <div class="form-input small active">
                            <label for="first_category">{{ transWord('First Category') }}</label>
                            <select name="first_category" class="first_category" required>
                                <option value="">{{ transWord('Select Category') }}</option>
                                @foreach (getFirstCategoryForLabUser() as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    @endif


                    <div class="form-item" id="secondCat"></div>
                    @if (getBusinessAcountTypeByUser(Auth::user()->id) == 'Shop')
                    <div class="form-item" id="thirdCat"></div>
                    @endif



                </div>



                <div class="form-row split">
                    <div class="form-item">
                    <button type="submit" style="color: white;" class="btn btn-primary btn-lg">
                        <svg class="text-sticker-icon icon-forum" style="fill: white;">
                            <use xlink:href="#svg-forum"></use>
                        </svg>
                        {{ transWord('Save') }}
                    </button>
                    </div>
                </div>

              </form>
              <!-- /FORM -->
            </div>
            <!-- WIDGET BOX CONTENT -->
          </div>

    </div>


</div>


@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="{{ asset('dento/dentofunctions/dental_equipments.js') }}"></script>
<script>




    $(document).ready(function(){
        $('#secondCat').hide();
        $('#thirdCat').hide();
        $('#firstForLab').hide();
        var getSecondCat = '';
        var itemFor = 0;

        $('#item_for').on('change',function(){
            if ($(this).val() == '') {
                itemFor = 0;
                $('#firstForMarket').fadeIn();
                $('#firstForLab').hide();
            }
            if ($(this).val() == 0) {
                itemFor = 0;
                $('#firstForMarket').fadeIn();
                $('#firstForLab').hide();
            }
            if ($(this).val() == 1) {
                itemFor = 1;
                $('#firstForMarket').fadeOut();
                $('#firstForLab').fadeIn();
                $('#secondCat').hide();
                $('#thirdCat').hide();
            }
        });


        $('.first_category').on('change',function(){
            var firstVal = $(this).val();
            if (firstVal != '') {
                var getSecondCat = '{{ route("second_item_categories_data_ajax",["firstcat"=>"#id"]) }}';
                getSecondCat = getSecondCat.replace('#id',firstVal);
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
                        var secondCatHtml = '';
                        secondCatHtml += '<div class="form-item">';
                        secondCatHtml += '<div class="form-input small active">';
                        secondCatHtml += '<label for="second_category">{{ transWord("Second Category") }}</label>';
                        secondCatHtml += '<select name="second_category" id="second_category" required>';
                        secondCatHtml += '<option value="">{{ transWord("Select Category") }}</option>';
                        $.each(data.data , function(index,value){
                            secondCatHtml += '<option value="'+value.id+'">'+value.name+'</option>';
                        });
                        secondCatHtml += '</select>';
                        secondCatHtml += '</div>';
                        secondCatHtml += '</div>';
                        $('#secondCat').html(secondCatHtml);
                        $('#secondCat').fadeIn();

                        if (itemFor == 0) {
                            $('#second_category').on('change',function(){
                            var secondVal = $(this).val();
                            if (secondVal != '') {
                                var getThirdCat = '{{ route("third_item_categories_data_ajax",["secondcat"=>"#id"]) }}';
                                getThirdCat = getThirdCat.replace('#id',firstVal);
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.ajax({
                                    type: 'GET',
                                    url: getThirdCat,
                                    dataType: 'json',
                                    success: function (data) {
                                        var thirdCatHtml = '';
                                        thirdCatHtml += '<div class="form-item">';
                                        thirdCatHtml += '<div class="form-input small active">';
                                        thirdCatHtml += '<label for="third_category">{{ transWord("Third Category") }}</label>';
                                        thirdCatHtml += '<select name="third_category" id="third_category">';
                                        thirdCatHtml += '<option value="">{{ transWord("Select Category") }}</option>';
                                        $.each(data.data , function(index,value){
                                            thirdCatHtml += '<option value="'+value.id+'">'+value.name+'</option>';
                                        });
                                        thirdCatHtml += '</select>';
                                        thirdCatHtml += '</div>';
                                        thirdCatHtml += '</div>';
                                        $('#thirdCat').html(thirdCatHtml);
                                        $('#thirdCat').fadeIn();


                                    },
                                    error: function (data) {
                                        console.log(data);
                                    }
                                });
                            }else{
                                $('#thirdCat').hide();
                            }
                        });
                        }

                    },
                    error: function (data) {
                        console.log(data);
                    }
                });

            }else{
                $('#secondCat').hide();
                $('#thirdCat').hide();
            }
        });




    });
</script>
@endsection
