@extends('layouts.user')
@section('title','Registration')

@php
    $logo_conditions = ['title'=>'Logo', 'active_status'=>1];
    $dashboard_bg_conditoins = ['is_default'=>1, 'active_status'=>1, 'id'=>4];
    $dashboard_background=dashboard_background($dashboard_bg_conditoins);
    $logo = dashboard_background($logo_conditions);
@endphp

@push('css')
    <link rel="stylesheet" href="{{ asset('public/css/') }}/auth.css">
    <style>.login_resister_area .single_resister_sildbar::after { background: url("{{url('/'.@$dashboard_background->image)}}") no-repeat; background-size:cover;  }</style>
@endpush 
@section('content')
<!-- login_resister_area-start -->
    <div class="login_resister_area">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-xl-4 col-md-12 col-lg-5">
                    <div class="single_resister_sildbar">
                        <div class="logo">
                        <a href="{{url('/')}}">
                                <img src="{{ @$logo ? asset(@$logo->image) : asset('public/frontend/img/Logo.png') }}" alt="" class="signup_logo" >
                            </a>
                        </div>
                        <div class="resister_text">
                            {!! @$dashboard_background->additional_text !!}
                        </div>
                        
                        <div class="resister_social_links">
                            <nav> 
                                <ul>
                                    {!! getSocialIconsDynamic() !!} 
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-7">
                    <div class="main-login-form">
                        <div class="resistration-bg">
                            <img src="{{ asset('public/frontend/img/') }}/pattern/Pattern.png" alt="">
                        </div>
                      <a class="resiter" href="{{ url('login')}}">@lang('lang.login')</a>
                        <div class="col-xl-6 offset-xl-1">
                            <div class="login_form_content">
                                
                                <div class="login_form_field">
                                <form action="{{ route('customer_registration') }}" method="POST" id="cus_registration1">
                                    @csrf
                                        <div class="col-xl-12">
                                                <h3>{{str_replace('_', ' ',config('app.name') ) }} @lang('lang.registration')</h3>
                                                <p>@lang('lang.enter_login')</p>
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <label for="full_name">@lang('lang.full_name')<span>*</span></label>
                                            <input type="text" name="full_name" value="{{ old('full_name') }}" placeholder="@lang('lang.enter_full_name')" required class="@error('full_name') is-invalid @enderror">
                                            @error('full_name')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ @$message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <label for="username">@lang('lang.username')*<span>*</span></label>
                                            <input type="text" placeholder="@lang('lang.enter_username')" name="username" value="{{ old('username') }}" required class="@error('username') is-invalid @enderror">
                                            @error('username')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ @$message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <label for="email">@lang('lang.email') @lang('lang.address')  <span>*</span></label>
                                            <input type="text" placeholder="@lang('lang.username_email_address')" value="{{ old('email') }}" name="email" class="@error('email') is-invalid @enderror" required>
                                            @error('email')
                                                <span class="text-danger  text-red" role="alert">
                                                    {{ @$message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <label for="name">@lang('lang.password')<span>*</span></label>
                                            <input name="password" id="password" type="password" placeholder="@lang('lang.enter_passowrd')"  class="@error('password') is-invalid @enderror" required>
                                            @error('password')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ @$message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <label for="name">@lang('lang.confirm') @lang('lang.password')<span>*</span></label>
                                            <input type="password" name="password_confirmation" placeholder="@lang('lang.confirm_passowrd')" class="@error('password_confirmation') is-invalid @enderror" required>
                                            @error('password_confirmation')
                                                <span  class="text-danger" role="alert">
                                                    <strong>{{ @$message }}</strong>
                                                </span>
                                            @enderror
                                        </div>                             
                                        <input type="hidden"  id="recaptcha_check" value="{{ re_captcha_settings('status') }}">
                                        @if (re_captcha_settings('status') == 1) 
                                            <div class="col-xl-12 col-md-12">
                                                <label for="captcha">@lang('lang.re_captcha')</label>
                                                {!! NoCaptcha::renderJs() !!}
                                                {!! NoCaptcha::display() !!}
                                                <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                            </div>
                                        @endif
                                        <div class="col-xl-12">
                                              <button type="submit" class="boxed-btn mt-35">@lang('lang.register')</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- login_resister_area-end -->

@endsection
@push('js')
@endpush