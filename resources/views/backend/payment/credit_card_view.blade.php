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
                <h1>@lang('lang.credit') @lang('lang.card') @lang('lang.view')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="{{ route('admin.CreditCard') }}">@lang('lang.credit') @lang('lang.card') @lang('lang.list')</a>
                <a href="#">@lang('lang.credit') @lang('lang.card') @lang('lang.view')</a>
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
                <h3 class="mb-20">@lang('lang.credit') @lang('lang.card') @lang('lang.view')</h3>
            </div>
            <div class="student-meta-box">
                <div class="student-meta-top"></div>
                @if(!empty(@$data->profile->image))
                <img class="student-meta-img img-100" src="{{asset(@$data->profile->image)}}"  alt="">
                @else
                <img class="student-meta-img img-100" src="{{asset('public/frontend/img/profile/1.png')}}"  alt="">
                @endif
                <div class="white-box">
                    <div class="single-meta mt-10">
                        <div class="d-flex justify-content-between">
                            <div class="name">
                                @lang('lang.author') @lang('lang.name')
                            </div>
                            <div class="value">
                                @if(isset($data)){{@$data->user->full_name}}@endif
                            </div>
                        </div>
                    </div>
                    <div class="single-meta">
                        <div class="d-flex justify-content-between">
                            <div class="name">
                                @lang('lang.role') 
                            </div>
                            <div class="value">
                               @if(isset($data)){{@$data->user->role->name}}@endif
                           </div>
                       </div>
                   </div>
                    <div class="single-meta">
                        <div class="d-flex justify-content-between">
                            <div class="name">
                                @lang('lang.balance') 
                            </div>
                            <div class="value">
                               @if(isset($data)){{@GeneralSetting()->currency_symbol}}{{@$data->user->balance->amount}}@endif
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
                                {{date('jS M, Y', strtotime(@$data->user->created_at))}}
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
        
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#Earning" role="tab" data-toggle="tab">@lang('lang.credit') @lang('lang.card')</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Start Profile Tab -->
                    <!-- Start leave Tab -->
                    <div role="tabpanel" class="tab-pane fade show active" id="Earning">
                            <div class="white-box">
                            <h4 class="stu-sub-head">@lang('lang.added') @lang('lang.card')</h4>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                             @lang('lang.card') @lang('lang.name')
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            @if(isset($data)){{@$data->name}}@endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                                @lang('lang.card') @lang('lang.number')
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                            @if(isset($data)){{@$data->card_number}}@endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                                @lang('lang.cvc') 
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                            @if(isset($data)){{@$data->cvc}}@endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                                @lang('lang.expiration') @lang('lang.date') 
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                            {{ @$data->exp_mm}}/{{ @$data->exp_yy}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                    <a href="{{ route('admin.CreditCardViewApprove',@$data->id) }}" class="primary-btn fix-gr-bg">
                                            <span class="ti-check"></span>
                                               @if (@$data->status != 1)
                                                   @lang('lang.approve')
                                              @else
                                                   @lang('lang.deactive')
                                               @endif
                                        </a>
                                    @if (@$data->status != 1)
                                        <a href="{{ route('admin.CreditCardViewReject',@$data->id) }}" class="primary-btn fix-gr-bg">
                                                <span class="ti-check"></span>
                                                    @lang('lang.reject')
                                            </a>
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
@section('script')

@endsection
