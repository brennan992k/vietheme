@extends('layouts.user')
@section('title','Reset password')

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
                       <a class="resiter" href="{{ url('login')}} ">@lang('lang.login')</a>
                        <div class="col-xl-6 offset-xl-1">
                            <div class="login_form_content">
                                <div class="login_form_field">
                                    <form action="{{ route('password.update')}}" method="POST" id="cust_reset_password">
                                        @csrf
                                    <input type="text" name="token" hidden value="{{ $token }}">
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
                                            <h3>{{str_replace('_', ' ',config('app.name') ) }} @lang('lang.reset') @lang('lang.password')</h3>
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <label for="name">@lang('lang.email') @lang('lang.address')<span>*</span></label>
                                            <input type="email" placeholder="@lang('lang.email')" name="email" value="{{ old('email') }}" class="@error('email') is-invalid @enderror" required>
                                            @error('email')
                                                <span class="red_alart" role="alert">
                                                    {{ @$message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <label for="name">@lang('lang.new') @lang('lang.password') <span>*</span></label>
                                            <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="*******">
                                            @error('password')
                                                <span class="invalid-feedback  text-red" role="alert">
                                                    <strong>{{ @$message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <label for="name">@lang('lang.confirm') @lang('lang.password') <span>*</span></label>                                            
                                             <input id="password-confirm" type="password"  name="password_confirmation" required autocomplete="new-password" placeholder="*******">
                                        </div>
                                        <div class="col-xl-12">
                                            <button type="submit" class="boxed-btn">@lang('lang.submit')</button>
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
