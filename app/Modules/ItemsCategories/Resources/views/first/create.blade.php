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

                <div class="form-row split">

                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="first_category">{{ transWord('First Category') }}</label>
                        <select name="first_category" id="first_category" required>
                            <option value="">{{ transWord('Select Category') }}</option>
                              @foreach (getFirstCategory() as $index => $cat)
                                <option value="{{ $index }}">{{ $cat }}</option>
                              @endforeach
                        </select>
                        </div>
                    </div>

                    <div class="form-item" id="first">
                        <div class="form-input small active">
                        <label for="second_category">{{ transWord('Second Category') }}</label>
                        <select name="second_category" class="second_category" required>
                            <option value="">{{ transWord('Select Category') }}</option>
                              @foreach (getDentalEquipment() as $index => $cat)
                                <option value="{{ $index }}">{{ $cat }}</option>
                              @endforeach
                        </select>
                        </div>
                    </div>

                    <div class="form-item" id="second">
                        <div class="form-input small active">
                        <label for="second_category">{{ transWord('Second Category') }}</label>
                        <select name="second_category" class="second_category" required>
                            <option value="">{{ transWord('Select Category') }}</option>
                              @foreach (getDentalConsumables() as $index => $cat)
                                <option value="{{ $index }}">{{ $cat }}</option>
                              @endforeach
                        </select>
                        </div>
                    </div>

                    <div class="form-item" id="third">
                        <div class="form-input small active">
                        <label for="second_category">{{ transWord('Second Category') }}</label>
                        <select name="second_category" class="second_category" required>
                            <option value="">{{ transWord('Select Category') }}</option>
                              @foreach (getInstruments() as $index => $cat)
                                <option value="{{ $index }}">{{ $cat }}</option>
                              @endforeach
                        </select>
                        </div>
                    </div>

                    <div class="form-item" id="otherCategory"></div>



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
        $('#first').hide();
        $('#second').hide();
        $('#third').hide();
        $('#otherCategory').hide();

        var firstCat = '';
        var secondCat = '';

        $('#first_category').on('change',function(){
            var firstVal = $(this).val();
            firstCat = firstVal;
            if (firstVal != '') {
                if (firstVal == 'Dental Equipments') {
                    $('#first').fadeIn();
                    $('#second').hide();
                    $('#third').hide();


                    $('.second_category').on('change',function(){
                        var secondVal = $(this).val();
                        secondVal = secondVal.replace(/\s/g, '');
                        secondCat = 'get'+secondVal.charAt(0).toUpperCase() + secondVal.slice(1)+'Equipment';
                        // var fn = window[settings.functionName];
                        // alert(typeof fn === 'function');
                        var otherCatHtml = '';
                        <?php $thirdCat = "<script>document.write(secondCat)</script>" ?>
                        otherCatHtml +='<div class="form-input small active">';
                        otherCatHtml +='<label for="second_category">{{ transWord("Third Category") }}</label>';
                        otherCatHtml +='<select name="second_category" class="third_category" required>';
                        otherCatHtml +='<option value="">{{ transWord("Select Category") }}</option>';
                        alert(getLasersEquipment);
                        $.each(getLasersEquipment,function(key,value){
                            otherCatHtml +='<option value="'+value+'">'+value+'</option>';
                        });
                        otherCatHtml +='</select>';
                        otherCatHtml +='</div>';
                        $('#otherCategory').html(otherCatHtml);
                        $('#otherCategory').fadeIn();
                        // alert(secondCat);
                    });

                }

                if (firstVal == 'Dental Consumables') {
                    $('#first').hide();
                    $('#second').fadeIn();
                    $('#third').hide();
                }

                if (firstVal == 'Instruments') {
                    $('#first').hide();
                    $('#second').hide();
                    $('#third').fadeIn();
                }
            }else{
                $('#first').hide();
                $('#second').hide();
                $('#third').hide();
            }
        });



    });
</script>
@endsection
