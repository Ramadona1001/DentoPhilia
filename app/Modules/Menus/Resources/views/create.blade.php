@extends('backend.layouts.master')

@section('title',transWord('Create New Menu'))

@section('stylesheet')

@endsection

@section('content')

@include('backend.components.errors')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>{{ transWord('Create New Menu') }}</h2>
                <ul class="header-dropdown dropdown">

                    <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('menus') }}"><i class="icon-book-open"></i> {{ transWord('All Menu') }}</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <h3>{{ transWord('Fill Menu Data') }}</h3>
                <hr>
                <form action="{{ route('store_menus') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                    {!! BuildFields('title' , null , 'text' ,['required' => 'required']) !!}
                    </div>
                    <hr>
                    <div class="row">
                        
                        <div class="col-lg-6">
                            <label for="parent">{{ transWord('Parent') }}</label>
                            <select name="parent" id="parent" class="form-control">
                                <option value="">{{ transWord('Select Parent') }}</option>
                                @foreach ($parents as $parent)
                                    <option value="{{ $parent->id }}">{{ getDataFromJsonByLanguage($parent->title) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-6">
                            <label for=""></label>
                            <div class="alert alert-warning" role="alert"><strong>{{ transWord('If you do not choose parent this menu with be root') }}</strong></div>
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
