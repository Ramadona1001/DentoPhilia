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
              <form  method="POST" action="{{ route('store_business_accounts') }}">
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
                        <label for="profile-email">{{ transWord('Email') }}</label>
                        <input type="email" id="profile-email" name="email" required>
                        </div>
                    </div>
                </div>

                <div class="form-row split">
                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-username">{{ transWord('Username') }}</label>
                        <input type="text" id="profile-username" name="username" required>
                        </div>
                    </div>

                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-password">{{ transWord('Password') }}</label>
                        <input type="password" id="profile-password" name="password" required>
                        </div>
                    </div>

                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-confirm-password">{{ transWord('Confirm Password') }}</label>
                        <input type="password" id="profile-confirm-password" name="password_confirmation" required>
                        </div>
                    </div>
                </div>

                <div class="form-row split">

                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-gender">{{ transWord('Gender') }}</label>
                        <select name="gender" id="profile-gender" required>
                            <option value="">{{ transWord('Select Gender') }}</option>
                              @foreach (getGender() as $index => $gender)
                                <option value="{{ $index }}">{{ $gender }}</option>
                              @endforeach
                        </select>
                        </div>
                    </div>

                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-mobile">{{ transWord('Mobile') }}</label>
                        <input type="number" id="profile-mobile" class="other-input" name="mobile">
                        </div>
                    </div>


                </div>

                <div class="form-row split">

                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-type">{{ transWord('Type') }}</label>
                        <select name="type" id="profile-type">
                            <option value="">{{ transWord('Select Type') }}</option>
                            @foreach (businessAccountTypes() as $index => $type)
                                <option value="{{ $index }}">{{ $type }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>

                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-commercial_record">{{ transWord('Commercial Record') }}</label>
                        <input type="file" id="profile-commercial_record"  class="other-input" name="commercial_record">
                        </div>
                    </div>

                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-tax_card">{{ transWord('Tax Card') }}</label>
                        <input type="file" id="profile-tax_card"  class="other-input" name="tax_card">
                        </div>
                    </div>

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
<script>
    $(document).ready(function(){
        $('.form-switch').on('click',function(){
            if ($('.form-switch').hasClass('active')) {
                $('#endDate').fadeOut();
            }else{
                // var d = new Date();
                // var strDate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
                // $('#profile-end').attr('min',year+'-'+month+'-'+day);
                $('#endDate').fadeIn();
            }
        });

        $('#profile-start').on('change',function(){
            var year = parseInt($(this).val().split('-')[0]) + 5;
            var month = $(this).val().split('-')[1];
            var day = $(this).val().split('-')[2];
            // alert($(this).val());
            $('#profile-end').attr('min',year+'-'+month+'-'+day);
        })

    });
</script>
@endsection
