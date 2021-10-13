@extends('backend.master')

@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.update') @lang('lang.general_settings')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="{{url('general-settings')}}">@lang('lang.general_settings') @lang('lang.view')</a>
              </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-6">
                <div class="main-title">
                    <h3 class="mb-30">
                        @lang('lang.update')
                   </h3>
                </div>
            </div>
        </div>
	@if(Illuminate\Support\Facades\Config::get('app.app_sync'))
        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'admin-dashboard', 'method' => 'GET', 'enctype' => 'multipart/form-data']) }}
    @else
        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'update_general_setting', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
  @endif
<input type="hidden" name="id" value="{{ $infix_general_setting->id }}" >
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                    <div class="">
                        <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                        <div class="row ">
                            <div class="col-lg-4 mb-40">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('system_name') ? ' is-invalid' : '' }}"
                                    type="text" name="system_name" autocomplete="off" value="{{isset($infix_general_setting)? $infix_general_setting->system_name : old('system_name')}}">
                                    <label>@lang('lang.system_name') <span>*</span></label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('system_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('system_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 mb-40">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('system_title') ? ' is-invalid' : '' }}"
                                    type="text" name="system_title" autocomplete="off" value="{{isset($infix_general_setting)? $infix_general_setting->system_title : old('system_title')}}">
                                    <label>@lang('lang.system_title') <span>*</span></label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('system_title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('system_title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>



                            <div class="col-lg-4 mb-40">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                    type="text" name="phone" autocomplete="off" value="{{isset($infix_general_setting)? $infix_general_setting->phone: old('phone')}}">
                                    <label>@lang('lang.phone') <span>*</span></label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>




                        </div>

                        <div class="row ">
                        <div class="col-lg-4 mb-40">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    type="email" name="email" autocomplete="off" value="{{isset($infix_general_setting)? $infix_general_setting->email: old('email')}}">
                                    <label>@lang('lang.email') <span>*</span></label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                           <div class="col-lg-4 mb-40">
                                <div class="input-effect">
                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('language_id') ? ' is-invalid' : '' }}" name="language_id" id="language_id">
                                        <option data-display="@lang('lang.language') *" value="">@lang('lang.select') <span>*</span></option>
                                        @if(isset($languages))
                                        @foreach($languages as $value)

                                        <option value="{{$value->id}}"
                                        @if(isset($infix_general_setting))
                                        @if($infix_general_setting->language_id == $value->id)
                                        selected
                                        @endif
                                        @endif
                                        >{{$value->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('language_id'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('language_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-4 mb-40">
                                <div class="input-effect">
                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('date_format_id') ? ' is-invalid' : '' }}" name="date_format_id" id="date_format_id">
                                        <option data-display="@lang('lang.select_date_format') *" value="">@lang('lang.select') <span>*</span></option>
                                        @if(isset($dateFormats))
                                        @foreach($dateFormats as $key=>$value)
                                        <option value="{{$value->id}}"
                                        @if(isset($infix_general_setting))
                                        @if($infix_general_setting->date_format_id == $value->id)
                                        selected
                                        @endif
                                        @endif
                                        >{{$value->normal_view}} [{{$value->format}}]</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('date_format_id'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('date_format_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>



                        </div>

                        <div class="row ">

                        <div class="col-lg-4 mb-40">
                                    <div class="input-effect">
                                         <select name="time_zone" class="niceSelect w-100 bb form-control {{ $errors->has('time_zone') ? ' is-invalid' : '' }}" id="time_zone">
                                            <option data-display="@lang('lang.select') @lang('lang.time_zone') *" value="">@lang('lang.select') @lang('lang.time_zone') *</option>

                                            @foreach($time_zones as $time_zone)
                                            <option value="{{$time_zone->id}}" {{$time_zone->id == $infix_general_setting->time_zone_id? 'selected':''}}>{{$time_zone->time_zone}}</option>
                                            @endforeach

                                        </select>

                                        <span class="focus-border"></span>
                                            @if ($errors->has('time_zone'))
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong>{{ $errors->first('time_zone') }}</strong>
                                            </span>
                                            @endif
                                     </div>
                                </div>




                                <div class="col-lg-4 mb-40">
                                    <div class="input-effect">
                                         <select name="currency" class="niceSelect w-100 bb form-control {{ $errors->has('currency') ? ' is-invalid' : '' }}" id="gs_currency">
                                            <option data-display="@lang('lang.select_currency')" value="">@lang('lang.select_currency')</option>
                                             @foreach($currencies as $currency)
                                                <option value="{{$currency->code}}" {{isset($infix_general_setting)? ($infix_general_setting->currency  == $currency->code? 'selected':''):''}}>{{$currency->name}} ({{$currency->code}})</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('currency'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('currency') }}</strong>
                                        </span>
                                        @endif

                                     </div>
                                </div>

                            <div class="col-lg-4 mb-40">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('currency_symbol') ? ' is-invalid' : '' }}"
                                    type="text" name="currency_symbol" autocomplete="off" value="{{isset($infix_general_setting)? $infix_general_setting->currency_symbol : old('currency_symbol')}}" id="gs_currency_symbol" readonly="">
                                    <label>@lang('lang.currency_symbol') <span>*</span></label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('currency_symbol'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('currency_symbol') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-6 d-flex relation-button mb-40">
                                <p class="text-uppercase mb-0">@lang('lang.auto_approval')</p> 
                                <div class="d-flex radio-btn-flex ml-30">
                                    <div class="mr-20">
                                        <input type="radio" name="auto_approve" id="approve_enable"  {{@$infix_general_setting->auto_approve==1? 'checked': ''}} value="1" class="common-radio relationButton">
                                        <label for="approve_enable">@lang('lang.enable')</label>
                                    </div>
                                    <div class="mr-20">
                                        <input type="radio" name="auto_approve" id="approve_disable" {{@$infix_general_setting->auto_approve==0? 'checked': ''}} value="0" class="common-radio relationButton" >
                                        <label for="approve_disable">@lang('lang.disable')</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-40 d-flex relation-button">
                                <p class="text-uppercase mb-0">@lang('lang.auto_update')</p>
                                <div class="d-flex radio-btn-flex ml-30">
                                    <div class="mr-20">
                                        <input type="radio" name="auto_update" id="update_enable" {{@$infix_general_setting->auto_update==1? 'checked': ''}} value="1" class="common-radio relationButton">
                                        <label for="update_enable">@lang('lang.enable')</label>
                                    </div>
                                    <div class="mr-20">
                                        <input type="radio" name="auto_update" id="update_disable" {{@$infix_general_setting->auto_update==0? 'checked': ''}} value="0" class="common-radio relationButton">
                                        <label for="update_disable">@lang('lang.disable')</label>
                                    </div>
                                </div>
                            </div>
                       
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mb-40 d-flex relation-button">
                                <p class="text-uppercase mb-0">@lang('lang.google_analytics')</p>
                                <div class="d-flex radio-btn-flex ml-30">
                                    <div class="mr-20">
                                        <input type="radio" name="google_an" id="ga_update_enable" {{@$infix_general_setting->google_an==1? 'checked': ''}} value="1" class="common-radio relationButton">
                                        <label for="ga_update_enable">@lang('lang.enable')</label>
                                    </div>
                                    <div class="mr-20">
                                        <input type="radio" name="google_an" id="ga_update_disable" {{@$infix_general_setting->google_an==0? 'checked': ''}} value="0" class="common-radio relationButton">
                                        <label for="ga_update_disable">@lang('lang.disable')</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-40 d-flex relation-button">
                                <p class="text-uppercase mb-0">@lang('lang.public_vendor_registration')</p>
                                <div class="d-flex radio-btn-flex ml-30">
                                    <div class="mr-20">
                                        <input type="radio" name="public_vendor" id="public_vendor_enable" {{@$infix_general_setting->public_vendor==1? 'checked': ''}} value="1" class="common-radio relationButton">
                                        <label for="public_vendor_enable">@lang('lang.enable')</label>
                                    </div>
                                    <div class="mr-20">
                                        <input type="radio" name="public_vendor" id="public_vendor_disable" {{@$infix_general_setting->public_vendor==0? 'checked': ''}} value="0" class="common-radio relationButton">
                                        <label for="public_vendor_disable">@lang('lang.disable')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (moduleStatusCheck('AmazonS3') == true)
                            
                            <div class="row">
                                <div class="col-lg-6 mb-40 d-flex relation-button">
                                    <p class="text-uppercase mb-0">@lang('lang.amazons3_host')</p>
                                    <div class="d-flex radio-btn-flex ml-30">
                                        <div class="mr-20">
                                            <input type="radio" name="is_s3_host" id="is_s3_host_enable" {{@$infix_general_setting->is_s3_host==1? 'checked': ''}} value="1" class="common-radio relationButton">
                                            <label for="is_s3_host_enable">@lang('lang.enable')</label>
                                        </div>
                                        <div class="mr-20">
                                            <input type="radio" name="is_s3_host" id="is_s3_host_disable" {{@$infix_general_setting->is_s3_host==0? 'checked': ''}} value="0" class="common-radio relationButton">
                                            <label for="is_s3_host_disable">@lang('lang.disable')</label>
                                        </div>
                                    </div>
                                </div>
                            
                            </div>
                        @endif

                        <div class="row ">
                            <div class="col-lg-12 md-30">
                                <div class="input-effect">
                                <textarea class="primary-input form-control" cols="0" rows="4" name="address" id="address">{{isset($infix_general_setting) ? $infix_general_setting->address : old('address')}}</textarea>
                                    <label>@lang('lang.address') <span></span> </label>
                                    <span class="focus-border textarea"></span>

                                </div>
                            </div>
                        </div>
                         @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                    
                    </div>






                    <div class="">
                        <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                        {{-- <div class="row mt-40">
                                <div class="col-lg-4"> 
                                    <div class="input-effect">
                                        <input class="primary-input form-control{{ $errors->has('category_limit') ? ' is-invalid' : '' }}"
                                            type="number" min="0" name="category_limit"  autocomplete="off" value="{{isset($editData1)? $editData1->category_limit:old('category_limit')}}">
                                        <label>@lang('lang.category_limit')<span class="text-red">*</span></label>
                                        <span class="focus-border"></span>
                                        @if ($errors->has('category_limit'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('category_limit') }}</strong>
                                        </span>
                                        @endif
                                    </div> 
                                </div> 
                            </div> --}}
                        <div class="mt-40" >
                                <h5>@lang('lang.banner') @lang('lang.image') @lang('lang.color'):</h5>
                        </div>
                        <div class="row mt-20" >
                            <div class="col-lg-4">
                                <div class="input-effect">
                                    <label>@lang('lang.background_color')-1 <span>*</span></label>
                                    <input class="color primary-input form-control{{ $errors->has('color1') ? ' is-invalid' : '' }}" id="input1" type="text" name="color1" autocomplete="off" value="{{isset($editData1)? $editData1->color1: old('color1')}}">
                                    <span class="focus-border"></span>
                                    @if ($errors->has('color1'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('color1') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-effect">
                                    <label>@lang('lang.background_color')-2 <span>*</span></label>
                                    <input class="color primary-input form-control{{ $errors->has('color2') ? ' is-invalid' : '' }}" id="input1" type="text" name="color2" autocomplete="off" value="{{isset($editData1)? $editData1->color2: old('color2')}}">
                                    <span class="focus-border"></span>
                                    @if ($errors->has('color2'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('color2') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                    <div class="input-effect">
                                        <label>@lang('lang.search_box_color')<span>*</span></label>
                                        <input class="color primary-input form-control{{ $errors->has('color3') ? ' is-invalid' : '' }}"  id="input1" type="text" name="color3" autocomplete="off" value="{{isset($editData1)? $editData1->color3: old('color3')}}">
                                        <span class="focus-border"></span>
                                        @if ($errors->has('color3'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('color3') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                        </div>
                   
                </div>


                    <div class="row mt-40">
                        <div class="col-lg-12 text-center">
                             @if(Illuminate\Support\Facades\Config::get('app.app_sync'))
                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled For Demo "> 
                                <button   class="primary-btn small fix-gr-bg  demo_view password_update_btn" type="button" >@lang('lang.update')</button>
                                </span>
                            @else
                                <button type="submit" class="primary-btn fix-gr-bg">
                                    <span class="ti-check"></span>
                                    @lang('lang.update')
                                </button>
                            @endif
                        </div>
                    </div>



                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>

</div>
 <script src="{{asset('Modules/Systemsetting/Resources/assets/')}}/js/systemSetting.js"></script>
</section>
@endsection
