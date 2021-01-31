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
        <form class="dropzone" method="POST" action="{{ route('update_doctor_cases',['id'=>Crypt::encrypt($cases->id),'type'=>$type]) }}" enctype="multipart/form-data">
        @csrf
        <div class="widget-box">
            <p class="widget-box-title">{{ $title }}</p>
                <div class="widget-box-content">

                    <img src="{{ asset('uploads/cases/'.$type.'/'.$cases->preoperative_image) }}" class="img-responsive img-thumbnail" style="width:25%;display:block;margin-left:auto;margin-right:auto;">
                    <br>
                    <div class="form-row split">
                        <div class="form-item">
                            <div class="form-input small active">
                            <label for="preoperative_title">{{ transWord('Pre Operative') }}</label>
                            <input type="text" id="preoperative_title" value="{{ $cases->preoperative_title }}" name="preoperative_title" required>
                            </div>
                        </div>

                        <div class="form-item">
                            <div class="form-input small active">
                            <label for="preoperative_image">{{ transWord('Pre Operative Image') }}</label>
                            <input accept="image/*" type="file" class="other-input" style="height: 47px !important;" id="preoperative_image" name="preoperative_image">
                            </div>
                        </div>
                    </div>

                    <br>
                    <img src="{{ asset('uploads/cases/'.$type.'/'.$cases->processingoperative_image) }}" class="img-responsive img-thumbnail" style="width:25%;display:block;margin-left:auto;margin-right:auto;">
                    <br>

                    <div class="form-row split">
                        <div class="form-item">
                            <div class="form-input small active">
                            <label for="processingoperative_title">{{ transWord('Processing Operative Title') }}</label>
                            <input type="text" id="processingoperative_title" value="{{ $cases->processingoperative_title }}" name="processingoperative_title" required>
                            </div>
                        </div>

                        <div class="form-item">
                            <div class="form-input small active">
                            <label for="processingoperative_image">{{ transWord('Processing Operative Image') }}</label>
                            <input accept="image/*" type="file" class="other-input" style="height: 47px !important;" id="processingoperative_image" name="processingoperative_image">
                            </div>
                        </div>
                    </div>

                    <br>
                    <img src="{{ asset('uploads/cases/'.$type.'/'.$cases->postoperative_image) }}" class="img-responsive img-thumbnail" style="width:25%;display:block;margin-left:auto;margin-right:auto;">
                    <br>

                    <div class="form-row split">
                        <div class="form-item">
                            <div class="form-input small active">
                            <label for="postoperative_title">{{ transWord('Post Operative Title') }}</label>
                            <input type="text" id="postoperative_title" value="{{ $cases->postoperative_title }}" name="postoperative_title" required>
                            </div>
                        </div>

                        <div class="form-item">
                            <div class="form-input small active">
                            <label for="postoperative_image">{{ transWord('Post Operative Image') }}</label>
                            <input accept="image/*" type="file" class="other-input" style="height: 47px !important;" id="postoperative_image" name="postoperative_image">
                            </div>
                        </div>
                    </div>

                </div>
        </div>

        <hr>

        <div class="widget-box">
            <p class="widget-box-title">{{ transWord('Patient Data') }}</p>
                <div class="widget-box-content">

                    <div class="form-row split">
                        <div class="form-item">
                            <div class="form-input small active">
                            <label for="patient_name">{{ transWord('Patient Name') }}</label>
                            <input type="text" id="patient_name" value="{{ $cases->patient_name }}" name="patient_name">
                            </div>
                        </div>

                        <div class="form-item">
                            <div class="form-input small active">
                            <label for="patient_age">{{ transWord('Patient Age') }}</label>
                            <input type="number" min="13" value="{{ $cases->patient_age }}" max="100" step="1" class="other-input" style="height: 47px !important;" id="patient_age" name="patient_age">
                            </div>
                        </div>

                    </div>

                    <div class="form-row split">
                        <div class="form-item">
                            <div class="form-input small active">
                            <label for="dental_history">{{ transWord('Dental History') }}</label>
                            <textarea name="patient_dental_history" id="dental_history" cols="30" rows="10">{{ $cases->dental_history }}</textarea>
                            </div>
                        </div>

                        <div class="form-item">
                            <div class="form-input small active">
                            <label for="medical_history">{{ transWord('Medical History') }}</label>
                            <textarea name="patient_medical_history" id="medical_history" cols="30" rows="10">{{ $cases->medical_history }}</textarea>
                            </div>
                        </div>

                    </div>

                </div>
        </div>

        <hr>

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
    </div>


</div>


@endsection

@section('javascript')
@endsection
