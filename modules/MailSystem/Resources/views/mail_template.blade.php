@extends('backend.master')
@section('mainContent')

<section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.mail') @lang('lang.template')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.mail') @lang('lang.template')</a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
       
        <div class="row">
           
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">
                                    @lang('lang.update')
                                @lang('lang.mail') @lang('lang.template')
                            </h3>
                        </div>
                            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'mailsystem/mail-template/'.$data->id, 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                     
                                        {{-- <span class="text-primary">[name] [check_in_time] [father_name] [AttendanceDate] [checkout_time] [early_checkout_time] [dob] [present_address] [guardian] [created_at] [admission_no] [roll_no] [class] [section] [gender] [admission_date] [category] [cast] [father_name] [mother_name] [religion] [email] [phone]</span> --}}
                                        
                                    </div>
                                </div>

                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control{{ $errors->has('registration') ? ' is-invalid' : '' }}" cols="0" rows="4" name="registration" maxlength="500">{{isset($data)? $data->registration: old('registration')}}</textarea>
                                            <label>@lang('lang.registration')  <span></span></label>
                                            <span class="focus-border textarea"></span>

                                            @if($errors->has('registration'))
                                                <span class="error text-danger"><strong>{{ $errors->first('registration') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control{{ $errors->has('mail_verify') ? ' is-invalid' : '' }}" cols="0" rows="4" name="mail_verify" maxlength="500">{{isset($data)? $data->mail_verify: old('mail_verify')}}</textarea>
                                            <label>@lang('lang.mail') @lang('lang.verify') <span></span></label>
                                            <span class="focus-border textarea"></span>

                                            @if($errors->has('mail_verify'))
                                                <span class="error text-danger"><strong>{{ $errors->first('mail_verify') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control{{ $errors->has('product_purchase') ? ' is-invalid' : '' }}" cols="0" rows="4" name="product_purchase" maxlength="500">{{isset($data)? $data->product_purchase: old('product_purchase')}}</textarea>
                                            <label>@lang('lang.product') @lang('lang.purchase')  <span></span></label>
                                            <span class="focus-border textarea"></span>

                                            @if($errors->has('product_purchase'))
                                                <span class="error text-danger"><strong>{{ $errors->first('product_purchase') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control{{ $errors->has('product_refund') ? ' is-invalid' : '' }}" cols="0" rows="4" name="product_refund" maxlength="500">{{isset($data)? $data->product_refund: old('product_refund')}}</textarea>
                                            <label>@lang('lang.product') @lang('lang.refund')<span></span></label>
                                            <span class="focus-border textarea"></span>

                                            @if($errors->has('product_refund'))
                                                <span class="error text-danger"><strong>{{ $errors->first('product_refund') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control{{ $errors->has('rating') ? ' is-invalid' : '' }}" cols="0" rows="4" name="rating" maxlength="500">{{isset($data)? $data->rating: old('rating')}}</textarea>
                                            <label>@lang('lang.product') @lang('lang.rating') <span></span></label>
                                            <span class="focus-border textarea"></span>

                                            @if($errors->has('rating'))
                                                <span class="error text-danger"><strong>{{ $errors->first('rating') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control{{ $errors->has('product_update') ? ' is-invalid' : '' }}" cols="0" rows="4" name="product_update" maxlength="500">{{isset($data)? $data->product_update: old('product_update')}}</textarea>
                                            <label>@lang('lang.product') @lang('lang.update') <span></span></label>
                                            <span class="focus-border textarea"></span>

                                            @if($errors->has('product_update'))
                                                <span class="error text-danger"><strong>{{ $errors->first('product_update') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control{{ $errors->has('product_comment') ? ' is-invalid' : '' }}" cols="0" rows="4" name="product_comment" maxlength="500">{{isset($data)? $data->product_comment: old('product_comment')}}</textarea>
                                            <label>@lang('lang.product') @lang('lang.comment')<span></span></label>
                                            <span class="focus-border textarea"></span>

                                            @if($errors->has('product_comment'))
                                                <span class="error text-danger"><strong>{{ $errors->first('product_comment') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control{{ $errors->has('user_suspend') ? ' is-invalid' : '' }}" cols="0" rows="4" name="user_suspend" maxlength="500">{{isset($data)? $data->user_suspend: old('user_suspend')}}</textarea>
                                            <label>@lang('lang.user') @lang('lang.suspended') <span></span></label>
                                            <span class="focus-border textarea"></span>

                                            @if($errors->has('user_suspend'))
                                                <span class="error text-danger"><strong>{{ $errors->first('user_suspend') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control{{ $errors->has('product_review_by_buyer') ? ' is-invalid' : '' }}" cols="0" rows="4" name="product_review_by_buyer" maxlength="500">{{isset($data)? $data->product_review_by_buyer: old('product_review_by_buyer')}}</textarea>
                                            <label>@lang('lang.product_review_by_buyer')  <span></span></label>
                                            <span class="focus-border textarea"></span>

                                            @if($errors->has('product_review_by_buyer'))
                                                <span class="error text-danger"><strong>{{ $errors->first('product_review_by_buyer') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control{{ $errors->has('product_expiring_support') ? ' is-invalid' : '' }}" cols="0" rows="4" name="product_expiring_support" maxlength="500">{{isset($data)? $data->product_expiring_support: old('product_expiring_support')}}</textarea>
                                            <label>@lang('lang.product') @lang('lang.expiring') @lang('lang.support') <span></span></label>
                                            <span class="focus-border textarea"></span>

                                            @if($errors->has('product_expiring_support'))
                                                <span class="error text-danger"><strong>{{ $errors->first('product_expiring_support') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control{{ $errors->has('daily_summary') ? ' is-invalid' : '' }}" cols="0" rows="4" name="daily_summary" maxlength="500">{{isset($data)? $data->daily_summary: old('daily_summary')}}</textarea>
                                            <label>@lang('lang.daily') @lang('lang.summary')  <span></span></label>
                                            <span class="focus-border textarea"></span>

                                            @if($errors->has('daily_summary'))
                                                <span class="error text-danger"><strong>{{ $errors->first('daily_summary') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="">
                                            <span class="ti-check"></span>
                                            @if(isset($data))
                                                @lang('lang.update')
                                            @else
                                                @lang('lang.save')
                                            @endif
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</section>
@endsection
