@extends('layouts.master')

@section('title',$title)

@section('stylesheet')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
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
          <h2 class="section-title" style="display: flex;">{{ $title }} - ({{ $role->name }})</h2>
        </div>
    </div>

    <div class="grid grid-6-6-6 centered-on-mobile">

        @foreach ($permissionsName as $permissionName)
        <div class="user-preview">
            <div class="user-preview-info">
                <h3 class="card-label" style="padding-top: 10px;">
                    {{ ucfirst($permissionName).' ('.transWord("Permissions").')' }}
                </h3>
                <hr>
                <div class="card-body">
                    @foreach ($permissions as $permission)
                        @if (explode('_',$permission->name)[1] == $permissionName)
                            <div class="row">
                                <div class="fancy-checkbox">
                                    @if (in_array($permission->id,$assignedPermissions))
                                        <label><input class="permissionCheck" value="{{ $permission->id }}" type="checkbox" checked><span>&nbsp;{{ ucwords(str_replace('_',' ',$permission->name)) }}</span></label>
                                    @else
                                        <label><input class="permissionCheck" value="{{ $permission->id }}" type="checkbox"><span>&nbsp;{{ ucwords(str_replace('_',' ',$permission->name)) }}</span></label>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
    $(function() {
        // (Optional) Active an item if it has the class "is-active"
        $(".accordion2 > .accordion-item.is-active").children(".accordion-panel").slideDown();

        $(".accordion2 > .accordion-item").click(function() {
            // Cancel the siblings
            $(this).siblings(".accordion-item").removeClass("is-active").children(".accordion-panel").slideUp();
            // Toggle the item
            $(this).toggleClass("is-active").children(".accordion-panel").slideToggle("ease-out");
        });
    });

    $(document).ready(function(){
        var checkedVals = null;
        var allPermissionsCheck = [];
        var checkedVals = $('.permissionCheck:checkbox:checked').map(function() {
                allPermissionsCheck.push(this.value);
            }).get();

        $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                if (!allPermissionsCheck.includes($(this).val())) {
                    allPermissionsCheck.push($(this).val());
                }
            }
            else if($(this).prop("checked") == false){
                var index = allPermissionsCheck.indexOf($(this).val());
                if (index !== -1) allPermissionsCheck.splice(index, 1);
            }
            var roleId = '{{ $role->id }}';
            var assignPermissionUrl = '{{ route("assign_permissions_roles",["id"=>"#id"]) }}';
            assignPermissionUrl = assignPermissionUrl.replace('#id',roleId);

            $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
            jQuery.ajax({
                url: assignPermissionUrl,
                method: 'get',
                data: {
                    permissions: allPermissionsCheck,
                    role_id:roleId
                },
                success: function(result){
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-bottom-left",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };

                    toastr.success("Process Done Successfully");
                },

                fail: function (result) {
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-bottom-left",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };

                    toastr.error("Process Failed");
                }
            });
        });

    });


</script>
@endsection
