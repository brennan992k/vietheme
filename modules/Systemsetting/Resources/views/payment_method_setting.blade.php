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
        @if(isset($payment_method))
            <div class="row">
                <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                    <a href="{{url('payment-method')}}" class="primary-btn small fix-gr-bg">
                        <span class="ti-plus pr-2"></span>
                        @lang('lang.add')
                    </a>
                </div>
            </div>
        @endif
        {{-- <div class="row mt-40">

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">@if(isset($payment_method))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.payment_method')
                            </h3>
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
                                                        type="text"  name="method_name" autocomplete="off" value="{{isset($payment_method)? $payment_method->method_name:''}}" required>
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
                                                <div class="input-effect mt-30">
                                                    <div class="mr-30">
                                                        <input type="checkbox" onclick="showHideConfig()" name="is_config_require" id="configure_check" value="1" class="common-radio relationButton">
                                                        <label for="configure_check">@lang('lang.is_configure_require')</label>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>

                                    <div id="showHideDiv" class="field_wrapper  payment_method_field_name">
                                        <div class="add_payment_btn">
                                            <div class="row mt-40 align-itesm-center justify-content-between">
                                                <div class="col-lg-6">
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control{{ $errors->has('field_name') ? ' is-invalid' : '' }}" type="text" name="field_name[]" autocomplete="off" value="" required>
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
                                                        <input class="primary-input form-control{{ $errors->has('field_value') ? ' is-invalid' : '' }}" type="text" name="field_value[]" autocomplete="off" value="" required>
                                                        <label>@lang('lang.env_value') <span>*</span></label>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('field_value'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('field_value') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <button type="button" name="create" class="primary-btn icon-only fix-gr-bg add_button">
                                                    <span class="ti-plus pr-2"></span>
                                                </button>
                                            </div>
                                        </div>
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
        </div> --}}

        <div class="row mt-40">

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0">@lang('lang.payment_method') @lang('lang.list')</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>@lang('lang.sl')</th>
                                    <th>@lang('lang.logo')</th>
                                    <th>@lang('lang.method')</th>
                                    <th>@lang('lang.configuration')</th>
                                    <th>@lang('lang.status')</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $count=1; @endphp
                                @foreach($payment_methods as $payment_method)
                              
                                <tr>
                                    <td>{{$count++}}</td>
                                    <td>
                                        <img  src="{{ file_exists(@$payment_method->logo) ? asset($payment_method->logo) : asset('public/no_logo.png') }}" width="50" height="50" alt="logo">
       
                                </td>
                                    <td>{{$payment_method->gateway_name}}</td>
                                    <td> <a class="primary-btn small fix-gr-bg" href="{{route('payment_method_config', [$payment_method->id])}}">@lang('lang.view')</a></td>
                                    <td>
                                        @if($payment_method->active_status==1)
                                            <button class="primary-btn small bg-success text-white border-0">Enabled</button>
                                        @else 
                                            <button class="primary-btn small bg-danger text-white border-0">Diabled</button>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    @if($payment_method->type != "System")
                                                        <a  class="dropdown-item" href="{{url('systemsetting/payment-method-config',$payment_method->id)}}">@lang('lang.edit')</a>
                                                        {{-- <a class="dropdown-item" data-toggle="modal" data-target="#deletePaymentMethodModal{{$payment_method->id}}" href="#">@lang('lang.delete')</a> --}}
                                                    @endif
                                                    @if($payment_method->active_status==1)
                                                        <a  class="dropdown-item" href="{{url('systemsetting/payment-method-disable',$payment_method->id)}}">@lang('lang.disable')</a>
                                                    @else
                                                        <a  class="dropdown-item" href="{{url('systemsetting/payment-method-enable',$payment_method->id)}}">@lang('lang.enable')</a>
                                                    @endif
                                                </div>
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal fade admin-query" id="deletePaymentMethodModal{{$payment_method->id}}" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('lang.delete') @lang('lang.payment_method')</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                    <a href="{{route('payment_method_delete', [$payment_method->id])}}" class="text-light">
                                                        <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                                                     </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<link rel="stylesheet" href="{{asset('Modules/Systemsetting/Resources/assets/')}}/css/add_payment.css"/>
 <script src="{{asset('Modules/Systemsetting/Resources/assets/')}}/js/systemSetting.js"></script>
>
@endsection
