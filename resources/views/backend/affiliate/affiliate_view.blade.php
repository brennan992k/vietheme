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
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.affiliate')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="">@lang('lang.affiliate') @lang('lang.view')</a>
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
                <h3 class="mb-20">@lang('lang.affiliate') @lang('lang.details')</h3>
            </div>
            <div class="student-meta-box">
                <div class="student-meta-top"></div>
                @if(!empty(@$data->profile->image))
                <img class="student-meta-img img-100" src="{{asset(@$data->profile->image)}}"  alt="">
                @else
                <img class="student-meta-img img-100" src="{{asset('public/uploads/vendor/vendor.jpg')}}"  alt="">
                @endif
                <div class="white-box">
                    <div class="single-meta mt-10">
                        <div class="d-flex justify-content-between">
                            <div class="name">
                                    @lang('lang.affiliate') @lang('lang.name')
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
                                {{date('jS M, Y', strtotime(@$data->created_at))}}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Student Meta Information -->

            </div>

            <!-- Start Student Details -->
            <div class="col-lg-9 staff-details">                  

                        <div class="white-box">
                            <h4 class="stu-sub-head">@lang('lang.affiliate') @lang('lang.info') </h4>
                            <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-6">
                                            <div class="">
                                                <h5>@lang('lang.email')</h5>
                                            </div>
                                        </div>    
                                        <div class="col-lg-4 col-md-7">
                                            <div class="">
                                                @if(isset($data)){{@$data->email}}@endif
                                            </div>
                                        </div>

                                        <div class="col-lg-2 col-md-5">
                                            <div class="">
                                                <h5>@lang('lang.company')</h5>
                                            </div>
                                        </div>
    
                                        <div class="col-lg-4 col-md-6">
                                            <div class="">
                                                @if(isset($data)){{@$data->profile->company_name}}@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-info">
                                   <div class="row">
                                        <div class="col-lg-2 col-md-5">
                                                <div class="">
                                                    <h5>@lang('lang.country')</h5>
                                                </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="">
                                                @if(isset($data)){{@$data->profile->country->name}}@endif
                                            </div>
                                        </div>

                                        <div class="col-lg-2 col-md-5">
                                                <div class="">
                                                    <h5>@lang('lang.state')</h5>
                                                </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="">
                                                @if(isset($data)){{@$data->profile->state->name}}@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-info">
                                   <div class="row">
                                        <div class="col-lg-2 col-md-5">
                                                <div class="">
                                                   <h5> @lang('lang.status')</h5>
                                                </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="">
                                                @if(isset($data))
                                                  @if (@$data->status == 1)
                                                            @lang('lang.active')
                                                            @else   
                                                            @lang('lang.pending')
                                                            @endif
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
