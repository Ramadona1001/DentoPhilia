@extends('backend.layouts.master')

@section('title',transWord('Show Category Data'))

@section('stylesheet')

@endsection

@section('content')

@include('backend.components.errors')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>{{ transWord('Show Category Data') }}</h2>
                <ul class="header-dropdown dropdown">

                    <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('edit_categories',Crypt::encrypt($categories->id)) }}"><i class="fa fa-edit"></i> {{ transWord('Edit Data') }}</a></li>
                            <li><a href="{{ route('destroy_categories',Crypt::encrypt($categories->id)) }}" onclick="return confirm('{{ transWord('Are You Sure?') }}')"><i class="fa fa-trash"></i> {{ transWord('Delete Data') }}</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <h3>{{ transWord('Show Category Data') }}</h3>
                <hr>
                    <img class="rounded-circle" width="50px" height="50px" src="{{ asset('uploads/backend/categories/'.$categories->image) }}" style="display: block; margin-left: auto; margin-right: auto; width: 150px; height: 150px;" alt="{{ getDataFromJsonByLanguage($categories->title) }}" title="{{ getDataFromJsonByLanguage($categories->title) }}" class="img-responsive img-thumbnail">
                <hr>

                <div class="row">
                    <div class="col-lg-12"><h5>{{ transWord('Title') }}: {{ getDataFromJsonByLanguage($categories->title) }}</h5></div>
                    <div class="col-lg-12"><h5>{{ transWord('Slug') }}: {{ getDataFromJsonByLanguage($categories->slug) }}</h5></div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <h5>{{ transWord('Content') }}</h5>
                        {!! getDataFromJsonByLanguage($categories->content) !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<hr>
<h2 style="text-align: center">{{ transWord('All Courses') }}</h2>
<div class="row clearfix">
    @foreach ($courses as $course)
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card w_card3">
            <div class="body">
                <div class="text-center">
                    <img class="rounded-circle" width="50px" height="50px" src="{{ asset('uploads/backend/courses/'.$course->image) }}" style="display: block; margin-left: auto; margin-right: auto; width: 150px; height: 150px;" alt="{{ getDataFromJsonByLanguage($course->title) }}" title="{{ getDataFromJsonByLanguage($course->title) }}" class="img-responsive img-thumbnail">
                    <h5 class="m-t-20 mb-0">{{ getDataFromJsonByLanguage($course->title) }}</h5>
                    <br>
                    <a href="{{ route('show_courses',Crypt::encrypt($course->id)) }}" class="btn btn-info btn-round">{{ transWord('View') }}</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

@section('javascript')

@endsection
