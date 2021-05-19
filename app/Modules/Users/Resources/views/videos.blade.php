@extends('layouts.master')

@section('title',$title)

@section('aboutme','active')

@section('content')

<div class="content-grid" style="transform: translate(0px, 0px); transition: transform 0.4s ease-in-out 0s;">


    @include('Users::components.profile')



    <div class="grid grid-12">

      <div class="grid-column">
        <!-- WIDGET BOX -->
        <div class="widget-box">

          <p class="widget-box-title">{{ transWord('Videos') }}</p>
          <!-- /WIDGET BOX TITLE -->

          <!-- WIDGET BOX CONTENT -->
          <div class="widget-box-content">
            <!-- INFORMATION BLOCK LIST -->
            <div class="information-block-list">
              <!-- INFORMATION BLOCK -->
              <div class="information-block">
                <!-- INFORMATION BLOCK TITLE -->
                <div class="row">
                    @foreach ($videos as $video)
                        <div class="col-lg-4">
                            <video width="400" controls style="width: 100%; height: 250px;">
                                <source src="{{ asset('uploads/videos/'.$video->video) }}" id="video_here">
                                  Your browser does not support HTML5 video.
                            </video>
                            @if (Auth::user()->id == $video->user_id)
                            @can('delete_videos')
                            <a href="{{ route('delete_videos',Crypt::encrypt($video->id)) }}" onclick="return confirm('Are Your Sure?')" class="btn btn-danger btn-block">
                                <svg class="section-menu-item-icon icon-delete">
                                    <use xlink:href="#svg-delete"></use>
                                </svg>
                                &nbsp;{{ transWord('delete') }}
                            </a>
                            @endcan
                            @endif
                        </div>
                    @endforeach
                </div>

              </div>

            </div>
            <!-- /INFORMATION BLOCK LIST -->
          </div>
          <!-- /WIDGET BOX CONTENT -->
        </div>
      </div>

    </div>
    <!-- /GRID -->
  </div>
  @endsection

  @section('javascript')

  @endsection
