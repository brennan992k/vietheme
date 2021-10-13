@extends('backend.master')
@section('mainContent')
    <link rel="stylesheet" href="{{url('Modules/Pages/Assets/css/style.css')}}">
    <script src="https://cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('lang.privacy') @lang('lang.policy')</h1>
                <div class="bc-pages">
                    <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">@lang('lang.frontend_CMS') </a>
                    <a href="#">@lang('lang.privacy') @lang('lang.policy') </a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-30"> @lang('lang.update')
                                    @lang('lang.privacy') @lang('lang.policy')
                                </h3>
                            </div>
                            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'privacy-policy-update',
                            'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                            <input type="hidden" name="id" value="{{isset($editData)? $editData->id: ''}}">
                            <div class="white-box">
                                <div class="add-visitor">
                                    <div class="row mt-40">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input class="primary-input form-control{{ $errors->has('heading_title') ? ' is-invalid' : '' }}"
                                                       type="text" name="heading_title" autocomplete="off"
                                                       value="{{isset($editData)? $editData->heading_title:old('heading_title')}}">
                                                <label>@lang('lang.heading') @lang('lang.title') <span class="text-red">*</span></label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('heading_title'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('heading_title') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-40">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input class="primary-input form-control{{ $errors->has('sub_title') ? ' is-invalid' : '' }}"
                                                       type="text" name="sub_title" autocomplete="off"
                                                       value="{{isset($editData)? $editData->sub_title:old('sub_title')}}">
                                                <label>@lang('lang.sub') @lang('lang.title') <span
                                                            class="text-red">*</span></label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('sub_title'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('sub_title') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-40">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <textarea name="short_description"
                                                          class="primary-input form-control{{ $errors->has('short_description') ? ' is-invalid' : '' }}"
                                                          rows="5">{{isset($editData)? $editData->short_description:old('short_description')}}</textarea>
                                                <label>@lang('lang.short') @lang('lang.description') <span
                                                            class="text-red">*</span></label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('short_description'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('short_description') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-40">
                                        <div class="col-lg-12">
                                            @if (!empty($editData->image))
                                                <img class="mb-20" height="80px;" width="120px;"  src="{{asset('/')}}{{$editData->image}}" >
                                            @endif
                                            <div class="row no-gutters input-right-icon">
                                                <div class="col">
                                                    <div class="input-effect">
                                                        <input class="primary-input" type="text" id="placeholderPhoto"
                                                               placeholder="@lang('lang.upload') @lang('lang.image')"
                                                               readonly="">
                                                        <span class="focus-border"></span>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <button class="primary-btn-small-input" type="button">
                                                        <label class="primary-btn small fix-gr-bg"
                                                               for="photo">@lang('lang.browse')</label>
                                                        <input type="file" class="d-none" value="{{ old('photo') }}"
                                                               name="photo" id="photo">
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-40">
                                        <div class="col-lg-12">
                                            <label>@lang('lang.description') <span class="text-red">*</span></label>
                                            <div class="input-effect">
                                                <textarea id="editor1"
                                                          class="primary-input form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                                          name="description" id="" cols="30" rows="10"
                                                          data-sample-short>{{isset($editData)? $editData->description:old('description')}}</textarea>

                                                <span class="focus-border"></span>
                                                @if ($errors->has('description'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-40">
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

    <script src="{{ asset('/')}}public/backEnd/backend_modules.js"></script>
@endsection
