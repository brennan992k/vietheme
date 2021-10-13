@extends('backend.master')
@section('mainContent') 
<link rel="stylesheet" href="{{url('Modules/Pages/Assets/css/style.css')}}">  
<script src="https://cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.ticket')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.frontend_CMS') </a>
                <a href="#">@lang('lang.ticket') @lang('lang.page') </a>
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
                                    @lang('lang.ticket') @lang('lang.page') 
                            </h3>

                        </div>
                      
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'TicketPageUpdate',
                        'method' => 'POST', 'enctype' => 'multipart/form-data']) }} 
                         <input type="hidden" name="id" value="{{isset($editData)? $editData->id: ''}}"> 
                        <div class="white-box">
                            <div class="add-visitor">  

                                <div class="row mt-40">
                                    <div class="col-lg-12"> 
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('heading') ? ' is-invalid' : '' }}"
                                                type="text" name="heading" autocomplete="off" value="{{isset($editData)? $editData->heading:old('heading')}}">
                                            <label>@lang('lang.heading') <span class="text-red">*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('heading'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('heading') }}</strong>
                                            </span>
                                            @endif
                                        </div> 
                                    </div> 
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4"
                                                        name="ticket_text">{{isset($editData)? @$editData->ticket_text: old('ticket_text')}}</textarea>
                                            <label>@lang('lang.ticket_text') <span class="text-red">*</span></label>
                                            <span class="focus-border textarea"></span>
                                            @if ($errors->has('ticket_text'))
                                                <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $errors->first('ticket_text') }}</strong>
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


@endsection
