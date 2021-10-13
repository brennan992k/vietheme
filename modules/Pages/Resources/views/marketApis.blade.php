@extends('backend.master')
@section('mainContent') 
<link rel="stylesheet" href="{{url('Modules/Pages/Assets/css/style.css')}}">  
<script src="https://cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.market_apis')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.frontend_CMS') </a>
                <a href="#">@lang('lang.market_apis') </a>
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
                                @lang('lang.market_apis')
                            </h3>
                        </div>
                      
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'market-apis-update',
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
                               
                                <div class="row mt-40">
                                    <div class="col-lg-12"> 
                                            <label>@lang('lang.description')   <span class="text-red">*</span></label>
                                        <div class="input-effect">
                                            <textarea id="editor1" class="primary-input form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="" cols="30" rows="10" data-sample-short>{{isset($editData)? $editData->description:old('description')}}</textarea> 
                                            
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



 
    <script src="{{ asset('/')}}public/backend/backend_modules.js"></script>

@endsection
