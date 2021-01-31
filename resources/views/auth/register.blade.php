@extends('layouts.auth')
@section('title',transWord('Create Account'))
@section('content')

<div class="landing">

    <div class="landing-info">

        <p class="landing-info-text">
            @if ($errors->any())
                <div class="alert alert-danger">
                <h5>{{ transWord('Please Fix Errors') }}</h6>
                @foreach ($errors->all() as $error)
                    <h6>{{ $error }}</h6>
                @endforeach
                </div>
            @endif
        </p>
        <!-- /LANDING INFO TEXT -->

      </div>

    <div class="landing-form">

      <div class="form-box login-register-form-element">
        <h2 class="form-box-title">{{ transWord('Sign Up') }}</h2>


        <!-- FORM -->
        <form class="form" method="get" action="{{ route('register_account') }}" style="margin-top: 30px;">
          <!-- FORM ROW -->

          <div class="form-row">
            <div class="col-lg-6">
                <div class="form-input">
                    <label for="register-name">{{ transWord('Your Name') }}</label>
                    <input type="text" id="register-name" name="name" required>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-input">
                    <label for="register-username">{{ transWord('Username') }}</label>
                    <input type="text" id="register-username" name="username" required>
                </div>
            </div>
          </div>

          <div class="form-row">
            <div class="col-lg-12">
                <div class="form-input">
                    <label for="register-email">{{ transWord('Your Email') }}</label>
                    <input type="email" id="register-email" name="email" required>
                  </div>
            </div>
          </div>


          <!-- /FORM ROW -->

          <!-- FORM ROW -->
          <div class="form-row">
              <div class="col-lg-6">
                <div class="form-input">
                    <label for="register-password">{{ transWord('Password') }}</label>
                    <input type="password" id="register-password" name="password" required>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-input">
                    <label for="register-password-repeat">{{ transWord('Confirm Password') }}</label>
                    <input type="password" id="register-password-repeat" name="password_confirmation" required>
                  </div>
              </div>
          </div>

          <div class="form-row">
            <div class="col-lg-6">
              <div class="form-input">
                <select name="gender" id="register-gender" required>
                    <option value="">{{ transWord('Select Gender') }}</option>
                      @foreach (getGender() as $index => $gender)
                        <option value="{{ $index }}">{{ $gender }}</option>
                      @endforeach
                </select>
              </div>
            </div>

            <div class="col-lg-6">
                <div class="form-input">
                  <select name="type" id="register-role" required>
                      <option value="">{{ transWord('Select Role') }}</option>
                      @foreach (getRoles() as $role)
                        <option value="{{ $role }}">{{ $role }}</option>
                      @endforeach
                  </select>
                </div>
              </div>
        </div>
          <!-- /FORM ROW -->

          <div class="form-row">
            <!-- FORM ITEM -->
            <div class="form-item">
              <!-- BUTTON -->
              <button class="button medium primary">{{ transWord('Register Now') }}</button>
              <!-- /BUTTON -->
            </div>
            <!-- /FORM ITEM -->
          </div>
          <!-- /FORM ROW -->
        </form>
        <!-- /FORM -->

        <!-- LINED TEXT -->
        <p class="lined-text">{{ transWord('Have an account?') }} - <a href="{{ url('/login') }}">{{ transWord('SignIn') }}</a></p>
        <!-- /LINED TEXT -->


        <!-- /SOCIAL LINKS -->
      </div>

    </div>

</div>


@endsection
