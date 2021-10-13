@extends('backend.master')
@section('mainContent') 
<link rel="stylesheet" href="{{url('Modules/Pages/Assets/css/style.css')}}">  
<script src="https://cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.coupon')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.frontend_CMS') </a>
                <a href="#">@lang('lang.coupon') @lang('lang.page') </a>
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
                                    @lang('lang.coupon') @lang('lang.page') 
                            </h3>

                        </div>
                      
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'coupon-text-update',
                        'method' => 'POST', 'enctype' => 'multipart/form-data']) }} 
                         <input type="hidden" name="id" value="{{isset($editData)? $editData->id: ''}}"> 
                        <div class="white-box">
                            <div class="add-visitor">  
                                {{-- HomePage --}}
                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4"
                                                        name="coupon">{{isset($editData)? @$editData->coupon: old('coupon')}}</textarea>
                                            <label>@lang('lang.coupon') *<span></span></label>
                                            <span class="focus-border textarea"></span>
                                            @if ($errors->has('coupon'))
                                                <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $errors->first('coupon') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4"
                                                        name="add_coupon">{{isset($editData)? @$editData->add_coupon: old('add_coupon')}}</textarea>
                                            <label>@lang('lang.add_coupon') *<span></span></label>
                                            <span class="focus-border textarea"></span>
                                            @if ($errors->has('add_coupon'))
                                                <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $errors->first('add_coupon') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4"
                                                        name="delete_coupon">{{isset($editData)? @$editData->delete_coupon: old('delete_coupon')}}</textarea>
                                            <label>@lang('lang.delete_coupon') *<span></span></label>
                                            <span class="focus-border textarea"></span>
                                            @if ($errors->has('delete_coupon'))
                                                <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $errors->first('delete_coupon') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4"
                                                        name="expired_coupon">{{isset($editData)? @$editData->expired_coupon: old('expired_coupon')}}</textarea>
                                            <label>@lang('lang.expired_coupon') *<span></span></label>
                                            <span class="focus-border textarea"></span>
                                            @if ($errors->has('expired_coupon'))
                                                <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $errors->first('expired_coupon') }}</strong>
                                            </span>
                                            @endif
                                        </div>
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
