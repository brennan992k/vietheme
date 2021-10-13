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
@endpush 

@section('content')
<!-- login_resister_area-start -->
    <div class="login_resister_area">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-xl-4 col-md-12 col-lg-5">
                    <div class="single_resister_sildbar">
                        <div class="logo">
                            <a href="{{ url('/') }}">
                                <img src="{{ @$logo ? asset(@$logo->image) : asset('public/frontend/img/Logo.png') }}" alt="" width="123">
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
                        <a class="resiter" href="{{ url('register')}}">@lang('lang.register')</a>
                        <div class="col-xl-6 offset-xl-1">
                            <div class="login_form_content">
                                <div class="login_form_field">
                                    <form action="{{ url('login')}}" method="POST" id="cust_login">
                                        @csrf
                                        <div class="col-xl-12">
                                                @if(session()->has('message-success'))
                                                <div class="alert alert-success">
                                                  {{ session()->get('message-success') }}
                                              </div>
                                              @elseif(session()->has('message-danger'))
                                              <div class="alert alert-danger">
                                                  {{ session()->get('message-danger') }}
                                              </div>
                                              @endif
                                              <h3>{{str_replace('_', ' ',config('app.name') ) }} @lang('lang.login')</h3>
                                              <p>@lang('lang.enter_login')</p>
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <label for="name">@lang('lang.email') @lang('lang.address') <span class="required_icon">*</span></label>
                                            <input type="email" placeholder="@lang('lang.email')" name="email" value="{{ old('email') }}" class="@error('email') is-invalid @enderror" required>
                                            @error('email')
                                                <span class="red_alart" role="alert">
                                                    {{ @$message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <label for="name">@lang('lang.password') <span class="required_icon">*</span></label>
                                            <input type="password" placeholder="@lang('lang.enter_passowrd')" name="password" class="@error('password') is-invalid @enderror" required>
                                            @error('password')
                                                <span class="red_alart  text-red" role="alert">
                                                    <strong>{{ @$message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="forgot-pass d-flex align-items-center justify-content-between">
                                                <div class="checkit">
                                                    <span class="chebox-style-custom">
                                                        <input class="styled-checkbox" id="styled-checkbox-2"
                                                            type="checkbox" value="value2" checked>
                                                        <label for="styled-checkbox-2"></label>
                                                    </span>
                                                    <span class="keep-me-login" >
                                                        @lang('lang.keep_me_logged_in')
                                                    </span>
                                                </div>
                                                <div class="forgot-pass-link">
                                                    <a href="{{ route('password.request') }}" class="forgot-pass">@lang('lang.forgot') @lang('lang.password') ?</a>
                                                </div>
                                            </div>
                                        </div>
                                            @php
                                                   $reCaptcha =  App\Models\ManageQuery::ReCaptchaSetting();
                                            @endphp
                                         <input type="text" hidden id="recaptcha_check" value="{{ @$reCaptcha->status }}">
                                        @if (@$reCaptcha->status == 1) 
                                        <div class="col-xl-12 col-md-12">
                                            <label for="captcha">@lang('lang.re_captcha')</label>
                                              {!! NoCaptcha::renderJs() !!}
                                              {!! NoCaptcha::display() !!}
                                            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                        </div>
                                        @endif
                                        {{-- <div class="col-xl-12">
                                           <div class="capca_wrapper d-flex align-items-center justify-content-between">
                                           <div class="checkit">
                                                    <span class="chebox-style-custom">
                                                        <input class="styled-checkbox" id="capca"
                                                            type="checkbox" value="value2" checked>
                                                        <label for="capca"></label>
                                                    </span>
                                                    <span class="chapca_text" >
                                                    I’m not a Robot
                                                    </span>
                                                </div>
                                                <div class="capca_img">
                                                     <img src="{{ asset('public/frontend/img/') }}/capca.png" alt="">
                                                </div>
                                           </div>
                                        </div> --}}
                                        <div class="col-xl-12 mt-10">
                                            <button type="submit" class="boxed-btn">@lang('lang.login')</button>
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
<script src="{{asset('public/frontend/frontend.js')}}"></script>


@endpush
