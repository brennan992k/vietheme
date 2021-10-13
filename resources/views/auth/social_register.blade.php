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
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('public/frontend/img/') }}/Logo.png" alt="">
                            </a>
                        </div>
                        <div class="resister_text">
                            <h3>Tons of premium <br>
                                Templates are <br>
                                Waiting for you!</h3>

                            <p>There are advances being made in science <br> and technology everyday, and a good <br>
                                example of this is the</p>
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
                        <div class="col-xl-6 offset-xl-1">
                            <div class="login_form_content">
                                <div class="login_form_field">
                                    <form action="{{ route('password.store')}}" method="POST" id="password_registration">
                                        @csrf
                                        <div class="col-xl-12">
                                            <h3>{{str_replace('_', ' ',config('app.name') ) }} Registration</h3>
                                            <p>Enter password to create account</p>
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <label for="name">Password<span>*</span></label>
                                            <input type="password" placeholder="Enter password" name="password" class="@error('password') is-invalid @enderror" required>
                                            @error('password')
                                                <span class="red_alart  text-red" role="alert">
                                                    <strong>{{ @$message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-xl-12">
                                            <button type="submit" class="boxed-btn">Submit</button>
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
    @endsection
    @push('js')
 <script src="{{asset('public/frontend/frontend.js')}}"></script>
    
    @endpush