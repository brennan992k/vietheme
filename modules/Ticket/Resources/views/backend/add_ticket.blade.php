@extends('backend.master')
@push('css')
<link rel="stylesheet" href="{{ asset('public/frontend/css/summernote.css') }}">


<link rel="stylesheet" href="{{'public/bkacEnd/'}}/modules.css">
@endpush
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.ticket_system')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
               
                <a href="{{ route('infixTicket_list') }}">@lang('lang.ticket_system')</a>
               
                <a href="#">@if(isset($editData)) @lang('lang.edit') @else @lang('lang.add') @endif @lang('lang.ticket_system')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        @if(isset($editData) && Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 2)   
               <div class="row">
                    <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                        <a href="{{ route('infixTicket_ticket') }}" target="_blank" class="primary-btn small fix-gr-bg">
                            <span class="ti-plus pr-2"></span>
                            @lang('lang.add')
                        </a>
                    </div>
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
                        @if(isset($editData))
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => ['infixTicket_update'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                       <input type="hidden" name="id" value="{{ $editData->id }}">
                        @else
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => ['infixTicket_store'], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_studentA']) }}
                         @endif   
                         <div class="row">
                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-12 mt-30-md">
                                                <div class="input-effect">
                                                        <input class="primary-input form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}"
                                                        type="text" name="subject" autocomplete="off" value="{{isset($editData)? $editData->subject : '' }}">
                                                        <label>@lang('lang.subject') <span>*</span> </label>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('subject'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('subject') }}</strong>
                                                        </span>
                                                        @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-12 pt-5">
                                                <div class="input-effect">
                                                    <label>@lang('lang.description') <span>*</span> </label>
                                                        <textarea id="editor1" class=" site_image_hidden_bg_image form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" rows="5" name="description" cols="50" >{{isset($editData)? strip_tags($editData->description) : '' }}</textarea>
                                                        
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
                                        <div class="col-lg-12">
                                            <select class="niceSelect w-100 bb form-control{{ $errors->has('category') ? ' is-invalid' : '' }}" id="select_class" name="category" >
                                                <option data-display="@lang('lang.ticket_category') *" value="">@lang('lang.ticket_category') @lang('lang.select') *</option>
                                                @foreach($category as $item)
                                                <option value="{{$item->id}}" {{isset($editData->category_id) !=null? ($item->id == @$editData->category_id? 'selected':''):''}}>{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                                @if ($errors->has('category'))
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong>{{ $errors->first('category') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="col-lg-12 mt-5">
                                            <select class="niceSelect w-100 bb form-control{{ $errors->has('priority') ? ' is-invalid' : '' }}" id="select_class" name="priority">
                                                <option data-display="@lang('lang.ticket_priority') *" value="">@lang('lang.ticket_priority') @lang('lang.select') *</option>
                                                @foreach($priority as $item)
                                                <option value="{{$item->id}}" {{isset($editData->priority_id)? ($item->id == @$editData->priority_id? 'selected':''):''}}>{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                                @if ($errors->has('priority'))
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong>{{ $errors->first('priority') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                            <div class="col-lg-12 mt-5">
                                                <select class="niceSelect w-100 bb   form-control{{ $errors->has('active_status') ? ' is-invalid' : '' }}" id="select_class" name="active_status">
                                                    <option data-display="@lang('lang.status')" value="">@lang('lang.status') @lang('lang.select')</option>
                                                    <option value="0" {{ isset($editData)? $editData->active_status == 0 ? 'selected':'':'' }}>@lang('lang.pending')</option>
                                                    <option value="1" {{ isset($editData)? $editData->active_status == 1 ? 'selected':'':'' }}>@lang('lang.close')</option>
                                                    <option value="2" {{ isset($editData)? $editData->active_status == 2 ? 'selected':'':'' }}>@lang('lang.progress')</option>
                                                </select>
                                            </div>
                                         @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                         <div class="col-lg-12 mt-5">
                                             <select class="niceSelect w-100 bb form-control{{ $errors->has('user_agent') ? ' is-invalid' : '' }}" id="select_class" name="user_agent">
                                                 <option data-display="@lang('lang.assignee') *" value="">@lang('lang.assignee') *</option>
                                                @foreach ($user_agent as $item)
                                                <option value="{{ $item->id }}" {{ isset($editData) ? $editData->user_agent == $item->id ? 'selected':'':'' }}>{{ $item->username }}</option>
                                                @endforeach
                                             </select>
                                                 @if ($errors->has('user_agent'))
                                                  <span class="invalid-feedback invalid-select" role="alert" >
                                                 <strong>{{ $errors->first('user_agent') }}</strong>
                                             </span>
                                             @endif
                                         </div>
                                          @endif   
                                        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                       <div class="col-lg-12 mt-5">
                                            <select class="niceSelect w-100 bb form-control{{ $errors->has('user') ? ' is-invalid' : '' }}" id="select_class" name="user">
                                                <option data-display="@lang('lang.user') " value="">@lang('lang.user') @lang('lang.select') </option>
                                               @foreach ($user as $item)
                                               <option value="{{ $item->id }}" {{ isset($editData) ? $editData->user_id == $item->id ? 'selected':'':'' }}>{{ $item->username }}</option>
                                               @endforeach
                                            </select>
                                                @if ($errors->has('user'))
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong>{{ $errors->first('user') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                         @endif   
                                    </div>    
                                </div>    
                                <div class="col-lg-12 mt-20 text-right">
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
<link rel="stylesheet" href="{{ url('/') }}/Modules/Blog/Resources/assets/css/tag_input.css">
<script src="{{ asset('/')}}public/backEnd/js/jquery.min.js"></script>
<script src="{{ asset('/')}}public/backEnd/backend_modules.js"></script>

@endsection
