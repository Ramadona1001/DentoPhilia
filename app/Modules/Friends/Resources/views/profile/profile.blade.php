@extends('layouts.master')

@section('title',$title)

@section('aboutme','active')

@section('content')

<div class="content-grid" style="transform: translate(0px, 0px); transition: transform 0.4s ease-in-out 0s;">

    @include('Doctors::profile.components.profile')

    <div class="grid grid-3-6-3">
      <div class="grid-column">

        <div class="widget-box">
          <div class="widget-box-settings">
            <div class="post-settings-wrap" style="position: relative;">
              <div class="post-settings widget-box-post-settings-dropdown-trigger">
                <svg class="post-settings-icon icon-more-dots">
                  <use xlink:href="#svg-more-dots"></use>
                </svg>
              </div>

              <div class="simple-dropdown widget-box-post-settings-dropdown" style="position: absolute; z-index: 9999; top: 30px; right: 9px; opacity: 0; visibility: hidden; transform: translate(0px, -20px); transition: transform 0.3s ease-in-out 0s, opacity 0.3s ease-in-out 0s, visibility 0.3s ease-in-out 0s;">
                <p class="simple-dropdown-link">{{ transWord('Edit Profile') }}</p>
              </div>

            </div>
          </div>

          <p class="widget-box-title">{{ transWord('About Me') }}</p>

          <div class="widget-box-content">
            <p class="paragraph" style="text-align:center;font-weight:bold;">{{ $doctor->user->name }}</p>

            <div class="information-line-list">
              <div class="information-line">
                <p class="information-line-title">{{ transWord('Joined') }}</p>
                <p class="information-line-text">{{ $doctor->user->created_at->diffForHumans() }}</p>
              </div>


              <div class="information-line">
                <p class="information-line-title">{{ transWord('Mobile') }}</p>
                <p class="information-line-text">{{ $doctor->mobile }}</p>
              </div>

              <div class="information-line">
                <p class="information-line-title">{{ transWord('Address') }}</p>
                <p class="information-line-text">{{ $doctor->address }}</p>
              </div>

              <div class="information-line">
                <p class="information-line-title">{{ transWord('Gender') }}</p>
                <p class="information-line-text">{{ $doctor->user->gender }}</p>
              </div>

              <div class="information-line">
                <p class="information-line-title">{{ transWord('Email') }}</p>
                <p class="information-line-text"><a href="mailto:{{ $doctor->user->email }}">{{ $doctor->user->email }}</a></p>
              </div>

            </div>

            <!-- /INFORMATION LINE LIST -->
          </div>
          <!-- /WIDGET BOX CONTENT -->
        </div>

        <div class="widget-box">
            <div class="widget-box-settings">
              <div class="post-settings-wrap" style="position: relative;">
                <div class="post-settings widget-box-post-settings-dropdown-trigger">
                  <svg class="post-settings-icon icon-more-dots">
                    <use xlink:href="#svg-more-dots"></use>
                  </svg>
                </div>

                <div class="simple-dropdown widget-box-post-settings-dropdown" style="position: absolute; z-index: 9999; top: 30px; right: 9px; opacity: 0; visibility: hidden; transform: translate(0px, -20px); transition: transform 0.3s ease-in-out 0s, opacity 0.3s ease-in-out 0s, visibility 0.3s ease-in-out 0s;">
                  <p class="simple-dropdown-link">{{ transWord('Edit Profile') }}</p>
                </div>

              </div>
            </div>

            <p class="widget-box-title">{{ transWord('About Me') }}</p>

            <div class="widget-box-content">

              <div class="information-line-list">

                <div class="information-line">
                    <p class="information-line-title">{{ transWord('University') }}</p>
                    <p class="information-line-text">{{ $doctor->faculty }}</p>
                  </div>

                  <div class="information-line">
                      <p class="information-line-title">{{ transWord('Study Start') }}</p>
                      <p class="information-line-text">{{ $doctor->start_study }}</p>
                  </div>

                  <div class="information-line">
                      <p class="information-line-title">{{ transWord('Study End') }}</p>
                      @if ($doctor->end_study == null)
                      <p class="information-line-text">{{ transWord('Till Now') }}</p>
                      @else
                      <p class="information-line-text">{{ $doctor->end_study }}</p>
                      @endif
                  </div>

              </div>

              <!-- /INFORMATION LINE LIST -->
            </div>
            <!-- /WIDGET BOX CONTENT -->
          </div>

      </div>
      <!-- /GRID COLUMN -->

      <!-- GRID COLUMN -->
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
                <p class="simple-dropdown-link">Widget Settings</p>
                <!-- /SIMPLE DROPDOWN LINK -->
              </div>
              <!-- /SIMPLE DROPDOWN -->
            </div>
            <!-- /POST SETTINGS WRAP -->
          </div>
          <!-- /WIDGET BOX SETTINGS -->

          <!-- WIDGET BOX TITLE -->
          <p class="widget-box-title">{{ transWord('BIO') }}</p>
          <!-- /WIDGET BOX TITLE -->

          <!-- WIDGET BOX CONTENT -->
          <div class="widget-box-content">
            <!-- INFORMATION BLOCK LIST -->
            <div class="information-block-list">
              <!-- INFORMATION BLOCK -->
              <div class="information-block">
                <!-- INFORMATION BLOCK TITLE -->
                <p class="information-block-title">
                    {{ $doctor->bio }}
                </p>

              </div>

            </div>
            <!-- /INFORMATION BLOCK LIST -->
          </div>
          <!-- /WIDGET BOX CONTENT -->
        </div>
        <!-- /WIDGET BOX -->

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
                <p class="simple-dropdown-link">Widget Settings</p>
                <!-- /SIMPLE DROPDOWN LINK -->
              </div>
              <!-- /SIMPLE DROPDOWN -->
            </div>
            <!-- /POST SETTINGS WRAP -->
          </div>
          <!-- /WIDGET BOX SETTINGS -->

          <!-- WIDGET BOX TITLE -->
          <p class="widget-box-title">Jobs &amp; Education</p>
          <!-- /WIDGET BOX TITLE -->

          <!-- WIDGET BOX CONTENT -->
          <div class="widget-box-content">
            <!-- TIMELINE INFORMATION LIST -->
            <div class="timeline-information-list">
              <!-- TIMELINE INFORMATION -->
              <div class="timeline-information">
                <!-- TIMELINE INFORMATION TITLE -->
                <p class="timeline-information-title">Lead Costume Designer</p>
                <!-- /TIMELINE INFORMATION TITLE -->

                <!-- TIMELINE INFORMATION DATE -->
                <p class="timeline-information-date">2015 - NOW</p>
                <!-- /TIMELINE INFORMATION DATE -->

                <!-- TIMELINE INFORMATION TEXT -->
                <p class="timeline-information-text">Lead Costume Designer for the "Amazzo Costumes" agency. I'm in charge of a ten person group, overseeing all the proyects and talking to potential clients. I also handle some face to face interviews for new candidates.</p>
                <!-- /TIMELINE INFORMATION TEXT -->
              </div>
              <!-- /TIMELINE INFORMATION -->

              <!-- TIMELINE INFORMATION -->
              <div class="timeline-information">
                <!-- TIMELINE INFORMATION TITLE -->
                <p class="timeline-information-title">Costume Designer</p>
                <!-- /TIMELINE INFORMATION TITLE -->

                <!-- TIMELINE INFORMATION DATE -->
                <p class="timeline-information-date">2013 - 2015</p>
                <!-- /TIMELINE INFORMATION DATE -->

                <!-- TIMELINE INFORMATION TEXT -->
                <p class="timeline-information-text">Costume Designer for the "Jenny Taylors" agency. Was in charge of working side by side with the best designers in order to complete and perfect orders.</p>
                <!-- /TIMELINE INFORMATION TEXT -->
              </div>
              <!-- /TIMELINE INFORMATION -->

              <!-- TIMELINE INFORMATION -->
              <div class="timeline-information">
                <!-- TIMELINE INFORMATION TITLE -->
                <p class="timeline-information-title">Designer Intern</p>
                <!-- /TIMELINE INFORMATION TITLE -->

                <!-- TIMELINE INFORMATION DATE -->
                <p class="timeline-information-date">2012 - 2013</p>
                <!-- /TIMELINE INFORMATION DATE -->

                <!-- TIMELINE INFORMATION TEXT -->
                <p class="timeline-information-text">Intern for the "Jenny Taylors" agency. Was in charge of the communication with the clients and day-to-day chores.</p>
                <!-- /TIMELINE INFORMATION TEXT -->
              </div>
              <!-- /TIMELINE INFORMATION -->

              <!-- TIMELINE INFORMATION -->
              <div class="timeline-information">
                <!-- TIMELINE INFORMATION TITLE -->
                <p class="timeline-information-title">The Antique College of Design</p>
                <!-- /TIMELINE INFORMATION TITLE -->

                <!-- TIMELINE INFORMATION DATE -->
                <p class="timeline-information-date">2007 - 2012</p>
                <!-- /TIMELINE INFORMATION DATE -->

                <!-- TIMELINE INFORMATION TEXT -->
                <p class="timeline-information-text">Bachelor of Costume Design in the Antique College. It was a five years intensive career, plus a course about Cosplays. Average: A+</p>
                <!-- /TIMELINE INFORMATION TEXT -->
              </div>
              <!-- /TIMELINE INFORMATION -->
            </div>
            <!-- /TIMELINE INFORMATION LIST -->
          </div>
          <!-- /WIDGET BOX CONTENT -->
        </div>
        <!-- /WIDGET BOX -->
      </div>
      <!-- /GRID COLUMN -->

      <!-- GRID COLUMN -->
      <div class="grid-column">
        <!-- WIDGET BOX -->
        <div class="widget-box">
          <!-- PROGRESS ARC SUMMARY -->
          <div class="progress-arc-summary">
            <!-- PROGRESS ARC WRAP -->
            <div class="progress-arc-wrap">
              <!-- PROGRESS ARC -->
              <div class="progress-arc"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                <canvas id="profile-completion-chart" style="display: block; width: 140px; height: 140px;" width="140" height="140" class="chartjs-render-monitor"></canvas>
              </div>
              <!-- PROGRESS ARC -->

              <!-- PROGRESS ARC INFO -->
              <div class="progress-arc-info">
                <!-- PROGRESS ARC TITLE -->
                <p class="progress-arc-title">59%</p>
                <!-- /PROGRESS ARC TITLE -->
              </div>
              <!-- /PROGRESS ARC INFO -->
            </div>
            <!-- /PROGRESS ARC WRAP -->

            <!-- PROGRESS ARC SUMMARY INFO -->
            <div class="progress-arc-summary-info">
              <!-- PROGRESS ARC SUMMARY TITLE -->
              <p class="progress-arc-summary-title">Profile Completion</p>
              <!-- /PROGRESS ARC SUMMARY TITLE -->

              <!-- PROGRESS ARC SUMMARY TITLE -->
              <p class="progress-arc-summary-subtitle">Marina Valentine</p>
              <!-- /PROGRESS ARC SUMMARY TITLE -->

              <!-- PROGRESS ARC SUMMARY TITLE -->
              <p class="progress-arc-summary-text">Complete your profile by filling profile info fields, completing quests &amp; unlocking badges</p>
              <!-- /PROGRESS ARC SUMMARY TITLE -->
            </div>
            <!-- /PROGRESS ARC SUMMARY INFO -->
          </div>
          <!-- /PROGRESS ARC SUMMARY -->

          <!-- ACHIEVEMENT STATUS LIST -->
          <div class="achievement-status-list">
            <!-- ACHIEVEMENT STATUS -->
            <div class="achievement-status">
              <!-- ACHIEVEMENT STATUS PROGRESS -->
              <p class="achievement-status-progress">11/30</p>
              <!-- /ACHIEVEMENT STATUS PROGRESS -->

              <!-- ACHIEVEMENT STATUS INFO -->
              <div class="achievement-status-info">
                <!-- ACHIEVEMENT STATUS TITLE -->
                <p class="achievement-status-title">Quests</p>
                <!-- /ACHIEVEMENT STATUS TITLE -->

                <!-- ACHIEVEMENT STATUS TEXT -->
                <p class="achievement-status-text">Completed</p>
                <!-- /ACHIEVEMENT STATUS TEXT -->
              </div>
              <!-- /ACHIEVEMENT STATUS INFO -->

              <!-- ACHIEVEMENT STATUS IMAGE -->
              <img class="achievement-status-image" src="img/badge/completedq-s.png" alt="bdage-completedq-s">
              <!-- /ACHIEVEMENT STATUS IMAGE -->
            </div>
            <!-- /ACHIEVEMENT STATUS -->

            <!-- ACHIEVEMENT STATUS -->
            <div class="achievement-status">
              <!-- ACHIEVEMENT STATUS PROGRESS -->
              <p class="achievement-status-progress">22/46</p>
              <!-- /ACHIEVEMENT STATUS PROGRESS -->

              <!-- ACHIEVEMENT STATUS INFO -->
              <div class="achievement-status-info">
                <!-- ACHIEVEMENT STATUS TITLE -->
                <p class="achievement-status-title">Badges</p>
                <!-- /ACHIEVEMENT STATUS TITLE -->

                <!-- ACHIEVEMENT STATUS TEXT -->
                <p class="achievement-status-text">Unlocked</p>
                <!-- /ACHIEVEMENT STATUS TEXT -->
              </div>
              <!-- /ACHIEVEMENT STATUS INFO -->

              <!-- ACHIEVEMENT STATUS IMAGE -->
              <img class="achievement-status-image" src="img/badge/unlocked-badge.png" alt="bdage-unlocked-badge">
              <!-- /ACHIEVEMENT STATUS IMAGE -->
            </div>
            <!-- /ACHIEVEMENT STATUS -->
          </div>
          <!-- /ACHIEVEMENT STATUS LIST -->
        </div>
        <!-- /WIDGET BOX -->

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
                <p class="simple-dropdown-link">Widget Settings</p>
                <!-- /SIMPLE DROPDOWN LINK -->
              </div>
              <!-- /SIMPLE DROPDOWN -->
            </div>
            <!-- /POST SETTINGS WRAP -->
          </div>
          <!-- /WIDGET BOX SETTINGS -->

          <!-- WIDGET BOX TITLE -->
          <p class="widget-box-title">More Stats</p>
          <!-- /WIDGET BOX TITLE -->

          <!-- WIDGET BOX CONTENT -->
          <div class="widget-box-content">
            <!-- STAT BLOCK LIST -->
            <div class="stat-block-list">
              <!-- STAT BLOCK -->
              <div class="stat-block">
                <!-- STAT BLOCK DECORATION -->
                <div class="stat-block-decoration">
                  <!-- STAT BLOCK DECORATION ICON -->
                  <svg class="stat-block-decoration-icon icon-friend">
                    <use xlink:href="#svg-friend"></use>
                  </svg>
                  <!-- /STAT BLOCK DECORATION ICON -->
                </div>
                <!-- /STAT BLOCK DECORATION -->

                <!-- STAT BLOCK INFO -->
                <div class="stat-block-info">
                  <!-- STAT BLOCK TITLE -->
                  <p class="stat-block-title">Last friend added</p>
                  <!-- /STAT BLOCK TITLE -->

                  <!-- STAT BLOCK TEXT -->
                  <p class="stat-block-text">5 Days Ago</p>
                  <!-- /STAT BLOCK TEXT -->
                </div>
                <!-- /STAT BLOCK INFO -->
              </div>
              <!-- /STAT BLOCK -->

              <!-- STAT BLOCK -->
              <div class="stat-block">
                <!-- STAT BLOCK DECORATION -->
                <div class="stat-block-decoration">
                  <!-- STAT BLOCK DECORATION ICON -->
                  <svg class="stat-block-decoration-icon icon-status">
                    <use xlink:href="#svg-status"></use>
                  </svg>
                  <!-- /STAT BLOCK DECORATION ICON -->
                </div>
                <!-- /STAT BLOCK DECORATION -->

                <!-- STAT BLOCK INFO -->
                <div class="stat-block-info">
                  <!-- STAT BLOCK TITLE -->
                  <p class="stat-block-title">Last post update</p>
                  <!-- /STAT BLOCK TITLE -->

                  <!-- STAT BLOCK TEXT -->
                  <p class="stat-block-text">1 Day Ago</p>
                  <!-- /STAT BLOCK TEXT -->
                </div>
                <!-- /STAT BLOCK INFO -->
              </div>
              <!-- /STAT BLOCK -->

              <!-- STAT BLOCK -->
              <div class="stat-block">
                <!-- STAT BLOCK DECORATION -->
                <div class="stat-block-decoration">
                  <!-- STAT BLOCK DECORATION ICON -->
                  <svg class="stat-block-decoration-icon icon-comment">
                    <use xlink:href="#svg-comment"></use>
                  </svg>
                  <!-- /STAT BLOCK DECORATION ICON -->
                </div>
                <!-- /STAT BLOCK DECORATION -->

                <!-- STAT BLOCK INFO -->
                <div class="stat-block-info">
                  <!-- STAT BLOCK TITLE -->
                  <p class="stat-block-title">Most commented post</p>
                  <!-- /STAT BLOCK TITLE -->

                  <!-- STAT BLOCK TEXT -->
                  <p class="stat-block-text">56 Comments</p>
                  <!-- /STAT BLOCK TEXT -->
                </div>
                <!-- /STAT BLOCK INFO -->
              </div>
              <!-- /STAT BLOCK -->

              <!-- STAT BLOCK -->
              <div class="stat-block">
                <!-- STAT BLOCK DECORATION -->
                <div class="stat-block-decoration">
                  <!-- STAT BLOCK DECORATION ICON -->
                  <svg class="stat-block-decoration-icon icon-thumbs-up">
                    <use xlink:href="#svg-thumbs-up"></use>
                  </svg>
                  <!-- /STAT BLOCK DECORATION ICON -->
                </div>
                <!-- /STAT BLOCK DECORATION -->

                <!-- STAT BLOCK INFO -->
                <div class="stat-block-info">
                  <!-- STAT BLOCK TITLE -->
                  <p class="stat-block-title">Most liked post</p>
                  <!-- /STAT BLOCK TITLE -->

                  <!-- STAT BLOCK TEXT -->
                  <p class="stat-block-text">904 Likes</p>
                  <!-- /STAT BLOCK TEXT -->
                </div>
                <!-- /STAT BLOCK INFO -->
              </div>
              <!-- /STAT BLOCK -->
            </div>
            <!-- /STAT BLOCK LIST -->
          </div>
          <!-- /WIDGET BOX CONTENT -->
        </div>
        <!-- /WIDGET BOX -->
      </div>
      <!-- /GRID COLUMN -->
    </div>
    <!-- /GRID -->
  </div>
  @endsection

  @section('javascript')

  @endsection
