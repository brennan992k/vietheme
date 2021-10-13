@extends('backend.master')
@section('mainContent')

@php
function showPicName($data){
$name = explode('/', $data);
return $name[4];
}
function showJoiningLetter($data){
$name = explode('/', $data);
return $name[3];
}
function showResume($data){
$name = explode('/', $data);
return $name[3];
}
function showOtherDocument($data){
$name = explode('/', $data);
return $name[3];
}

@endphp
@php  
// $setting = App\SmGeneralSettings::find(1); 

@$setting = Modules\Systemsetting\Entities\InfixGeneralSetting::find(1);
if(!empty(@$setting->currency_symbol)){ @$currency = @$setting->currency_symbol; }else{ @$currency = '$'; } @endphp
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.user') @lang('lang.profile')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="">@lang('lang.user') @lang('lang.profile')</a>
            </div>
        </div>
    </div>
</section>
<section class="mb-40 student-details">
    <div class="container-fluid p-0">
        <div class="row">
         <div class="col-lg-3">
            <!-- Start Student Meta Information -->
            <div class="main-title">
                <h3 class="mb-20">@lang('lang.user') @lang('lang.details')</h3>
            </div>
            <div class="student-meta-box">
                <div class="student-meta-top"></div>
                @if(!empty(@$data->profile->image))
                <img class="student-meta-img img-100" src="{{asset(@$data->profile->image)}}"  alt="">
                @else
                <img class="student-meta-img img-100" src="{{asset('public/backEnd/img/admin/staff.png')}}"  alt="">
                @endif
                <div class="white-box">
                    <div class="single-meta mt-10">
                        <div class="d-flex justify-content-between">
                            <div class="name">
                                    @lang('lang.admin') @lang('lang.name')
                            </div>
                            <div class="value">

                                @if(isset($data)){{@$data->full_name}}@endif

                            </div>
                        </div>
                    </div>
                    <div class="single-meta">
                        <div class="d-flex justify-content-between">
                            <div class="name">
                                    @lang('lang.role') 
                            </div>
                            <div class="value">
                               @if(isset($data)){{@$data->role->name}}@endif
                           </div>
                       </div>
                   </div>
                    <div class="single-meta">
                        <div class="d-flex justify-content-between">
                            <div class="name">
                                 @lang('lang.date_of_joining')
                            </div>
                            <div class="value">
                                @if(isset($data))
                                {{ DateFormat(@$data->created_at) }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>

            <!-- Start Student Details -->
            <div class="col-lg-9 staff-details">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item edit-button">
                                <a href="{{ route('admin.profile_edit',@$data->id)}}" class="primary-btn small fix-gr-bg float-right">@lang('lang.edit')</a>
                            </li>
                        </ul>
                        <div class="white-box mt-2">
                            <h4 class="stu-sub-head">@lang('lang.personal_info')</h4>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            @lang('lang.mobile_no')
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            @if(isset($data)){{@$data->profile->mobile}}@endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                            @lang('lang.email')
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                            @if(isset($data)){{@$data->email}}@endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                           @lang('lang.company') @lang('lang.name')
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                            @if(isset($data->profile->company_name)){{@$data->profile->company_name}}@endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                            @lang('lang.address')
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                            @if(isset($data->profile->address)){{@$data->profile->address}}@endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                            @lang('lang.Date_of_birth')
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                            @if(isset($data->profile->dob)) {{ DateFormat(@$data->profile->dob) }}@endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                            @lang('lang.marital_status')
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                             @if (@$data->profile->marital_status == "married")
                                                @lang('lang.married')
                                             @endif
                                             @if (@$data->profile->marital_status == "unmarried")
                                                @lang('lang.unmarried')
                                             @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    
            </div>
       </div>
    </div>
</section>
@endsection
