@if (Auth::user()->hasRole('Doctor'))

@if (count(checkDoctorProfileIsComplete()) > 0)
    <div class="section-filters-bar v7">
      <div class="section-filters-bar-actions">
        <div class="section-filters-bar-info">
          <p class="section-filters-bar-title"><a href="{{ route('complete_profile_doctors') }}">{{ transWord('Please Fill Your Data ') }}</a></p>
          <p class="section-filters-bar-text">{{ transWord('Complete Your Profile') }} <a style="text-transform: uppercase;" class="highlighted" href="{{ route('complete_profile_doctors') }}">{{ implode(' - ',checkDoctorProfileIsComplete()) }}</a></p>
        </div>
      </div>
    </div>
@endif


    {{-- Doctor Cases --}}
    @if (count(checkDoctorProfileIsComplete()) <= 0)
    <br>
    <div class="slider-line medium">

        <div id="reaction-stats-slider-controls" class="slider-controls" aria-label="Carousel Navigation" tabindex="0">

          <div class="slider-control left" aria-controls="reaction-stats-slider" tabindex="-1" data-controls="prev" aria-disabled="false">
            <svg class="slider-control-icon icon-small-arrow">
              <use xlink:href="#svg-small-arrow"></use>
            </svg>
          </div>

          <div class="slider-control right" aria-controls="reaction-stats-slider" tabindex="-1" data-controls="next" aria-disabled="true">
            <svg class="slider-control-icon icon-small-arrow">
              <use xlink:href="#svg-small-arrow"></use>
            </svg>
          </div>
        </div>

        <div class="tns-outer" id="reaction-stats-slider-ow"><div class="tns-liveregion tns-visually-hidden" aria-live="polite" aria-atomic="true">slide <span class="current">2 to 8</span>  of 8</div>
            <div id="reaction-stats-slider-mw" class="tns-ovh">
                <div class="tns-inner" id="reaction-stats-slider-iw">
                    <div id="reaction-stats-slider" class="slider-slides with-separator  tns-slider tns-carousel tns-subpixel tns-calc tns-horizontal" style="transform: translate3d(-139px, 0px, 0px);">

                        @can('show_cases_endo')
                        <div class="slider-slide tns-item" id="reaction-stats-slider-item0" aria-hidden="true" tabindex="-1">
                            <div class="reaction-stat">
                                <img class="reaction-stat-image" src="{{ asset('dento/img/icons/black/endo.png') }}" alt="reaction-like">
                                <p class="reaction-stat-title" style="text-transform: uppercase;">{{ transWord('Endo') }}</p>
                                <p class="reaction-stat-text"><a href="{{ route('all_doctor_cases',['type'=>'endo']) }}">{{ transWord('View') }}</a></p>
                            </div>
                        </div>
                        @endcan

                        @can('show_cases_pedo')
                        <div class="slider-slide tns-item" id="reaction-stats-slider-item1" aria-hidden="true" tabindex="-1">
                            <div class="reaction-stat">
                                <img class="reaction-stat-image" src="{{ asset('dento/img/icons/black/pedo.png') }}" alt="reaction-like">
                                <p class="reaction-stat-title" style="text-transform: uppercase;">{{ transWord('Pedo') }}</p>
                                <p class="reaction-stat-text"><a href="{{ route('all_doctor_cases',['type'=>'pedo']) }}">{{ transWord('View') }}</a></p>
                            </div>
                        </div>
                        @endcan

                        @can('show_cases_ortho')
                        <div class="slider-slide tns-item" id="reaction-stats-slider-item1" aria-hidden="true" tabindex="-1">
                            <div class="reaction-stat">
                                <img class="reaction-stat-image" src="{{ asset('dento/img/icons/black/ortho.png') }}" alt="reaction-like">
                                <p class="reaction-stat-title" style="text-transform: uppercase;">{{ transWord('Ortho') }}</p>
                                <p class="reaction-stat-text"><a href="{{ route('all_doctor_cases',['type'=>'ortho']) }}">{{ transWord('View') }}</a></p>
                            </div>
                        </div>
                        @endcan

                        @can('show_cases_surgery')
                        <div class="slider-slide tns-item" id="reaction-stats-slider-item1" aria-hidden="true" tabindex="-1">
                            <div class="reaction-stat">
                                <img class="reaction-stat-image" src="{{ asset('dento/img/icons/black/surgery.png') }}" alt="reaction-like">
                                <p class="reaction-stat-title" style="text-transform: uppercase;">{{ transWord('Surgery') }}</p>
                                <p class="reaction-stat-text"><a href="{{ route('all_doctor_cases',['type'=>'surgery']) }}">{{ transWord('View') }}</a></p>
                            </div>
                        </div>
                        @endcan

                        @can('show_cases_perio')
                        <div class="slider-slide tns-item" id="reaction-stats-slider-item1" aria-hidden="true" tabindex="-1">
                            <div class="reaction-stat">
                                <img class="reaction-stat-image" src="{{ asset('dento/img/icons/black/perio.png') }}" alt="reaction-like">
                                <p class="reaction-stat-title" style="text-transform: uppercase;">{{ transWord('Perio') }}</p>
                                <p class="reaction-stat-text"><a href="{{ route('all_doctor_cases',['type'=>'perio']) }}">{{ transWord('View') }}</a></p>
                            </div>
                        </div>
                        @endcan

                        @can('show_cases_implants')
                        <div class="slider-slide tns-item" id="reaction-stats-slider-item1" aria-hidden="true" tabindex="-1">
                            <div class="reaction-stat">
                                <img class="reaction-stat-image" src="{{ asset('dento/img/icons/black/implants.jpg') }}" alt="reaction-like">
                                <p class="reaction-stat-title" style="text-transform: uppercase;">{{ transWord('Implants') }}</p>
                                <p class="reaction-stat-text"><a href="{{ route('all_doctor_cases',['type'=>'implants']) }}">{{ transWord('View') }}</a></p>
                            </div>
                        </div>
                        @endcan

                        @can('show_cases_fixedprothesis')
                        <div class="slider-slide tns-item" id="reaction-stats-slider-item1" aria-hidden="true" tabindex="-1">
                            <div class="reaction-stat">
                                <img class="reaction-stat-image" src="{{ asset('dento/img/icons/black/prothesis.png') }}" alt="reaction-like">
                                <p class="reaction-stat-title" style="text-transform: uppercase;">{{ transWord('Fixed Prothesis') }}</p>
                                <p class="reaction-stat-text"><a href="{{ route('all_doctor_cases',['type'=>'fixedprothesis']) }}">{{ transWord('View') }}</a></p>
                            </div>
                        </div>
                        @endcan

                        @can('show_cases_movableprothesis')
                        <div class="slider-slide tns-item" id="reaction-stats-slider-item1" aria-hidden="true" tabindex="-1">
                            <div class="reaction-stat">
                                <img class="reaction-stat-image" src="{{ asset('dento/img/icons/black/prothesis.png') }}" alt="reaction-like">
                                <p class="reaction-stat-title" style="text-transform: uppercase;">{{ transWord('Movable Prothesis') }}</p>
                                <p class="reaction-stat-text"><a href="{{ route('all_doctor_cases',['type'=>'movableprothesis']) }}">{{ transWord('View') }}</a></p>
                            </div>
                        </div>
                        @endcan

                        @can('show_cases_operative')
                        <div class="slider-slide tns-item" id="reaction-stats-slider-item1" aria-hidden="true" tabindex="-1">
                            <div class="reaction-stat">
                                <img class="reaction-stat-image" src="{{ asset('dento/img/icons/black/operative.png') }}" alt="reaction-like">
                                <p class="reaction-stat-title" style="text-transform: uppercase;">{{ transWord('Operative') }}</p>
                                <p class="reaction-stat-text"><a href="{{ route('all_doctor_cases',['type'=>'operative']) }}">{{ transWord('View') }}</a></p>
                            </div>
                        </div>
                        @endcan

                        @can('show_cases_dental_photography')
                        <div class="slider-slide tns-item" id="reaction-stats-slider-item1" aria-hidden="true" tabindex="-1">
                            <div class="reaction-stat">
                                <img class="reaction-stat-image" src="{{ asset('dento/img/icons/black/camera.png') }}" alt="reaction-like">
                                <p class="reaction-stat-title" style="text-transform: uppercase;">{{ transWord('Dental Photography') }}</p>
                                <p class="reaction-stat-text"><a href="{{ route('all_doctor_cases',['type'=>'dental_photography']) }}">{{ transWord('View') }}</a></p>
                            </div>
                        </div>
                        @endcan

                        @can('show_cases_dental_designer')
                        <div class="slider-slide tns-item" id="reaction-stats-slider-item1" aria-hidden="true" tabindex="-1">
                            <div class="reaction-stat">
                                <img class="reaction-stat-image" src="{{ asset('dento/img/icons/black/designer.png') }}" alt="reaction-like">
                                <p class="reaction-stat-title" style="text-transform: uppercase;">{{ transWord('Dental Designer') }}</p>
                                <p class="reaction-stat-text"><a href="{{ route('all_doctor_cases',['type'=>'dental_designer']) }}">{{ transWord('View') }}</a></p>
                            </div>
                        </div>
                        @endcan



                    </div>
                </div>
            </div>


        </div>
    </div>

    @endif

@endif
