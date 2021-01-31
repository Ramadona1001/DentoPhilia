@extends('backend.layouts.master')

@section('title',$title)

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/dropify/css/dropify.min.css') }}">
@endsection

@section('content')

@include('backend.components.errors')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>{{ $title }}</h2>
                <ul class="header-dropdown dropdown">

                    <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('attachments') }}"><i class="icon-book-open"></i> {{ transWord('Attachments') }}</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <h3>{{ transWord('Fill Attachment Data') }}</h3>
                <hr>
                <ul class="nav nav-tabs3">
                    <li class="nav-item"><a class="nav-link show active" data-toggle="tab" href="#Home-new2">{{ transWord('File') }}</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Profile-new2">{{ transWord('Link') }}</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="Home-new2">
                        <h6>{{ transWord('File') }}</h6>
                        <form action="{{ route('store_attachments') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                            {!! BuildFields('title' , null , 'text' ,['required' => 'required']) !!}
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="file">{{ transWord('File') }}</label>
                                    <input type="file" name="file" id="file" class="dropify" required>
                                </div>
                            </div>
                            <input type="hidden" name="type" value="file">
                            <hr>
                            <button type="submit" class="btn btn-primary"><i class="icon-plus"></i>&nbsp;{{ transWord('Save') }}</button>
                        </form>
                    </div>
                    <div class="tab-pane" id="Profile-new2">
                        <h6>{{ transWord('Link') }}</h6>
                        <form action="{{ route('store_attachments') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                            {!! BuildFields('title' , null , 'text' ,['required' => 'required']) !!}
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="url">{{ transWord('Link') }}</label>
                                    <input type="url" name="link" id="url" class="form-control" required placeholder="{{ transWord('Link') }}">
                                </div>
                            </div>
                            <input type="hidden" name="type" value="link">
                            <hr>
                            <button type="submit" class="btn btn-primary"><i class="icon-plus"></i>&nbsp;{{ transWord('Save') }}</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script src="{{ asset('dashboard/assets/vendor/dropify/js/dropify.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/pages/forms/dropify.js') }}"></script>
@endsection
