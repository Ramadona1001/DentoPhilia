@extends('layouts.master')

@section('title',$title)

@section('stylesheet')
@section('blogs_active','active')
<style>
    .page-item{
        height: 24px; margin-top: 20px; font-size: .75rem; font-weight: 700; line-height: 24px;
        padding: 0;
        border-radius: 0;
        box-shadow: none;
    }
</style>

<script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
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
          <p class="section-pretitle">{{ transWord('Our Blogs') }}</p>
          <h2 class="section-title">{{ $blog->title }}</h2>
        </div>
    </div>



    <div class="grid grid-12">
        <!-- FORUM CONTENT -->
        <div class="forum-content">

          <div class="forum-post-list">
            <div class="forum-post">
              <div class="forum-post-meta">
                <p class="forum-post-timestamp">{{ $blog->created_at->diffForHumans() }}</p>
              </div>


              <div class="forum-post-content">

                <div class="forum-post-info" style="width: 100%;padding:20px;">
                    <div class="row">
                        <div class="col-lg-5"><img class="forum-post-image img-thumbnail img-responsive" src="{{ asset('uploads/blogs/'.$blog->blog_img) }}" alt="{{ $blog->title }}" style="width: 100%;margin-top:0;height:70%;"></div>
                        <div class="col-lg-7"><p class="forum-post-paragraph"><span class="bold">
                            {!! $blog->content !!}
                        </p></div>
                    </div>
                </div>
                <!-- /FORUM POST INFO -->
              </div>

              @if ($replies != null)
              <hr>
              <div class="forum-post-content">
                <div class="forum-post-info" style="width: 100%;padding:20px;">
                    <h2 style="text-align: center">{{ '{'.transWord('Replies').'}' }}</h2>
                    <div class="table table-forum-category">
                        <div class="table-body">
                            @foreach ($replies as $index => $reply)
                            <div class="table-row big">
                                <div class="table-column">
                                <div class="forum-category" style="width: 100%;">
                                    <a href="#">
                                    <img class="forum-category-image" style="width: 80px; height: 80px; border-radius: 18px;" src="{{ asset(getUserAvatar($reply->user_id)) }}" alt="category-07">
                                    </a>

                                    <div class="forum-category-info">
                                    <p class="forum-category-title"><a href="#">{{ getUserData($reply->user_id)->name }}</a></p>
                                    <p class="forum-category-title"><a href="#" style="font-size: 0.8rem; font-style: italic;">{{ $reply->created_at }}</a></p>
                                    <p class="forum-category-text">{!! $reply->content !!}</p>
                                    </div>
                                </div>

                                </div>

                            </div>
                            @endforeach


                        </div>
                      </div>
                </div>

              </div>
              @endif

              <!-- /FORUM POST CONTENT -->
            </div>

          </div>

          <div class="quick-post medium">
            <!-- QUICK POST HEADER -->
            <div class="quick-post-header">
              <!-- QUICK POST HEADER TITLE -->
              <p class="quick-post-header-title">Leave a Reply</p>
              <!-- /QUICK POST HEADER TITLE -->
            </div>
            <!-- /QUICK POST HEADER -->

            <!-- QUICK POST BODY -->
            <form class="form" action="{{ route('reply_blogs',$blog->id) }}" method="POST">
                @csrf
            <div class="quick-post-body">
              <!-- FORM -->
                <!-- FORM ROW -->
                <div class="form-row">
                  <!-- FORM ITEM -->
                  <div class="form-item">
                    <!-- FORM TEXTAREA -->
                    <div class="form-textarea" style="padding: 10px;">
                        {!! BuildField('content' , null , 'textarea' , ['required' => 'required']) !!}
                    </div>
                    <!-- /FORM TEXTAREA -->
                  </div>
                  <!-- /FORM ITEM -->
                </div>
                <!-- /FORM ROW -->
                <!-- /FORM -->
            </div>
            <!-- /QUICK POST BODY -->

            <!-- QUICK POST FOOTER -->
            <div class="quick-post-footer">
                <div class="quick-post-footer-actions">
                    <button type="submit" class="button secondary">{{ transWord('Post Reply') }}</button>
                </div>
            </div>
        </form>
            <!-- /QUICK POST FOOTER -->
          </div>
          <!-- /QUICK POST -->
        </div>
        <!-- /FORUM CONTENT -->


      </div>



</div>


@endsection
