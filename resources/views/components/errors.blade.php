@if ($errors->any())
<div class="widget-box" style="background: #ff7675;">
    <p class="widget-box-title">{{ transWord('Please Fix Errors') }}</p>
    <div class="widget-box-content">
    @foreach ($errors->all() as $error)
            <h6>{{ $error }}</h6>
            @endforeach
        </div>
    </div>
    <hr>
@endif
