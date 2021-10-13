@extends('backend.master')
@section('mainContent')
<link rel="stylesheet" href="{{asset('public/backend/')}}/approved_deposit.css">
@php
    function showPicName($data){
        $name = explode('/', $data);
        return $name[3];
    }
@endphp

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1> @lang('lang.re_captcha') @lang('lang.list')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="{{ route('admin.reCaptcha')}}" class="active"> @lang('lang.re_captcha') @lang('lang.list')</a>
                @if(isset($data['edit']) && !empty(@$data['edit']))
                <a href="#" class="active"> @lang('lang.re_captcha') @lang('lang.edit')</a>
            @endif
            </div>
        </div>
    </div>
</section>


<section class="admin-visitor-area DM_table_info">
    <div class="container-fluid p-0">
        @if(isset($data['edit']) && !empty(@$data['edit']))
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{route('admin.reCaptcha')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    @lang('lang.add')
                </a>
            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title ">
                            <h3 class="mb-30">

                                @if(isset($data['edit']) && !empty(@$data['edit']))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                 @lang('lang.re_captcha')
                            </h3>
                        </div>
                        @if(isset($data['edit']) && !empty(@$data['edit']))
                            <form action="{{url('admin/recaptcha-setting-update')}}"  method="POST" class="form-horizontal" enctype="multipart/form-data" id="addfee">
                        {{-- @else
                            <form action="{{url('admin/recaptcha-setting-store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data" id="addfee"> --}}
                        @endif
                            @csrf

                        <div class="white-box">
                            <div class="add-visitor">
                                    <input type="hidden" name="id"
                                    value="{{isset($data['edit'])? $data['edit']->id: ''}}">
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <select class="niceSelect w-100 bb form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type">
                                                <option data-display="@lang('lang.re_captcha') @lang('lang.type') *" value=""> @lang('lang.re_captcha') @lang('lang.type') *</option> 
                                                <option value="1" {{isset($data['edit'])? $data['edit']->type == 1?'selected':'': ''}} >@lang('lang.google') @lang('lang.re_captcha')</option> 
                                            </select>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('type'))
                                            <span class="invalid-feedback " role="alert">
                                                <strong>{{ $errors->first('type') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" type="text" name="title"
                                                   autocomplete="off" value="{{isset($data['edit'])? $data['edit']->title :old('title')}}">
                                            <label>@lang('lang.re_captcha') @lang('lang.title') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('title'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('sitekey') ? ' is-invalid' : '' }}" type="text" name="sitekey"
                                                   autocomplete="off" value="{{isset($data['edit'])? $data['edit']->sitekey :old('sitekey')}}">
                                            <label>@lang('lang.re_captcha') @lang('lang.site_key')  <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('sitekey'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('sitekey') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('secretkey') ? ' is-invalid' : '' }}" type="text" name="secretkey"
                                                   autocomplete="off" value="{{isset($data['edit'])? $data['edit']->secretkey :old('secretkey')}}">
                                            <label>@lang('lang.re_captcha') @lang('lang.secret_key') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('secretkey'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('secretkey') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>



                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <select class="niceSelect w-100 bb form-control{{ $errors->has('active_status') ? ' is-invalid' : '' }}" name="active_status">
                                                <option data-display="@lang('lang.status') *" value="">@lang('lang.status') *</option> 
                                                <option value="1" {{isset($data['edit'])? $data['edit']->status == 1?'selected':'': ''}} >@lang('lang.active')</option> 
                                                <option value="2" {{isset($data['edit'])? $data['edit']->status == 0?'selected':'': ''}}>@lang('lang.inactive')</option> 
                                            </select>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('active_status'))
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong>{{ $errors->first('active_status') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <a target="_blank" href="https://www.google.com/recaptcha/admin/create">@lang('lang.re_captcha') @lang('lang.link') </a>
                                           
                                        </div>
                                    </div>
                                </div>



                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        @if(isset($data['edit']))
                                        <button class="primary-btn fix-gr-bg">
                                            <span class="ti-check"></span>
                                                @lang('lang.update') @lang('lang.re_captcha')                                                
                                            </button>
                                            @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title lm_mb_35 sm_mb_20">
                            <h3 class="mb-0">@lang('lang.re_captcha') @lang('lang.list')</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                           
                                <tr>
                                    <th>@lang('lang.type')</th>
                                    <th>@lang('lang.re_captcha')</th>
                                    <th>@lang('lang.status')</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['re_captcha'] as $item)
                                <tr id="{{ @$item->id}}">
                                    <td valign="top">
                                        @if (@$item->type == 1)
                                           @lang('lang.google')  @lang('lang.re_captcha') 
                                        @endif
                                    </td>
                                    <td valign="top">{{@$item->title}}</td>
                                    <td valign="top">
                                        <label class="switch">                                                
                                                <input type="checkbox" class="switch_recaptch" {{@$item->status == 1? 'checked':''}} value="{{ @$item->status}}">
                                                <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td valign="top">
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{url('admin/recaptcha-setting-edit/'.@$item->id)}}">@lang('lang.edit')</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


