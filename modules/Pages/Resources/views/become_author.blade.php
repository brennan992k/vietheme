@extends('backend.master')
@push('css')
<link rel="stylesheet" href="{{ asset('public/frontend/css/summernote.css') }}">


<link rel="stylesheet" href="{{'public/bkacEnd/'}}/modules.css">
@endpush
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.become_author_text')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.frontend_CMS') </a>
                <a href="#">@lang('lang.become_author_text')</a>
               
                {{-- <a href="#">@if(isset($editData)) @lang('lang.edit') @else @lang('lang.add') @endif @lang('lang.ticket_system')</a> --}}
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        @if(isset($editData) && Auth::user()->role_id == 1)   
               <div class="row">
                   
                </div>
            @endif
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
            <div class="row mt-40">
                <div class="col-lg-12">
                      
                    <div class="white-box">
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => ['become-author-store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                       {{-- <input type="hidden" name="id" value="{{ $editData->id }}"> --}}
                        
                         <div class="row">
                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                <div class="col-lg-12">
                                    <div class="row">
                                      
                                            <div class="col-lg-12 pt-5">
                                                <div class="input-effect">
                                                    <label>@lang('lang.description') <span>*</span> </label>
                                                        <textarea class=" site_image_hidden_bg_image form-control summernote-editor {{ $errors->has('description') ? ' is-invalid' : '' }}" rows="5" name="description" cols="50" id="editor1" >{!! @$editData->description !!}</textarea>
                                                        
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('description'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('description') }}</strong>
                                                        </span>
                                                        @endif
                                                </div>
                                            </div>
                                    </div>    
                                </div>
                                <div class="col-lg-4">
                                    <div class="row">
                                      
                                    </div>    
                                </div>    
                                <div class="col-lg-12 mt-20 text-center">
                                    <button type="submit" class="primary-btn small fix-gr-bg">
                                        <span class="ti-check"></span>
                                        @if(isset($editData))
                                                @lang('lang.update')
                                            @else
                                                @lang('lang.save')
                                            @endif
                                    </button>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div> 
            </div>

    </div>
</section>
@endsection
@section('script')
<script src="{{ asset('public/frontend/js/') }}/frontend_editor.js"></script>
@endsection
