@extends('backend.layouts.master')

@section('title',$title)

@section('stylesheet')

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
                            <li><a href="{{ route('edit_course_sections',Crypt::encrypt($courseSection->id)) }}"><i class="fa fa-edit"></i> {{ transWord('Edit Quiz') }}</a></li>
                            <li><a href="{{ route('destroy_course_sections',Crypt::encrypt($courseSection->id)) }}" onclick="return confirm('{{ transWord('Are You Sure?') }}')"><i class="fa fa-trash"></i> {{ transWord('Delete Quiz') }}</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body" id="quiz">
                <h3>{{ getDataFromJsonByLanguage($courseSection->title) }}</h3>
                <hr>
                <p>{{ transWord('Title') }}:&nbsp;{{ getDataFromJsonByLanguage($courseSection->title) }}</p>
                <p>{{ transWord('Content') }}:&nbsp;
                    <div style="background: #22252a; padding: 10px; border: 1px solid;">{!! getDataFromJsonByLanguage($courseSection->content) !!}</div>
                </p>
                <p>{{ transWord('Course') }}:&nbsp;<a href="route('show_courses',Crypt::encrypt($courseSection->courses->id))">{{ getDataFromJsonByLanguage($courseSection->courses->title) }}</a></p>
                <p>
                    @if ($courseSection->publish == 1)
                    <span class="badge badge-primary" style="font-weight: bold;">{{ transWord('Publish') }}</span>
                    @else
                    <span class="badge badge-danger" style="font-weight: bold;">{{ transWord('Un Publish') }}</span>
                    @endif
                </p>
                <hr>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')

@endsection
