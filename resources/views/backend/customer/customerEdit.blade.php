@extends('backend.master')
@section('mainContent')
@php
function showPicName($data){
$name = explode('/', $data);
return $name[3];
}
@endphp

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.customer') @lang('lang.edit')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="{{route('admin.customer')}}">@lang('lang.customer') @lang('lang.list')</a>
                <a href="#">@lang('lang.customer') @lang('lang.edit')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-6">
                <div class="main-title">
                    <h3 class="mb-30">@lang('lang.customer') @lang('lang.edit')</h3>
                </div>
            </div>
        </div>
        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => ['admin.customer_update',@$data->id], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' =>'profile']) }}
        <div class="row">
            <div class="col-lg-12">
              <div class="white-box">
                <div class="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h4>@lang('lang.basic_info')</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <hr>
                        </div>
                    </div>

                    <input type="hidden" name="staff_id" value="{{@$data->id}}"> 
                    <div class="row mb-30 mt-20">
                        <div class="col-lg-3">
                            <div class="input-effect">
                                <input class="primary-input form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" type="text"  name="username" readonly value="{{ (isset($data->username)) ? $data->username : old('username')  }}">
                                <span class="focus-border"></span>
                                <label>@lang('lang.user') @lang('lang.name')</label>
                                @if ($errors->has('username'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                                <div class="row col-lg-9 mb-30">
                                    <div class="col-lg-4">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" type="text" name="first_name" value="{{ (isset($data->profile->first_name)) ? $data->profile->first_name : old('first_name') }}">
                                            <span class="focus-border"></span>
                                            <label>@lang('lang.first') @lang('lang.name') *</label>
                                            @if ($errors->has('first_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" type="text" name="last_name" value="{{ (isset($data->profile->last_name)) ? $data->profile->last_name : old('last_name') }}">
                                            <span class="focus-border"></span>
                                            <label>@lang('lang.last') @lang('lang.name') *</label>
                                            @if ($errors->has('last_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                   
                                    <div class="col-lg-4">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" type="text" name="mobile" value="{{ isset($data->profile->mobile) ? $data->profile->mobile : old('mobile') }}">
                                            <span class="focus-border"></span>
                                            <label>@lang('lang.mobile')</label>
                                            @if ($errors->has('mobile'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('mobile') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                    <div class="col-lg-4">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" value="@if(isset($data)){{@$data->email}} @endif">
                                            <span class="focus-border"></span>
                                            <label>@lang('lang.email') *</label>
                                            @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input date form-control{{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" id="startDate" type="text"
                                                    name="date_of_birth" value="{{date('m/d/Y', strtotime(@$data->profile->date_of_birth))}}">
                                                    <span class="focus-border"></span>
                                                    <label>@lang('lang.Date_of_birth')</label>
                                                    @if ($errors->has('date_of_birth'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('date_of_birth') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="" type="button">
                                                    <i class="ti-calendar" id="start-date-icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input date form-control{{ $errors->has('date_of_joining') ? ' is-invalid' : '' }}" id="date_of_joining" type="text"
                                                    name="date_of_joining" value="{{date('m/d/Y', strtotime(@$data->profile->date_of_joining))}} ">
                                                    <span class="focus-border"></span>
                                                    <label>@lang('lang.date_of_joining')</label>
                                                    @if ($errors->has('date_of_joining'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('date_of_joining') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="" type="button">
                                                    <i class="ti-calendar" id="date_of_joining"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-40">
                                      
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" type="text" name="address" value="{{ (isset($data->profile->address)) ? $data->profile->address : old('address') }}">
                                            <span class="focus-border"></span>
                                            <label>@lang('lang.address')</label>
                                            @if ($errors->has('address'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6 mt-40">
                                            <div class="row no-gutters input-right-icon mb-20">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input form-control {{ $errors->has('staff_photo') ? ' is-invalid' : '' }}" id="placeholderStaffsName" type="text" placeholder="{{@$data->profile->image != ""? showPicName(@$data->profile->image):'Profile Photo'}}"
                                                    readonly >
                                                    <span class="focus-border"></span>
                                                    @if ($errors->has('staff_photo'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('staff_photo') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="primary-btn-small-input" type="button">
                                                    <label class="primary-btn small fix-gr-bg" for="staff_photo">@lang('lang.browse')</label>
                                                    <input type="file" class="d-none form-control" name="image" id="staff_photo">
                                                </button>
        
                                            </div>
                                        </div>
                                    </div>
                                
                                
                              <br>

</div>
<div class="row mt-40">
    <div class="col-lg-12 text-center">
        <button class="primary-btn fix-gr-bg">
            <span class="ti-check"></span>
            
            @lang('lang.customer') @lang('lang.update')

        </button>
    </div>
</div>
</div>
</div>
</div>
{{ Form::close() }}
</div>
</section>
@endsection
@section('script')

@endsection
