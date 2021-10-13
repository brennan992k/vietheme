@extends('backend.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.general_settings')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.system_settings')</a>
                <a href="#">@lang('lang.general_settings')</a>
            </div>
        </div>
    </div>
</section>


<link rel="stylesheet" href="{{'public/bkacEnd/'}}/modules.css">

<section class="student-details">
    <div class="container-fluid p-0">
        @include('backend.partials.alertMessage')
        <div class="row">


            <div class="col-lg-12">
                @if (!isset($edit))
                <div class="row xm_3">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-30">@lang('lang.general_settings') @lang('lang.view')</h3>
                        </div>
                    </div>
                    <div class="offset-lg-6 col-lg-2 text-right col-md-6">
                        <a href="{{ route('edit_general_settings')}}" class="primary-btn small fix-gr-bg"> <span class="ti-pencil-alt"></span> @lang('lang.edit')
                        </a>
                    </div>
                </div>
                @endif


                <div class="row">
                    @if (isset($edit))
               <div class="col-lg-12">


                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">@if(isset($edit))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.general_settings')
                            </h3>
                        </div>



                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'footer_setting_update',
                        'method' => 'POST', 'enctype' => 'multipart/form-data']) }}


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

                                        <div class="input-effect mt-30">
                                            <input class="primary-input form-control{{ $errors->has('system_name') ? ' is-invalid' : '' }}"
                                                type="text" name="system_name" autocomplete="off" value="{{isset($infix_general_setting)? $infix_general_setting->system_name:''}}">
                                            <input type="hidden" name="id" value="{{isset($infix_general_setting)? $infix_general_setting->id: ''}}">
                                            <label>@lang('lang.system_name') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('system_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('system_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                        <div class="input-effect mt-30">
                                            <input class="primary-input form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                                type="text" name="address" autocomplete="off" value="{{isset($infix_general_setting)? $infix_general_setting->address:''}}">
                                             <label>@lang('lang.address') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('address'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="input-effect mt-30">
                                            <input class="primary-input form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                type="text" name="phone" autocomplete="off" value="{{isset($infix_general_setting)? $infix_general_setting->phone:''}}">
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
                                                type="text" name="email" autocomplete="off" value="{{isset($infix_general_setting)? $infix_general_setting->email:''}}">
                                             <label>@lang('lang.email') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="input-effect mt-30">
                                            <input class="primary-input form-control{{ $errors->has('currency') ? ' is-invalid' : '' }}"
                                                type="text" name="currency" autocomplete="off" value="{{isset($infix_general_setting)? $infix_general_setting->currency:''}}">
                                             <label>@lang('lang.currency') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('currency'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('currency') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="input-effect mt-30">
                                            <input class="primary-input form-control{{ $errors->has('currency_symbol') ? ' is-invalid' : '' }}"
                                                type="text" name="currency_symbol" autocomplete="off" value="{{isset($infix_general_setting)? $infix_general_setting->currency_symbol:''}}">
                                             <label>@lang('lang.currency_symbol') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('currency_symbol'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('currency_symbol') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="input-effect mt-30">
                                            <input class="primary-input form-control{{ $errors->has('time_zone') ? ' is-invalid' : '' }}"
                                                type="text" name="time_zone" autocomplete="off" value="{{isset($infix_general_setting)? $infix_general_setting->time_zone:''}}">
                                             <label>@lang('lang.time_zone') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('time_zone'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('time_zone') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="input-effect mt-30">
                                            <input class="primary-input form-control{{ $errors->has('copyright_text') ? ' is-invalid' : '' }}"
                                                type="text" name="copyright_text" autocomplete="off" value="{{isset($infix_general_setting)? $infix_general_setting->copyright_text:''}}">
                                             <label>@lang('lang.copyright_text') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('copyright_text'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('copyright_text') }}</strong>
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
                        <div class="white-box">
                            <div class="student-meta-box">

                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                @lang('lang.system_name')
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                @if(isset($infix_general_setting))
                                                {{$infix_general_setting->system_name}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                @lang('lang.system_title')
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                @if(isset($infix_general_setting))
                                                {{$infix_general_setting->system_title}}
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
                                                @if(isset($infix_general_setting))
                                                {{$infix_general_setting->address}}
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
                                                @if(isset($infix_general_setting))
                                                {{$infix_general_setting->phone}}
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
                                                @if(isset($infix_general_setting))
                                                {{$infix_general_setting->email}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                @lang('lang.currency')
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                @if(isset($infix_general_setting))
                                                {{$infix_general_setting->currency}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                @lang('lang.currency_symbol')
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">

                                                @if(isset($infix_general_setting))
                                                    {{$infix_general_setting->currency_symbol}}

                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                @lang('lang.language_name')
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                @if(isset($infix_general_setting))
                                                {{@$infix_general_setting->name}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                @lang('lang.time_zone')
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                @if(isset($infix_general_setting))
                                                {{@$infix_general_setting->time_zone}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                               @lang('lang.auto_approval')
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                @if(isset($infix_general_setting))
                                                {{-- {{@$infix_general_setting->auto_approve}} --}}
                                                    @if (@$infix_general_setting->auto_approve==1)
                                                        @lang('lang.enable')
                                                    @else
                                                        @lang('lang.disable')
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                               @lang('lang.auto_update')
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                @if(isset($infix_general_setting))
                                                    @if (@$infix_general_setting->auto_update==1)
                                                        @lang('lang.enable')
                                                    @else
                                                        @lang('lang.disable')
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                               @lang('lang.google_analytics')
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                @if(isset($infix_general_setting))
                                                    @if (@$infix_general_setting->google_an==1)
                                                        @lang('lang.enable')
                                                    @else
                                                        @lang('lang.disable')
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                               @lang('lang.public_vendor_registration')
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                @if(isset($infix_general_setting))
                                                    @if (@$infix_general_setting->public_vendor==1)
                                                        @lang('lang.enable')
                                                    @else
                                                        @lang('lang.disable')
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if (moduleStatusCheck('AmazonS3') == true)
                                    
                                    <div class="single-meta">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="name">
                                                @lang('lang.amazons3_host')
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="value text-left">
                                                    @if(isset($infix_general_setting))
                                                        @if (@$infix_general_setting->is_s3_host==1)
                                                            @lang('lang.enable')
                                                        @else
                                                            @lang('lang.disable')
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif



                                









                                {{-- <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                @lang('lang.category_limit')
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left">
                                                @if(isset($data))
                                                {{$data->category_limit}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="single-meta ">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                @lang('lang.background_color')- 1
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left d-flex">
                                                
                                                @if(isset($data))
                                                <div class=" col-md-2 mt-2">
                                                    <div class="bg-color_general_settings"  style="background: {{$data->color1}} ; width:15px ; height:15px; "></div>
                                                </div>
                                                <div class="col-md-9"> {{$data->color1}}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                    @lang('lang.background_color')- 2
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left d-flex">
                                            
                                                  @if(isset($data))
                                                <div class=" col-md-2 mt-2">
                                                    <div class="bg-color_general_settings"  style="background: {{$data->color2}} ; width:15px ; height:15px; "></div>
                                                </div>
                                                <div class="col-md-9"> {{$data->color2}}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="name">
                                                    @lang('lang.search_box_color')
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="value text-left d-flex">
                                                @if(isset($data))
                                                <div class=" col-md-2 mt-2">
                                                    <div class="bg-color_general_settings"  style="background: {{$data->color3}} ; width:15px ; height:15px; "></div>
                                                </div>
                                                <div class="col-md-9"> {{$data->color3}}</div>
                                                @endif
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
        </div>
    </div>
</section>
@endsection
