@extends('backend.layouts.master')

@section('title',transWord('Create New Page'))

@section('stylesheet')

@endsection

@section('content')

@include('backend.components.errors')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>{{ transWord('Create New Page') }}</h2>
                <ul class="header-dropdown dropdown">
                    
                    <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('pages') }}"><i class="icon-book-open"></i> {{ transWord('All Pages') }}</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <h3>{{ transWord('Fill Page Data') }}</h3>
                <hr>
                <form action="{{ route('store_pages') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                    {!! BuildFields('title' , null , 'text' ,['required' => 'required']) !!}
                    </div>
                    <hr>

                    <div class="row">
                    {!! BuildFields('slug' , null , 'text' ,['required' => 'required']) !!}
                    </div>

                    <hr>
                    <div class="row">
                    {!! BuildFields('meta_title' , null , 'text') !!}
                    </div>
                    
                    <hr>
                    <div class="row">
                    {!! BuildFields('meta_desc' , null , 'text') !!}
                    </div>
                    
                    <hr>
                    <div class="row">
                    {!! BuildFields('meta_keywords' , null , 'text') !!}
                    </div>

                    <hr>
                    <div class="row">
                    {!! BuildFields('content' , null , 'textarea' , ['required' => 'required']) !!}
                    </div>

                    <hr>
                    <div class="row">
                    <div class="col-lg-12">
                        <label for="menu">{{ transWord('Choose Menu') }}</label>
                        <select name="menu" id="menu" class="form-control" required>
                            <option value="">{{ transWord('Select Menu') }}</option>
                            @foreach ($menus as $menu)
                            <option value="{{ $menu->id }}">{{ getDataFromJsonByLanguage($menu->title) . '     => Parent [ '.$menu->getParent($menu->parent).' ]' }}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>


                    <hr>
                    
                    <label for="publish">{{ transWord('Publish') }}</label>
                    <select name="publish" id="publish" class="form-control" required>
                        <option value="">{{ transWord('Please Select') }}</option>
                        <option value="1">{{ transWord('Publish') }}</option>
                        <option value="2">{{ transWord('Unpublish') }}</option>
                    </select>
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