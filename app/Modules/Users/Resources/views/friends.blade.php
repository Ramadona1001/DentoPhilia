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

          <p class="widget-box-title">{{ transWord('Following') }}</p>
          <!-- /WIDGET BOX TITLE -->

          <!-- WIDGET BOX CONTENT -->
          <div class="widget-box-content">
            <!-- INFORMATION BLOCK LIST -->
            <div class="information-block-list">
              <!-- INFORMATION BLOCK -->
              <div class="information-block">
                <!-- INFORMATION BLOCK TITLE -->
                <div class="row">
                    @foreach ($friends as $friend)
                            <div class="col-lg-2">
                                <img style="width: 40px;" src="{{ asset(getUserAvatar($friend->to_user)) }}" alt="" srcset="">
                            </div>
                            <div class="col-lg-10">
                                {{ $friend->user->name }}
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
