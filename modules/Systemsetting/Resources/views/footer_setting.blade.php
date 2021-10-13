@extends('backend.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.footer_setting')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.system_settings')</a>
                <a href="#">@lang('lang.footer_setting')</a>
            </div>
        </div>
    </div>
</section>
<section class="student-details">
    <div class="container-fluid p-0">
        @include('backend.partials.alertMessage')
        <div class="row">

           @if (isset($edit))
                <div class="col-lg-12">


                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">@if(isset($footer_setting))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.footer_setting')
                            </h3>
                        </div>
                        @if(empty($footer_setting))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'footer_setting_update',
                        'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        @else

                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'footer_setting_update',
                        'method' => 'POST', 'enctype' => 'multipart/form-data']) }}

                        @endif
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
                                        @if(session()->has('message-success'))
                                        <div class="alert alert-success">
                                            {{ session()->get('message-success') }}
                                        </div>
                                        @elseif(session()->has('message-danger'))
                                        <div class="alert alert-danger">
                                            {{ session()->get('message-danger') }}
                                        </div>
                                        @endif


                                        {{-- jjjj --}}
                                        <div class="input-effect mt-30">
                                            <input class="primary-input form-control{{ $errors->has('method') ? ' is-invalid' : '' }}"
                                                type="text" name="copyright_text" autocomplete="off" value="{{isset($footer_setting)? $footer_setting->copyright_text:''}}">
                                            <input type="hidden" name="id" value="{{isset($footer_setting)? $footer_setting->id: ''}}">
                                            <label>@lang('lang.copyright_text') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('copyright_text'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('copyright_text') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                        <div class="input-effect mt-30">
                                            <input class="primary-input form-control{{ $errors->has('facebook_link') ? ' is-invalid' : '' }}"
                                                type="text" name="facebook_link" autocomplete="off" value="{{isset($footer_setting)? $footer_setting->facebook_link:''}}">

                                            <label>@lang('lang.facebook_link') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('facebook_link'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('facebook_link') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                       <div class="input-effect mt-30">
                                            <input class="primary-input form-control{{ $errors->has('twitter_link') ? ' is-invalid' : '' }}"
                                                type="text" name="twitter_link" autocomplete="off" value="{{isset($footer_setting)? $footer_setting->twitter_link:''}}">

                                            <label>@lang('lang.twitter_link') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('twitter_link'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('twitter_link') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                       <div class="input-effect mt-30">
                                            <input class="primary-input form-control{{ $errors->has('youtube_link') ? ' is-invalid' : '' }}"
                                                type="text" name="youtube_link" autocomplete="off" value="{{isset($footer_setting)? $footer_setting->youtube_link:''}}">

                                            <label>@lang('lang.youtube_link') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('youtube_link'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('youtube_link') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                       <div class="input-effect mt-30">
                                            <input class="primary-input form-control{{ $errors->has('pinterest_link') ? ' is-invalid' : '' }}"
                                                type="text" name="pinterest_link" autocomplete="off" value="{{isset($footer_setting)? $footer_setting->pinterest_link:''}}">

                                            <label>@lang('lang.pinterest_link') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('pinterest_link'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('pinterest_link') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                       <div class="input-effect mt-30">
                                            <input class="primary-input form-control{{ $errors->has('instagram_link') ? ' is-invalid' : '' }}"
                                                type="text" name="instagram_link" autocomplete="off" value="{{isset($footer_setting)? $footer_setting->instagram_link:''}}">

                                            <label>@lang('lang.instagram_link') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('instagram_link'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('instagram_link') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                       <div class="input-effect mt-30">
                                            <input class="primary-input form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                type="number" name="phone" autocomplete="off" value="{{isset($footer_setting)? $footer_setting->phone:''}}">

                                            <label>@lang('lang.phone') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('phone'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                       <div class="input-effect mt-30">
                                            <input class="primary-input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                type="email" name="email" autocomplete="off" value="{{isset($footer_setting)? $footer_setting->email:''}}">

                                            <label>@lang('lang.email') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                       <div class="input-effect mt-30">
                                                <textarea name="address" class="primary-input form-control{{ $errors->has('address') ? ' is-invalid' : '' }}">{{isset($footer_setting)? $footer_setting->address:''}}</textarea>
                                            <label>@lang('lang.address') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('address'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                    </div>
                                </div>

                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                      <button class="primary-btn fix-gr-bg" data-toggle="tooltip" >
                                            <span class="ti-check"></span>
                                            @if(!empty($footer_setting))
                                                @lang('lang.update')
                                            @else
                                                @lang('lang.save')
                                            @endif
                                           @lang('lang.footer_setting')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>




@else



            <div class="col-lg-12">

                <div class="row xm_3">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-30">@lang('lang.footer_setting') @lang('lang.view')</h3>
                        </div>
                    </div>
                    <div class="offset-lg-6 col-lg-2 text-right col-md-6">
                        <a href="{{ route('edit-footer-setting')}}" class="primary-btn small fix-gr-bg"> <span class="ti-pencil-alt"></span> @lang('lang.edit')
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="white-box">
                            <div class="student-meta-box">
                                {{-- gggf --}}
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                @lang('lang.copyright_text')
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                @if(isset($footer_setting))
                                                {{$footer_setting->copyright_text}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                @lang('lang.facebook_link')
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                @if(isset($footer_setting))
                                                {{$footer_setting->facebook_link}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                @lang('lang.twitter_link')
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                @if(isset($footer_setting))
                                                {{$footer_setting->twitter_link}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                @lang('lang.youtube_link')
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                @if(isset($footer_setting))
                                                {{$footer_setting->youtube_link}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                @lang('lang.pinterest_link')
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                @if(isset($footer_setting))
                                                {{$footer_setting->pinterest_link}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                @lang('lang.instagram_link')
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                @if(isset($footer_setting))
                                                {{$footer_setting->instagram_link}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                @lang('lang.address')
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                @if(isset($footer_setting))
                                                {{$footer_setting->address}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                @lang('lang.phone') @lang('lang.no')
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                @if(isset($footer_setting))
                                                {{$footer_setting->phone}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                @lang('lang.email') @lang('lang.address')
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                @if(isset($footer_setting))
                                                {{$footer_setting->email}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endif
        </div>
    </div>
</section>
@endsection
