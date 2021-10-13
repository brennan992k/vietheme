@extends('layouts.user')
@section('title','Registration')
@push('css')
<link rel="stylesheet" href="{{ asset('public/css/') }}/auth.css">

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
                                <img src="{{ asset('public/frontend/img/') }}/Logo.png" alt="">
                            </a>
                        </div>
                        <div class="resister_text">
                                <h3>@lang('lang.tons_of_premium') <br>
                                    @lang('lang.templates_are') <br>
                                    @lang('lang.waiting_for_you') </h3>

                                    <p>@lang('lang.there_are_advances_being_made_in_science') <br> @lang('lang.technology_and_good') <br>
                                        @lang('lang.example_of')</p>
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
                        <a class="resiter" href="{{ url('customer/login')}}">@lang('lang.login')</a>
                        <div class="col-xl-6 offset-xl-1">
                            <div class="login_form_content">
                                
                                <div class="login_form_field">
                                <form action="{{ url('customer/registration') }}" method="POST" id="cus_registration">
                                    @csrf
                                        <div class="col-xl-12">
                                            <h3>{{ @GeneralSetting()->system_name }} @lang('lang.registration')</h3>
                                            <p>@lang('lang.enter_login')</p>
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <label for="full_name">@lang('lang.full') @lang('lang.name')<span>*</span></label>
                                            <input type="text" name="full_name" value="{{ old('full_name') }}" placeholder="Enter full name" required class="@error('full_name') is-invalid @enderror">
                                            @error('full_name')
                                                <span class="text-danger  text-red" role="alert">
                                                    <strong>{{ @$message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <label for="username">@lang('lang.username')<span>*</span></label>
                                            <input type="text" placeholder="Enter username" name="username" value="{{ old('username') }}" required class="@error('username') is-invalid @enderror">
                                            @error('username')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ @$message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <label for="email">@lang('lang.email') @lang('lang.address') <span>*</span></label>
                                            <input type="text" placeholder="Username / Email address" value="{{ old('email') }}" name="email" class="@error('email') is-invalid @enderror" required>
                                            @error('email')
                                                <span class="text-danger" role="alert">
                                                    {{ @$message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <label for="name">@lang('lang.password')<span>*</span></label>
                                            <input name="password" type="password" placeholder="Enter passowrd"  class="@error('password') is-invalid @enderror" required>
                                            @error('password')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ @$message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <label for="name">@lang('lang.confirm') @lang('lang.password')<span>*</span></label>
                                            <input type="password" name="password_confirmation" placeholder="confirm passowrd" class="@error('password_confirmation') is-invalid @enderror" required>
                                            @error('password_confirmation')
                                                <span  class="text-danger" role="alert">
                                                    <strong>{{ @$message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        
                                        <input type="text"  id="recaptcha_check" value="{{ re_captcha_settings('status') }}">
                                        @if (re_captcha_settings('status') == 1) 
                                        <div class="col-xl-12 col-md-12">
                                            <label for="captcha">@lang('lang.re_captcha')</label>
                                            {!! NoCaptcha::renderJs() !!}
                                            {!! NoCaptcha::display(['data-theme' => 'white']) !!}
                                            <span class="text-danger">{{ @$errors->first('g-recaptcha-response') }}</span>
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
