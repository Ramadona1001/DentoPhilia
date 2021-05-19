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
              <form  method="POST" action="{{ route('store_doctors') }}">
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
                        <label for="profile-faculty">{{ transWord('University') }}</label>
                        <input type="text" id="profile-faculty" class="other-input" name="faculty" required>
                        </div>
                    </div>

                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-address">{{ transWord('Address') }}</label>
                        <input type="text" id="profile-address" class="other-input" name="address" required>
                        </div>
                    </div>

                </div>

                <div class="form-row split">

                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-position">{{ transWord('Position') }}</label>
                        <select name="position" id="profile-position" required>
                            <option value="">{{ transWord('Select Position') }}</option>
                              @foreach (getPosition() as $index => $position)
                                <option value="{{ $index }}">{{ $position }}</option>
                              @endforeach
                        </select>
                        </div>
                    </div>

                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-start">{{ transWord('Start Date') }}</label>
                        <input type="date" id="profile-start" class="other-input" name="start_date" required>
                        </div>
                    </div>

                    <div class="form-item" id="endDate">
                        <div class="form-input small active">
                        <label for="profile-end">{{ transWord('End Date') }}</label>
                        <input type="date" id="profile-end" class="other-input" name="end_date">
                        </div>
                    </div>

                    <div class="form-item">
                        <div class="form-input small active">
                            <div class="form-switch">
                                <div class="form-switch-button"></div>
                            </div>
                            <b>{{ transWord('Till Now') }}</b>
                        </div>
                    </div>


                </div>

                <div class="form-row split">

                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-bio">{{ transWord('BIO') }}</label>
                        <textarea name="bio" id="profile-bio" cols="30" rows="10" required></textarea>
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
