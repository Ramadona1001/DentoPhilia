@extends('backend.layouts.master')

@section('title',transWord('Create New Services'))

@section('stylesheet')

@endsection

@section('content')

@include('backend.components.errors')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>{{ transWord('Create New Services') }}</h2>
                <ul class="header-dropdown dropdown">

                    <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('services') }}"><i class="icon-book-open"></i> {{ transWord('All Services') }}</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <h3>{{ transWord('Fill Services Data') }}</h3>
                <hr>
                <form action="{{ route('store_services') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                    {!! BuildFields('title' , null , 'text' ,['required' => 'required']) !!}
                    </div>
                    <hr>

                    <h3>{{ transWord('Choose Icon') }}</h3>
                    @php($icons = ["flaticon-consulting","flaticon-investment","flaticon-group","flaticon-certificate","flaticon-career","flaticon-shopping-cart","flaticon-route","flaticon-online-education","flaticon-meeting","flaticon-online-class","flaticon-expert","flaticon-certificate-1","flaticon-instructor","flaticon-instructor-1","flaticon-online","flaticon-skills","flaticon-play-button","flaticon-loupe","flaticon-magnifying-glass","flaticon-loupe-1","flaticon-cancel","flaticon-balance","flaticon-pin","flaticon-call","flaticon-email","flaticon-left-arrow","flaticon-right-arrow"])
                    <div class="col-lg-12">
                        <div class="row">
                            @foreach ($icons as $icon)
                                <div class="col-lg-2" style="border: 1px solid #a5a8ad54; border-radius: 5px; text-align: center;font-size: 46px;">
                                    <input type="radio" name="icon" id="{{ $icon }}" value="{{ $icon }}" style="width: 20px; height: 20px;"><br>
                                    <label for="{{ $icon }}">
                                        <i class="{{ $icon }}"></i>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <hr>
                    <button type="submit" class="btn btn-primary"><i class="icon-plus"></i>&nbsp;{{ transWord('Save') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
@endsection
