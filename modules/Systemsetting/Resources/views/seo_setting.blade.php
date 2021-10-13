@extends('backend.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.seo') @lang('lang.setting')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.system_setting')</a>
                <a href="#">@lang('lang.seo') @lang('lang.setting')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        {{-- @if(isset($editData))
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{url('payment-method')}}" class="primary-btn small fix-gr-bg">
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
                        <div class="main-title">
                            <h3 class="mb-30">@if(isset($editData))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.seo')  @lang('lang.setting')
                            </h3>
                        </div>

                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'seo-setting-update',
                        'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                         <input type="hidden" name="id" value="{{isset($editData)? $editData->id: ''}}">


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

                                    </div>
                                </div>




                                            <div class="row  d-none">
                                                <div class="col-lg-6 mt-30">
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control{{ $errors->has('site_name') ? ' is-invalid' : '' }}"
                                                            type="text" name="site_name" autocomplete="off" value="{{isset($editData)? $editData->site_name:old('site_name')}}">
                                                        <label>@lang('lang.site') @lang('lang.name') <span>*</span></label>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('site_name'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('site_name') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mt-30">
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control{{ $errors->has('site_title') ? ' is-invalid' : '' }}"
                                                            type="text" name="site_title" autocomplete="off" value="{{isset($editData)? $editData->site_title:old('site_title')}}">
                                                        <label>@lang('lang.site') @lang('lang.title') <span>*</span></label>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('site_title'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('site_title') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row ">
                                                <div class="col-lg-6 mt-30">
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control{{ $errors->has('site_author') ? ' is-invalid' : '' }}"
                                                            type="text" name="site_author" autocomplete="off" value="{{isset($editData)? $editData->site_author:old('site_author')}}">

                                                        <label>@lang('lang.site') @lang('lang.author') <span>*</span></label>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('site_author'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('site_author') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mt-30">
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control{{ $errors->has('keyword') ? ' is-invalid' : '' }}"
                                                            type="text" name="keyword" autocomplete="off" value="{{isset($editData)? $editData->keyword:old('keyword')}}">

                                                        <label>@lang('lang.keyword')   <span>*</span></label>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('keyword'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('keyword') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row mt-30">
                                                <div class="col-lg-12">
                                                    <div class="input-effect">
                                                        <textarea class="primary-input form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="" cols="30" rows="10">{{isset($editData)? $editData->description:old('description')}}</textarea>

                                                        <label>@lang('lang.description')   <span>*</span></label>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('description'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('description') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>



                                <div class="row mt-30">
                                    <div class="col-lg-12 text-center">
                                      <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title=" test ">
                                            <span class="ti-check"></span>
                                            @if(isset($editData))
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
@endsection
