@extends('layouts.user')
@section('title','Froget Password')
@php
    $logo_conditions = ['title'=>'Logo', 'active_status'=>1];
    $dashboard_bg_conditoins = ['is_default'=>1, 'active_status'=>1, 'id'=>4];
    $dashboard_background=dashboard_background($dashboard_bg_conditoins);
    $logo = dashboard_background($logo_conditions);
@endphp
@push('css')
    <link rel="stylesheet" href="{{ asset('public/css/') }}/auth.css">
    <style type="text/css"> .login_resister_area .single_resister_sildbar::after {background: url("{{url('/'.@$dashboard_background->image)}}") no-repeat; background-size:cover; }</style>
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
                       <a class="resiter" href="{{ url('login')}} ">@lang('lang.login')</a>
                        <div class="col-xl-6 offset-xl-1">
                            <div class="login_form_content">
                                <div class="login_form_field">
                                    <form action="{{ route('password.email')}}" method="POST" id="cust_login">
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
                                            <h3>{{str_replace('_', ' ',config('app.name') ) }} @lang('lang.froget_password')</h3>
                                            <p>@lang('lang.enter_valid_email')</p>
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <label for="name">@lang('lang.email') <span>*</span></label>
                                            <input type="email" placeholder="@lang('lang.email')" name="email" value="{{ old('email') }}" class="@error('email') is-invalid @enderror" required>
                                            @error('email')
                                                <span class="red_alart  text-red" role="alert">
                                                    {{ @$message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-xl-12">
                                            <button type="submit" class="boxed-btn">@lang('lang.send')</button>
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
