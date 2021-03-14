@extends('layouts.master')

@section('title',$title)

@section('stylesheet')
<style>
    .page-item{
        height: 24px; margin-top: 20px; font-size: .75rem; font-weight: 700; line-height: 24px;
        padding: 0;
        border-radius: 0;
        box-shadow: none;
    }
</style>
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
          <p class="section-pretitle">Welcome to</p>
          <h2 class="section-title">{{ transWord('Our Blogs') }}</h2>
        </div>
    </div>
    <div class="section-filters-bar v7">
        <div class="section-filters-bar-actions">
          <form class="form">
            <div class="form-item split">
              <div class="form-input small" style="width: 800px;">
                <label for="forum-search">{{ transWord('Search ...') }}</label>
                <input type="text" id="forum-search" name="forum_search">
              </div>
              <button class="button primary">
                <svg class="icon-magnifying-glass">
                  <use xlink:href="#svg-magnifying-glass"></use>
                </svg>
              </button>
            </div>
          </form>
        </div>
      </div>

      <div class="table table-forum-category">
        <div class="table-header">
          <div class="table-header-column">
            <p class="table-header-title">{{ transWord('Blog') }}</p>
          </div>

          <div class="table-header-column centered padded-medium">
            <p class="table-header-title">{{ transWord('Tag') }}</p>
          </div>

          <div class="table-header-column padded-big-left">
            <p class="table-header-title">{{ transWord('Content') }}</p>
          </div>
        </div>

        <div class="table-body">
            @foreach ($blogs as $index => $blog)
            <div class="table-row big">
                <div class="table-column">
                <div class="forum-category">
                    <a href="forums-category.html">
                    <img class="forum-category-image" style="width: 80px; height: 80px; border-radius: 18px;" src="{{ asset('uploads/blogs/'.$blog->blog_img) }}" alt="category-07">
                    </a>

                    <div class="forum-category-info">
                    <p class="forum-category-title"><a href="forums-category.html">{{ $blog->title }}</a></p>
                    <p class="forum-category-text">{!! Str::substr($blog->content, 0, 50) !!}</p>
                    </div>
                </div>
                </div>

                <div class="table-column centered padded-medium">
                <p class="table-title" style="font-size: 1rem; line-height: 22px;">{!! convertToTags($blog->tags) !!}</p>
                </div>

                <div class="table-column padded-big-left">
                <a class="table-link" href="#" style="display: block; font-size: 1rem; font-weight: 600; line-height: 26px;">{!! Str::substr($blog->content, 0, 150) !!}</a>
                </div>

            </div>
            @endforeach


        </div>
      </div>

      {{ $blogs->links() }}



</div>


@endsection
