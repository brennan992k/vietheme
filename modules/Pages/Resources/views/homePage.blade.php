@extends('backend.master')
@section('mainContent') 
<link rel="stylesheet" href="{{url('Modules/Pages/Assets/css/style.css')}}">  
<script src="https://cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.home_page')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.frontend_CMS') </a>
                <a href="#">@lang('lang.home_page') </a>
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
                                @lang('lang.home_page')
                            </h3>

                        </div>
                      
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'home-page-update',
                        'method' => 'POST', 'enctype' => 'multipart/form-data']) }} 
                         <input type="hidden" name="id" value="{{isset($editData)? $editData->id: ''}}"> 
                        <div class="white-box">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            <div class="add-visitor">  
                                {{-- HomePage --}}
                                <div class="row mt-40">
                                    <div class="col-lg-12"> 
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('homepage_title') ? ' is-invalid' : '' }}"
                                                type="text" name="homepage_title" autocomplete="off" value="{{isset($editData)? $editData->homepage_title:old('homepage_title')}}">
                                            <label>@lang('lang.Home_page') @lang('lang.title') <span class="text-red">*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('homepage_title'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('homepage_title') }}</strong>
                                            </span>
                                            @endif
                                        </div> 
                                    </div> 
                                </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12"> 
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('homepage_description') ? ' is-invalid' : '' }}"
                                                type="text" name="homepage_description" autocomplete="off" value="{{isset($editData)? $editData->homepage_description:old('homepage_description')}}">
                                            <label>@lang('lang.Home_page') @lang('lang.description') <span class="text-red">*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('homepage_description'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('homepage_description') }}</strong>
                                            </span>
                                            @endif
                                        </div> 
                                    </div> 
                                </div>
                                {{-- Feature --}}
                                <div class="row mt-40">
                                    <div class="col-lg-12"> 
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('feature_title') ? ' is-invalid' : '' }}"
                                                type="text" name="feature_title" autocomplete="off" value="{{isset($editData)? $editData->feature_title:old('feature_title')}}">
                                            <label>@lang('lang.feature') @lang('lang.title') <span class="text-red">*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('feature_title'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('feature_title') }}</strong>
                                            </span>
                                            @endif
                                        </div> 
                                    </div> 
                                </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12"> 
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('feature_title_description') ? ' is-invalid' : '' }}"
                                                type="text" name="feature_title_description" autocomplete="off" value="{{isset($editData)? $editData->feature_title_description:old('feature_title_description')}}">
                                            <label>@lang('lang.feature') @lang('lang.title') @lang('lang.description') <span class="text-red">*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('feature_title_description'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('feature_title_description') }}</strong>
                                            </span>
                                            @endif
                                        </div> 
                                    </div> 
                                </div>
                                {{-- product --}}
                                <div class="row mt-40">
                                    <div class="col-lg-12"> 
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('product_title') ? ' is-invalid' : '' }}"
                                                type="text" name="product_title" autocomplete="off" value="{{isset($editData)? $editData->product_title:old('product_title')}}">
                                            <label>@lang('lang.product') @lang('lang.title') <span class="text-red">*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('product_title'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('product_title') }}</strong>
                                            </span>
                                            @endif
                                        </div> 
                                    </div> 
                                </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12"> 
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('product_title_description') ? ' is-invalid' : '' }}"
                                                type="text" name="product_title_description" autocomplete="off" value="{{isset($editData)? $editData->product_title_description:old('product_title_description')}}">
                                            <label>@lang('lang.product') @lang('lang.title') @lang('lang.description') <span class="text-red">*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('product_title_description'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('product_title_description') }}</strong>
                                            </span>
                                            @endif
                                        </div> 
                                    </div> 
                                </div>
                                <div class="row mt-40">
                                 
                                    <div class="col-lg-6"> 
                                        <div class="input-effect">
                                            <img height="200"  src="{{ file_exists(@$editData->banner_image) ? asset(@$editData->banner_image) : asset('public/frontend/img/banner/banner-img-1.png') }} " alt="">
                                        </div> 
                                    </div> 
                                    <div class="col-lg-6 mt-45" style="margin-top: 160px;">
                                        <div class="row no-gutters input-right-icon">
                                      
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input form-control {{ $errors->has('banner_image') ? ' is-invalid' : '' }}" type="text"
                                                            id="placeholderPhoto"
                                                            placeholder=""
                                                            readonly="">
                                                    <span class="focus-border"></span>
                                                    @if ($errors->has('banner_image'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('banner_image') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="primary-btn-small-input"
                                                        type="button">
                                                    <label class="primary-btn small fix-gr-bg"
                                                            for="photo">@lang('lang.browse')</label>
                                                    <input type="file" class="d-none" name="banner_image"
                                                    id="photo">
                                                </button>
                                                
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



 
    <script src="{{ asset('/')}}public/backend/backend_modules.js"></script>

@endsection
