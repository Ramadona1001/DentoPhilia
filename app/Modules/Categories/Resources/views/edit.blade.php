@extends('backend.layouts.master')

@section('title',transWord('Edit Category Data'))

@section('stylesheet')

@endsection

@section('content')

@include('backend.components.errors')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>{{ transWord('Edit Category Data') }}</h2>
                <ul class="header-dropdown dropdown">

                    <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('create_categories') }}"><i class="icon-book-open"></i> {{ transWord('Create New Category') }}</a></li>
                            <li><a href="{{ route('categories') }}"><i class="icon-book-open"></i> {{ transWord('All Categories') }}</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <h3>{{ transWord('Fill Category Data') }}</h3>
                <hr>
                <img class="rounded-circle" width="50px" height="50px" src="{{ asset('uploads/backend/categories/'.$categories->image) }}" style="display: block; margin-left: auto; margin-right: auto; width: 150px; height: 150px;" alt="{{ getDataFromJsonByLanguage($categories->title) }}" title="{{ getDataFromJsonByLanguage($categories->title) }}" class="img-responsive img-thumbnail">
                <hr>
                <form action="{{ route('update_categories',Crypt::encrypt($categories->id)) }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        {!! BuildFields('title' , getDataFromJson($categories->title) , 'text' ,['required' => 'required']) !!}
                        </div>
                        <hr>

                        <div class="row">
                        {!! BuildFields('slug' , getDataFromJson($categories->slug) , 'text' ,['required' => 'required']) !!}
                        </div>

                        <hr>
                        <div class="row">
                        {!! BuildFields('content' , getDataFromJson($categories->content) , 'textarea' , ['required' => 'required']) !!}
                        </div>
                        <hr>

                        <label for="image">{{ transWord('Image') }}</label>
                        <input type="file" name="image" id="image" class="form-control">
                        <hr>
                    <button type="submit" class="btn btn-primary"><i class="icon-plus"></i>&nbsp;{{ transWord('Save') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
var languages = [];

<?php foreach(getLang() as $key => $val){ ?>
    languages.push('<?php echo $val; ?>');
<?php } ?>

var i = 0;
for (i; i < languages.length; i++) {
    CKEDITOR.replace( 'content['+languages[i]+']', {
        height: 300,
        filebrowserUploadUrl: "{{route('upload_pages', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
}

</script>
@endsection
