@extends('layouts.user')
@section('title','Login')
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
                        <a class="resiter" href="{{ url('customer/register')}} ">@lang('lang.register')</a>
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
                                            <h3>{{config('app.name') }} @lang('lang.login')</h3>
                                            <p>@lang('lang.enter_login')</p>
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <label for="name">@lang('lang.email') @lang('lang.address')<span>*</span></label>
                                            <input type="email" placeholder="Username / Email address" name="email" value="{{ old('email') }}" class="@error('email') is-invalid @enderror" required>
                                            @error('email')
                                                <span class="custom_login_email_msg text-red"  role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <label for="name">@lang('lang.password')<span>*</span></label>
                                            <input type="password" placeholder="Enter password" name="password" class="@error('password') is-invalid @enderror" required>
                                            @error('password')
                                                <span class="text-danger" role="alert">
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
                                                    <a href="{{ route('customer.forget.password')}}" class="forgot-pass"> @lang('lang.forgot') @lang('lang.password') ?</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
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



@endpush
