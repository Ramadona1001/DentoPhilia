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
              <form  method="POST" action="{{ route('complete_profile_post_doctors') }}">
                @csrf

                <div class="form-row split">
                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-name">{{ transWord('Name') }}</label>
                        <input type="text" id="profile-name" value="{{ $doctor->user->name }}" name="name">
                        </div>
                    </div>

                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-email">{{ transWord('Email') }}</label>
                        <p class="not-allow-input">{{ $doctor->user->email }}</p>
                        </div>
                    </div>

                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-username">{{ transWord('Username') }}</label>
                        <p class="not-allow-input">{{ '@'.$doctor->user->username }}</p>
                        </div>
                    </div>
                </div>

                <div class="form-row split">

                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-gender">{{ transWord('Gender') }}</label>
                        <select name="gender" id="profile-gender">
                            <option value="">{{ transWord('Select Gender') }}</option>
                              @foreach (getGender() as $index => $gender)
                              @if ($doctor->user->gender == $index)
                              <option value="{{ $index }}" selected>{{ $gender }}</option>
                              @else
                              <option value="{{ $index }}">{{ $gender }}</option>
                              @endif
                              @endforeach
                        </select>
                        </div>
                    </div>

                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-mobile">{{ transWord('Mobile') }}</label>
                        <input type="number" id="profile-mobile" value="{{ $doctor->mobile }}" class="other-input" name="mobile">
                        </div>
                    </div>


                </div>

                <div class="form-row split">

                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-faculty">{{ transWord('University') }}</label>
                        <input type="text" id="profile-faculty" value="{{ $doctor->faculty }}" class="other-input" name="faculty">
                        </div>
                    </div>

                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-address">{{ transWord('Address') }}</label>
                        <input type="text" id="profile-address" class="other-input" value="{{ $doctor->address }}" name="address">
                        </div>
                    </div>

                </div>

                <div class="form-row split">

                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-position">{{ transWord('Position') }}</label>
                        <select name="position" id="profile-position">
                            <option value="">{{ transWord('Select Position') }}</option>
                              @foreach (getPosition() as $index => $position)
                                @if ($doctor->position == $index)
                                <option value="{{ $index }}" selected>{{ $position }}</option>
                                @else
                                <option value="{{ $index }}">{{ $position }}</option>
                                @endif
                              @endforeach
                        </select>
                        </div>
                    </div>

                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-start">{{ transWord('Start Date') }}</label>
                        <input type="date" id="profile-start" value="{{ $doctor->start_study }}" class="other-input" name="start_date">
                        </div>
                    </div>

                    <div class="form-item" id="endDate">
                        <div class="form-input small active">
                        <label for="profile-end">{{ transWord('End Date') }}</label>
                        <input type="date" id="profile-end" value="{{ $doctor->end_study }}" class="other-input" name="end_date">
                        </div>
                    </div>

                    @php
                    $active = ($doctor->end_study == null) ? 'active' : '';
                    @endphp
                    <div class="form-item">
                        <div class="form-input small active">
                            <div class="form-switch {{ $active }}">
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
                        <textarea name="bio" id="profile-bio" cols="30" rows="10">{{ $doctor->bio }}</textarea>
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
        if ($('.form-switch').hasClass('active')) {
            $('#endDate').fadeOut();
        }
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
