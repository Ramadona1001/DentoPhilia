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
          <h2 class="section-title" style="display: flex;">{{ $title }}
            @can('create_cases_'.$type)
            &nbsp;&nbsp;
            <a href="{{ route('create_doctor_cases',['type'=>$type]) }}" class="text-sticker">
                <svg class="text-sticker-icon icon-plus-small">
                  <use xlink:href="#svg-plus-small"></use>
                </svg>
                {{ transWord('Add New') }}
            </a>
            @endcan
            </h2>
        </div>
    </div>



        @foreach ($cases as $index => $case)
        <div class="grid grid-1-1-1-1">
            <div class="widget-box">
                <div class="widget-box-settings">
                <div class="post-settings-wrap" style="position: relative;">
                    <div class="post-settings widget-box-post-settings-dropdown-trigger">
                    <svg class="post-settings-icon icon-more-dots">
                        <use xlink:href="#svg-more-dots"></use>
                    </svg>
                    </div>

                    <div class="simple-dropdown widget-box-post-settings-dropdown" style="position: absolute; z-index: 9999; top: 30px; right: 9px; opacity: 0; visibility: hidden; transform: translate(0px, -20px); transition: transform 0.3s ease-in-out 0s, opacity 0.3s ease-in-out 0s, visibility 0.3s ease-in-out 0s;">
                    @can('update_cases_'.$type)
                    <p class="simple-dropdown-link">
                        <a href="{{ route('edit_doctor_cases',['id'=>Crypt::encrypt($case->id),'type'=>$type]) }}">{{ transWord('Update') }}</a>
                    </p>
                    @endcan

                    @can('delete_cases_'.$type)
                    <p class="simple-dropdown-link">
                        <a onclick="return confirm('{{ transWord('Are your sure?') }}')" href="{{ route('delete_doctor_cases',['id'=>Crypt::encrypt($case->id),'type'=>$type]) }}">{{ transWord('Delete') }}</a>
                    </p>
                    @endcan
                    </div>
                </div>
                </div>

                <p class="widget-box-title">{{ transWord('Case').' '.transWord('No.') }} <span class="highlighted">{{ ($index+1) }}</span></p>
                <div class="widget-box-content">
                    <div class="grid grid-3-3-3-3 centered centered-on-mobile">

                        <a class="album-preview">
                            <figure class="album-preview-image liquid" style="background: url({{ asset('uploads/cases/'.$type.'/'.$case->preoperative_image) }}) center center / cover no-repeat;">
                              <img src="{{ asset('uploads/cases/'.$type.'/'.$case->preoperative_image) }}" alt="album-image-01" style="display: none;">
                            </figure>

                            <p class="text-sticker small negative">{{ transWord('Case').' '.($index+1) }}</p>

                            <div class="album-preview-info">
                              <p class="album-preview-title">{{ $case->preoperative_title }}</p>
                              <p class="album-preview-text">{{ transWord('Pre Operative').' - '.$case->created_at->diffForHumans() }}</p>
                            </div>
                        </a>

                        <a class="album-preview">
                            <figure class="album-preview-image liquid" style="background: url({{ asset('uploads/cases/'.$type.'/'.$case->processingoperative_image) }}) center center / cover no-repeat;">
                              <img src="{{ asset('uploads/cases/'.$type.'/'.$case->processingoperative_image) }}" alt="album-image-01" style="display: none;">
                            </figure>

                            <p class="text-sticker small negative">{{ transWord('Case').' '.($index+1) }}</p>

                            <div class="album-preview-info">
                              <p class="album-preview-title">{{ $case->processingoperative_title }}</p>
                              <p class="album-preview-text">{{ transWord('Processing Operative').' - '.$case->created_at->diffForHumans() }}</p>
                            </div>
                        </a>

                        <a class="album-preview">
                            <figure class="album-preview-image liquid" style="background: url({{ asset('uploads/cases/'.$type.'/'.$case->postoperative_image) }}) center center / cover no-repeat;">
                              <img src="{{ asset('uploads/cases/'.$type.'/'.$case->postoperative_image) }}" alt="album-image-01" style="display: none;">
                            </figure>

                            <p class="text-sticker small negative">{{ transWord('Case').' '.($index+1) }}</p>

                            <div class="album-preview-info">
                              <p class="album-preview-title">{{ $case->postoperative_title }}</p>
                              <p class="album-preview-text">{{ transWord('Post Operative').' - '.$case->created_at->diffForHumans() }}</p>
                            </div>
                        </a>

                        </div>
                </div>
            </div>
        </div>
        @endforeach

        {{ $cases->links() }}


      </div>


</div>


@endsection

@section('javascript')

@endsection
