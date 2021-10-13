@extends('backend.master')
@section('mainContent')


<link rel="stylesheet" href="{{'public/bkacEnd/'}}/modules.css">

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.email_settings') </h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.system_settings')</a>
                <a href="#">@lang('lang.email_settings') </a>
            </div>
        </div>
    </div>
</section>


<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30"> @lang('lang.update') @lang('lang.email_settings')</h3>
                </div>
            </div>
        </div>
        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'method' => 'POST', 'route' => 'update_email_setting', 'id' => 'email_settings1', 'enctype' => 'multipart/form-data']) }}
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
              <div class="white-box">
                <div class="">
                     <input type="hidden" name="email_settings_url" id="email_settings_url" value="update-email-settings-data">
                     <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                     <input type="hidden" name="engine_type" id="engine_type" value="0">

                    <div class="row justify-content-center mb-30">
                        <div class="col-lg-4">
                            <div class="input-effect">
                                <input class="primary-input form-control{{ $errors->has('from_name') ? ' is-invalid' : '' }}"
                                type="text" name="from_name" id="from_name" autocomplete="off" value="{{isset($editData)? $editData->from_name : ''}}">
                                <label>@lang('lang.from_name')<span>*</span> </label>
                                <span class="focus-border"></span>
                                @if ($errors->has('from_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('from_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- <div class="row justify-content-center mb-30">
                        <div class="col-lg-4">
                            <div class="input-effect">
                                <input class="primary-input form-control{{ $errors->has('from_email') ? ' is-invalid' : '' }}"
                                type="text" name="from_email" id="from_email" autocomplete="off" value="{{isset($editData)? $editData->from_email : ''}}">
                                <label>@lang('lang.from') @lang('lang.mail')<span>*</span> </label>
                                <span class="focus-border"></span>
                                 @if ($errors->has('from_email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('from_email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div> --}}

                    @if($editData->email_engine_type == 'email')
                    <div class="smtp_wrapper">
                    @else
                    <div class="smtp_wrapper_block">
                    @endif

                    <div class="smtp_inner_wrapper">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 mb-30">
                            <div class="input-effect">
                                <input class="primary-input form-control{{ $errors->has('MAIL_DRIVER') ? ' is-invalid' : '' }}"
                                type="text" name="MAIL_DRIVER" id="mail_driver" autocomplete="off" value="{{isset($editData)? $editData->mail_driver : ''}}">
                                <label>@lang('lang.mail') @lang('lang.driver') <span>*</span> </label>
                                <span class="focus-border"></span>
                                 @if ($errors->has('MAIL_DRIVER'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('MAIL_DRIVER') }}</strong>
                                </span>
                                @endif
                                <span class="modal_input_validation red_alert"></span>
                            </div>
                        </div>
                    </div>


                    <div class="row justify-content-center">
                        <div class="col-lg-4 mb-30">
                            <div class="input-effect">
                                <input class="primary-input form-control{{ $errors->has('MAIL_HOST') ? ' is-invalid' : '' }}"
                                type="text" name="MAIL_HOST" id="MAIL_HOST" autocomplete="off" value="{{isset($editData)? $editData->mail_host : ''}}">
                                <label>@lang('lang.mail') @lang('lang.host') <span>*</span> </label>
                                <span class="focus-border"></span>
                                 @if ($errors->has('MAIL_HOST'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('MAIL_HOST') }}</strong>
                                </span>
                                @endif
                                <span class="modal_input_validation red_alert"></span>
                            </div>
                        </div>
                      </div>

                       <div class="row justify-content-center">
                        <div class="col-lg-4 mb-30">
                            <div class="input-effect">
                                <input class="primary-input form-control{{ $errors->has('MAIL_PORT') ? ' is-invalid' : '' }}"
                                type="text" name="MAIL_PORT" id="mail_port" autocomplete="off" value="{{isset($editData)? $editData->mail_port : ''}}">
                                <label>@lang('lang.mail') @lang('lang.port') <span>*</span> </label>
                                <span class="focus-border"></span>
                                 @if ($errors->has('MAIL_PORT'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('MAIL_PORT') }}</strong>
                                </span>
                                @endif
                                <span class="modal_input_validation red_alert"></span>
                            </div>
                        </div>
                    </div>


                    <div class="row justify-content-center">
                        <div class="col-lg-4 mb-30">
                            <div class="input-effect">
                                <input class="primary-input form-control{{ $errors->has('MAIL_USERNAME') ? ' is-invalid' : '' }}"
                                type="text" name="MAIL_USERNAME" id="MAIL_USERNAME" autocomplete="off" value="{{isset($editData)? $editData->mail_username : ''}}">
                                <label>@lang('lang.mail') @lang('lang.username') <span>*</span> </label>
                                <span class="focus-border"></span>
                                 @if ($errors->has('MAIL_USERNAME'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('MAIL_USERNAME') }}</strong>
                                </span>
                                @endif
                                <span class="modal_input_validation red_alert"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-4 mb-30">
                            <div class="input-effect">
                                <input class="primary-input form-control{{ $errors->has('MAIL_PASSWORD') ? ' is-invalid' : '' }}"
                                type="password" name="MAIL_PASSWORD" id="MAIL_PASSWORD" autocomplete="off" value="{{isset($editData)? $editData->mail_password : ''}}">
                                <label>@lang('lang.mail') @lang('lang.password') <span>*</span> </label>
                                <span class="focus-border"></span>
                                 @if ($errors->has('MAIL_PASSWORD'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('MAIL_PASSWORD') }}</strong>
                                </span>
                                @endif
                                <span class="modal_input_validation red_alert"></span>
                            </div>
                        </div>
                    </div>



                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-4 mb-30">
                            <div class="input-effect">
                                <input class="primary-input form-control{{ $errors->has('MAIL_ENCRYPTION') ? ' is-invalid' : '' }}"
                                type="text" name="MAIL_ENCRYPTION" id="mail_encryption" autocomplete="off" value="{{isset($editData)? $editData->mail_encryption : ''}}">
                                <label>@lang('lang.mail') @lang('lang.encryption') <span>*</span> </label>
                                <span class="focus-border"></span>
                                 @if ($errors->has('MAIL_ENCRYPTION'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('MAIL_ENCRYPTION') }}</strong>
                                </span>
                                @endif
                                <span class="modal_input_validation red_alert"></span>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>

                </div>
                <div class="row mt-40">
                    <div class="col-lg-12 text-center">
                        <button class="primary-btn fix-gr-bg">
                            <span class="ti-check"></span>
                            @lang('lang.update')
                        </button>
                        <a href="#" data-toggle="modal" data-target="#TestMail" class=" btn primary-btn fix-gr-bg">
                            <span class="ti-check"></span>
                            @lang('lang.test_mail')
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}

</div>
</section>

<div class="modal fade admin-query" id="TestMail" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('lang.test_mail_configuration')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
            <form name="test_email" action="{{route('test_mail')}}" method="post" onsubmit="return validateForm()">
            @csrf
                <div class="row no-gutters input-right-icon">
                    <div class="col">
                        <div class="input-effect">
                            <input class="primary-input form-control" id="to_mail" type="email" name="to_mail">
                            <label> @lang('lang.enter_email') <span>*</span></label>
                            <span class="focus-border"></span>
                            @if ($errors->has('to_mail'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('to_mail') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
    
                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                    <a href="" class="text-light">
                        <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.send')</button>
                    </a>
                </div>

            </form>
            </div>

        </div>
    </div>
</div>

@endsection
