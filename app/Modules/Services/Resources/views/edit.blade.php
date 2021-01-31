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
                <h3>{{ transWord('Fill Services Data') }}</h3>
                <hr>
                <form action="{{ route('update_services',Crypt::encrypt($service->id)) }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        {!! BuildFields('title' , getDataFromJson($service->title) , 'text' ,['required' => 'required']) !!}
                    </div>
                    <hr>

                    <h3>{{ transWord('Choose Icon') }}</h3>
                    @php($icons = ["flaticon-consulting","flaticon-investment","flaticon-group","flaticon-certificate","flaticon-career","flaticon-shopping-cart","flaticon-route","flaticon-online-education","flaticon-meeting","flaticon-online-class","flaticon-expert","flaticon-certificate-1","flaticon-instructor","flaticon-instructor-1","flaticon-online","flaticon-skills","flaticon-play-button","flaticon-loupe","flaticon-magnifying-glass","flaticon-loupe-1","flaticon-cancel","flaticon-balance","flaticon-pin","flaticon-call","flaticon-email","flaticon-left-arrow","flaticon-right-arrow"])
                    <div class="col-lg-12">
                        <div class="row">
                            @foreach ($icons as $icon)
                                <div class="col-lg-2" style="border: 1px solid #a5a8ad54; border-radius: 5px; text-align: center;font-size: 46px;">
                                    @if($service->icon == $icon)
                                    <input type="radio" name="icon" id="{{ $icon }}" checked value="{{ $icon }}" style="width: 20px; height: 20px;"><br>
                                    @else
                                    <input type="radio" name="icon" id="{{ $icon }}" value="{{ $icon }}" style="width: 20px; height: 20px;"><br>
                                    @endif
                                    <label for="{{ $icon }}">
                                        <i class="{{ $icon }}"></i>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

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
