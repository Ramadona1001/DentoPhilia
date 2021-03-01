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
              <form  method="POST" action="{{ route('complete_profile_post_business_accounts') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-row split">
                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-name">{{ transWord('Name') }}</label>
                        <input type="text" id="profile-name" value="{{ $business_account->user->name }}" name="name">
                        </div>
                    </div>

                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-email">{{ transWord('Email') }}</label>
                        <p class="not-allow-input">{{ $business_account->user->email }}</p>
                        </div>
                    </div>

                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-username">{{ transWord('Username') }}</label>
                        <p class="not-allow-input">{{ '@'.$business_account->user->username }}</p>
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
                              @if ($business_account->user->gender == $index)
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
                        <input type="number" id="profile-mobile" value="{{ $business_account->mobile }}" class="other-input" name="mobile">
                        </div>
                    </div>

                    <div class="form-item">
                        <div class="form-input small active">
                        <label for="profile-type">{{ transWord('Type') }}</label>
                        @if ($business_account->type == null)
                        <select name="type" id="profile-type">
                            <option value="">{{ transWord('Select Type') }}</option>
                            @foreach (businessAccountTypes() as $index => $type)
                                <option value="{{ $index }}">{{ $type }}</option>
                            @endforeach
                        </select>
                        @else
                        <p class="not-allow-input">{{ $business_account->type }}</p>
                        @endif
                        </div>
                    </div>


                </div>

                <div class="form-row split">

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

@endsection
