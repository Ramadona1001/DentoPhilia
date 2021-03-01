@extends('layouts.master')

@section('title',$title)

@section('stylesheet')
<style>
    .business-info{
        background: #f8f8fb; padding: 15px; border-radius: 10px;
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
          <h2 class="section-title" style="display: flex;">{{ $title }}</h2>
        </div>
    </div>

    <br>

    <div class="centered-on-mobile">
        <div class="widget-box">
            <!-- WIDGET BOX TITLE -->
            <p class="widget-box-title">{{ $title }}</p>
            <!-- /WIDGET BOX TITLE -->

            <!-- WIDGET BOX CONTENT -->
            <div class="widget-box-content">
                <h2>{{ $business_account->user->name }}</h2>
                <hr>
                <div class="row">
                    <div class="col-lg-6"><h5 class="business-info">{{ transWord('Email') }}:&nbsp;{{ $business_account->user->email }}</h5></div>
                    <div class="col-lg-6"><h5 class="business-info">{{ transWord('Username') }}:&nbsp;{{ '@'.$business_account->user->username }}</h5></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-4"><h5 class="business-info">{{ transWord('Mobile') }}:&nbsp;{{ $business_account->mobile }}</h5></div>
                    <div class="col-lg-4"><h5 class="business-info">{{ transWord('Gender') }}:&nbsp;{{ transWord($business_account->user->gender) }}</h5></div>
                    <div class="col-lg-4"><h5 class="business-info">{{ transWord('Type') }}:&nbsp;{{ transWord($business_account->type) }}</h5></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="business-info">{{ transWord('Commercial Record') }}:
                            <a href="{{ asset('uploads/business_accounts/commercial_records/'.$business_account->commercial_record) }}" style="color: red">
                                {{ transWord('Show') }}
                            </a>
                        </h5>
                    </div>
                    <div class="col-lg-6">
                        <h5 class="business-info">{{ transWord('Tax Card') }}:
                            <a href="{{ asset('uploads/business_accounts/tax_cards/'.$business_account->tax_card) }}" style="color: red">
                                {{ transWord('Show') }}
                            </a>
                        </h5>
                    </div>
                </div>
                <hr>
                @can('approve_business_accounts')
                <div class="row">
                    <div class="col-lg-12">
                        @if($business_account->approve == 0)
                        <a style="width:100%" href="{{ route('approve_business_accounts',Crypt::encrypt($business_account->id)) }}" class="button secondary" title="{{ transWord('Approve') }}">
                            <svg class="menu-item-link-icon icon-check" style="fill: white;">
                                <use xlink:href="#svg-check"></use>
                            </svg>
                        </a>
                        @else
                        <a style="width:100%" href="{{ route('disapprove_business_accounts',Crypt::encrypt($business_account->id)) }}" class="button secondary" title="{{ transWord('Disapprove') }}">
                            <svg class="menu-item-link-icon icon-return" style="fill: white;">
                                <use xlink:href="#svg-return"></use>
                            </svg>
                            @endif
                        </a>
                    </div>
                </div>
                @endcan

              <!-- /FORM -->
            </div>
            <!-- WIDGET BOX CONTENT -->
          </div>

    </div>


</div>


@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $('.form-switch').on('click',function(){
            if ($('.form-switch').hasClass('active')) {
                $('#endDate').fadeOut();
            }else{
                // var d = new Date();
                // var strDate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
                // $('#profile-end').attr('min',year+'-'+month+'-'+day);
                $('#endDate').fadeIn();
            }
        });

        $('#profile-start').on('change',function(){
            var year = parseInt($(this).val().split('-')[0]) + 5;
            var month = $(this).val().split('-')[1];
            var day = $(this).val().split('-')[2];
            // alert($(this).val());
            $('#profile-end').attr('min',year+'-'+month+'-'+day);
        })

    });
</script>
@endsection
