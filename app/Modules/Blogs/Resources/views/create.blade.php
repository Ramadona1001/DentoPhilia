@extends('layouts.master')

@section('title',$title)

@section('stylesheet')

@endsection

@section('content')

@include('components.errors')
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
        <form class="dropzone" method="POST" action="{{ route('store_blogs') }}" enctype="multipart/form-data">
        @csrf
        <div class="widget-box">
            <p class="widget-box-title">{{ $title }}</p>
                <div class="widget-box-content">

                    <div class="form-row split">
                        {!! BuildField('title' , null , 'text' ,['required' => 'required']) !!}
                    </div>
                    <div class="form-row split">
                        {!! BuildField('tags' , null , 'text' ,['required' => 'required']) !!}
                    </div>
                    <div class="form-row split">
                        {!! BuildField('meta_title' , null , 'text') !!}
                    </div>
                    <div class="form-row split">
                        {!! BuildField('meta_desc' , null , 'text') !!}
                    </div>
                    <div class="form-row split">
                        {!! BuildField('meta_keywords' , null , 'text') !!}
                    </div>
                    <div class="form-row split">
                        {!! BuildField('content' , null , 'textarea' , ['required' => 'required']) !!}
                    </div>

                    <div class="form-row split">
                        <div class="form-item">
                            <label for="blog_img">{{ transWord('Blog Image') }}</label>
                            <input accept="image/*" type="file" class="other-input" style="height: 47px !important;" id="blog_img" name="blog_img" required>
                        </div>
                    </div>

                    <div class="form-row split">
                        <div class="form-item">
                            <select name="publish" id="publish" class="form-control" required>
                                <option value="">{{ transWord('Please Select Publish Status') }}</option>
                                <option value="1">{{ transWord('Publish') }}</option>
                                <option value="2">{{ transWord('Unpublish') }}</option>
                            </select>
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
