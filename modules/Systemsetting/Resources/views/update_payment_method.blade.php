@extends('backend.master')
@section('mainContent')

<link rel="stylesheet" href="{{'public/bkacEnd/'}}/modules.css">

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.payment_method')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.system_settings')</a>
                <a href="#">@lang('lang.payment_method')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        {{-- @if(isset($payment_method))

        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{url('systemsetting/payment-method-setting')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    @lang('lang.add')
                </a>
            </div>
        </div>
        @endif --}}

        
        <div class="row">

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title d-flex justify-content-between align-items-center">
                            <h3 class="mb-30">@if(isset($payment_method))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.payment_method')
                            </h3>
                            @if(isset($payment_method))
                                <a href="{{url('systemsetting/payment-method-setting')}}" class="primary-btn small fix-gr-bg mb-20">
                                   
                                    @lang('lang.payment_method') @lang('lang.list')
                                </a>
                            @endif
                        </div>
                        @if(isset($payment_method))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'payment_method_update',
                        'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        @else

                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'payment_method_store',
                        'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        @endif

                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="input-effect">
                                                    <input class="primary-input form-control{{ $errors->has('method') ? ' is-invalid' : '' }}"
                                                        type="text" readonly name="method_name" autocomplete="off" value="{{isset($payment_method)? $payment_method->gateway_name:''}}">
                                                    <input type="hidden" name="id" value="{{isset($payment_method)? $payment_method->id: ''}}">
                                                    <label>@lang('lang.method_name') <span>*</span></label>
                                                    <span class="focus-border"></span>
                                                    @if ($errors->has('method_name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('method_name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-effect mt-20 ml-25">
                                                        <div class="text-left float-left">
        
                                                            <a href="{{$payment_method->is_config_required}}" target="_blank" class="primary-btn small fix-gr-bg mb-20">
                                   
                                                                {{$payment_method->gateway_name}} @lang('lang.dashboard')
                                                            </a>
                                                         </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if (@$payment_method->gateway_name == 'PayPal')
                                        <div class="row">
                                        <div class="col-lg-6 mt-30">
                                            <div class="input-effect input-right-icon">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="d-flex justify-content-between">
                                                            <div class="input-effect">
                                                                <input class="primary-input add_input" id="placeholderInput" type="text" placeholder="Logo"
                                                                    readonly>
                                                            </div>
                                                            <button class="primary-btn-small-input" type="button">
                                                                <label class="primary-btn small fix-gr-bg" for="browseFile">@lang('lang.browse')</label>
                                                                <input type="file" class="d-none" id="browseFile" name="logo">
                                                            </button>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-2 ml-25">
                                            <div class="input-effect mt-40 ">
                                                    <div class="text-left float-left">
                                                        <input type="radio"  name="mode"  {{ $payment_method->mode== 1 ? 'checked' : '' }} id="mode_check" value="1" class="common-radio relationButton">
                                                        <label for="mode_check">@lang('lang.sandbox')</label>
                                                     </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="input-effect mt-40 ">
                                                    <div class="text-left float-left">
                                                        <input type="radio"  name="mode"  {{ $payment_method->mode== 2 ? 'checked' : '' }} id="live_mode_check" value="2" class="common-radio relationButton">
                                                        <label for="live_mode_check">@lang('lang.live')</label>
                                                     </div>
                                            </div>
                                        </div>
                                        </div>
                                        @else
                                        <div class="col-lg-12 mt-30">
                                            <div class="input-effect input-right-icon">
                                                <div class="row">
                                                    <div class="col-lg-12 p-0">
                                                        <div class="d-flex justify-content-between">
                                                            <div class="input-effect">
                                                                <input class="primary-input add_input" id="placeholderInput" type="text" placeholder="Logo"
                                                                    readonly>
                                                            </div>
                                                            <button class="primary-btn-small-input" type="button">
                                                                <label class="primary-btn small fix-gr-bg" for="browseFile">@lang('lang.browse')</label>
                                                                <input type="file" class="d-none" id="browseFile" name="logo">
                                                            </button>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        @endif
                                        <br>

                      <div id="showHideDiv"  class="field_wrapper update_payment_method_field_wrapper">
                                            @php
                                                $count=1;
                                            @endphp
                                            @foreach ($envvalues as $env)

                                            @php
                                                $envTerm = explode(":", $env);

                                            @endphp
                                    <div class="add_payment_btn">
                                        <div class="row mt-40 align-itesm-center justify-content-between ">
                                                <div class="col-lg-6">
                                                    <div class="input-effect add_single_payment">
                                                        <input class="primary-input form-control{{ $errors->has('field_name') ? ' is-invalid' : '' }}" type="text" name="field_name[]" autocomplete="off" value="{{ $envTerm[0] }}">
                                                        <label>@lang('lang.env_terms') <span>*</span></label>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('field_name'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('field_name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control{{ $errors->has('field_value') ? ' is-invalid' : '' }}" type="text" name="field_value[]" autocomplete="off" value="{{ $envTerm[1] }}">
                                                        <label>@lang('lang.env_value') <span>*</span></label>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('field_value'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('field_value') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                        {{-- @if ($count==1)
                                        <button type="button" name="create" class="primary-btn icon-only fix-gr-bg add_button">
                                            <span class="ti-plus pr-2"></span>
                                        </button>
                                        @else

                                        @endif --}}

                                     </div>
                                 </div>
                                        @php
                                        $count++
                                        @endphp
                                            @endforeach




                            </div>
                        </div>
                    </div>

                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                      <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title=" test ">
                                            <span class="ti-check"></span>
                                            @if(isset($payment_method))
                                                @lang('lang.update')
                                            @else
                                                @lang('lang.save')
                                            @endif
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>
 <link rel="stylesheet" href="{{asset('Modules/Systemsetting/Resources/assets/')}}/css/add_payment.css"/>
 <script src="{{asset('Modules/Systemsetting/Resources/assets/')}}/js/systemSetting.js"></script>
 {{-- <link rel="stylesheet" href="{{asset('Modules/Systemsetting/Resources/assets/')}}/css/add_payment.css"/> --}}


@endsection
