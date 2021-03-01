@extends('layouts.master')

@section('title',$title)

@section('cases','active')

@section('content')

<div class="content-grid" style="transform: translate(0px, 0px); transition: transform 0.4s ease-in-out 0s;">

    @include('Doctors::profile.components.profile')

    <div class="grid grid-12">

        @foreach ($casesTypes as $type)
        <div class="grid-column">


            <!-- WIDGET BOX -->
            <div class="widget-box">
              <!-- WIDGET BOX SETTINGS -->
              <div class="widget-box-settings">
                <!-- POST SETTINGS WRAP -->
                <div class="post-settings-wrap" style="position: relative;">
                  <!-- POST SETTINGS -->
                  <div class="post-settings widget-box-post-settings-dropdown-trigger">
                    <!-- POST SETTINGS ICON -->
                    <svg class="post-settings-icon icon-more-dots">
                      <use xlink:href="#svg-more-dots"></use>
                    </svg>
                    <!-- /POST SETTINGS ICON -->
                  </div>
                  <!-- /POST SETTINGS -->

                  <!-- SIMPLE DROPDOWN -->
                  <div class="simple-dropdown widget-box-post-settings-dropdown" style="position: absolute; z-index: 9999; top: 30px; right: 9px; opacity: 0; visibility: hidden; transform: translate(0px, -20px); transition: transform 0.3s ease-in-out 0s, opacity 0.3s ease-in-out 0s, visibility 0.3s ease-in-out 0s;">
                    <!-- SIMPLE DROPDOWN LINK -->
                    <p class="simple-dropdown-link">#</p>
                    <!-- /SIMPLE DROPDOWN LINK -->
                  </div>
                  <!-- /SIMPLE DROPDOWN -->
                </div>
                <!-- /POST SETTINGS WRAP -->
              </div>
              <!-- /WIDGET BOX SETTINGS -->

              <p class="widget-box-title">{{ Str::ucfirst($type).' '.transWord('Cases') }}</p>

              <!-- WIDGET BOX CONTENT -->
              <div class="widget-box-content">
                <!-- INFORMATION BLOCK LIST -->
                <div class="information-block-list">
                  <!-- INFORMATION BLOCK -->
                  <div class="information-block">

                    @foreach ($cases as $index => $case)
                        @if ($case->type == $type)
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
                        @endif
                    @endforeach

                  </div>

                </div>
                <!-- /INFORMATION BLOCK LIST -->
              </div>
              <!-- /WIDGET BOX CONTENT -->
            </div>
            <!-- /WIDGET BOX -->
          </div>
        @endforeach



    </div>
    <!-- /GRID -->
  </div>
  @endsection

  @section('javascript')

  @endsection
