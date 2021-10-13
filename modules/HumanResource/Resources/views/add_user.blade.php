@extends('backend.master')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/')}}/css/croppie.css">

@endsection
@section('mainContent')
@php
function showPicName($data){
$name = explode('/', $data);
return $name[array_key_last($name)];
}
@endphp


<link rel="stylesheet" href="{{'public/bkacEnd/'}}/modules.css">
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            @if (@$edit)                
               <h1>@lang('lang.edit')  @lang('lang.user')</h1>
            @else
              <h1>@lang('lang.add') @lang('lang.new') @lang('lang.user')</h1>
            @endif
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.user') @lang('lang.management')</a>
                @if (@$edit)                
                <a href="#">@lang('lang.edit') @lang('lang.user')</a>
                @else
                 <a href="#">@lang('lang.add') @lang('lang.new') @lang('lang.user')</a>
                @endif
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-8 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30">@lang('lang.user') @lang('lang.information')</h3>
                </div>
            </div>

            <div class="col-lg-4 text-md-right text-left col-md-6 mb-30-lg">
                <a href="{{route('admin.user_list')}}" class="primary-btn small fix-gr-bg">
                     @lang('lang.all') @lang('lang.user') @lang('lang.list')
                </a>
            </div>
            
        </div>
        @if (@isset($edit))
        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'admin.add_user_update', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
        @else            
          {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'admin.add_user_store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
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
              <div class="white-box">
                <div class="">
                   
                    <input type="hidden" name="url" id="url" value="{{URL::to('/')}}"> 
                    <input type="hidden" name="id" id="id" value="{{ isset($edit) ? $edit->id : '' }}"> 
                    <div class="row ">
                     
                        <div class="col-lg-3 mb-30">
                            <div class="input-effect">
                                <select class="niceSelect w-100 bb form-control{{ $errors->has('role_id') ? ' is-invalid' : '' }}" name="role_id" id="role_id">
                                    <option data-display="Role *" value="">@lang('lang.select')</option>
                                    @foreach($roles as $key=>$value)
                                    <option value="{{$value->id}}" {{ isset($edit) ? $edit->role_id == $value->id? 'selected': '' : old('role_id') == ($value->id? 'selected': '')}} >{{$value->name}}</option>
                                    {{-- <option value="{{$value->id}}" {{ isset($edit) ? $edit->role_id == $value->id ? 'selected':(old("role_id") ==  $value->id? "selected":"" ) : "" }}>{{$value->name}}</option> --}}
                                    @endforeach
                                </select>
                                <span class="focus-border"></span>
                                @if ($errors->has('role_id'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('role_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3 mb-30">
                            <div class="input-effect">
                                <input class="primary-input form-control {{$errors->has('first_name') ? 'is-invalid' : ' '}}" type="text"  name="first_name" value="{{ isset($edit) ? $edit->profile->first_name : old('first_name') }}">
                                <span class="focus-border"></span>
                                <label>@lang('lang.first') @lang('lang.name') <span>*</span> </label>
                                @if ($errors->has('first_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3 mb-30">
                            <div class="input-effect">
                                <input class="primary-input form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" type="text"  name="last_name" value="{{ isset($edit) ? $edit->profile->last_name : old('last_name') }}">
                                <span class="focus-border"></span>
                                <label>@lang('lang.last') @lang('lang.name') <span>*</span> </label>
                                @if ($errors->has('last_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3 mb-30">
                            <div class="input-effect">
                                <input class="primary-input form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" type="text" name="username" value="{{old('username')? old('username') : @$edit->username}}">
                                <span class="focus-border"></span>
                                <label>@lang('lang.user') @lang('lang.name') <span>*</span></label>
                                @if ($errors->has('username'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                       <div class="col-lg-3 mb-30">
                        <div class="input-effect">
                            <input class="primary-input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email"  name="email" value="{{old('email')? old('email') : @$edit->email}}">
                            <span class="focus-border"></span>
                            <label>@lang('lang.email') <span>*</span> </label>
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                   
                    <div class="col-lg-3 mb-30">
                        <div class="no-gutters input-right-icon">
                            <div class="col">
                                <div class="input-effect">
                                    <input class="primary-input date form-control{{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" id="startDate" type="text"
                                     name="date_of_birth" value="{{ old('date_of_birth')? old('date_of_birth') : @$edit->profile->dob }}" autocomplete="off">
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
                    <div class="col-lg-3 mb-30">
                        <div class="no-gutters input-right-icon">
                            <div class="col">
                                <div class="input-effect">
                                    <input class="primary-input date form-control{{ $errors->has('date_of_joining') ? ' is-invalid' : '' }}" id="date_of_joining" type="text"
                                     name="date_of_joining" value="{{ isset($edit->profile->date_of_joining) ?$edit->profile->date_of_joining: date('m/d/Y')}}">
                                    <span class="focus-border"></span>
                                    <label> @lang('lang.date_of_joining') <span>*</span> </label>
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
                    <div class="col-lg-3 mb-30">
                        <div class="input-effect">
                            <input class="primary-input form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" type="text" onkeypress="return isNumberKey(event)"  name="mobile" value="{{old('mobile')? old('mobile') : @$edit->profile->mobile}}">
                            <span class="focus-border"></span>
                            <label>@lang('lang.mobile') <span></span> </label>
                            @if ($errors->has('mobile'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('mobile') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row ">
                
                
                <div class="col-lg-6 mt-45">
                <div class="row no-gutters input-right-icon">
              
                    <div class="col">
                        <div class="input-effect">
                            <input class="primary-input form-control {{ $errors->has('image') ? ' is-invalid' : '' }}" type="text"
                                    id="placeholderPhoto"
                                    placeholder="{{@$edit->profile->image != ""? showPicName(@$edit->profile->image):'Profile Photo (100 * 100 px)'}}"
                                    readonly="">
                            <span class="focus-border"></span>
                            @if ($errors->has('image'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-auto">
                        <button class="primary-btn-small-input"
                                type="button">
                            <label class="primary-btn small fix-gr-bg"
                                    for="photo">@lang('lang.browse')</label>
                            <input type="file" class="d-none" name="image"
                            id="photo">
                        </button>
                        
                    </div>
                </div>
            </div>
                    <div class="col-lg-6">
                        <div class="input-effect">
                            <textarea class="primary-input form-control {{ $errors->has('current_address') ? 'is-invalid' : ''}}" cols="0" rows="4" name="current_address" id="current_address">{{ isset($edit) ? $edit->profile->address : old('current_address') }}</textarea>
                            <label>@lang('lang.address') <span></span> </label>
                            <span class="focus-border textarea"></span>
    
                            @if ($errors->has('current_address'))
                             <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('current_address') }}</strong>
                            </span>
                            @endif 
                        </div>
                    </div>
    
                </div>

<div class="row mt-40">
    <div class="col-lg-12 text-center">
        <button class="primary-btn fix-gr-bg">
            <span class="ti-check"></span>
            
            @if (@isset($edit))
            @lang('lang.update')  @lang('lang.user') 
        @else
            @lang('lang.save') @lang('lang.user')
        @endif

        </button>
    </div>
</div>
</div>
</div>
</div>
</div>
{{ Form::close() }}
</div>
</section>

<div class="modal" id="LogoPic">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">@lang('lang.Crop_Image_And_Upload')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div id="resize"></div>
                <button class="btn rotate float-lef" data-deg="90" > 
                <i class="ti-back-right"></i></button>
                <button class="btn rotate float-right" data-deg="-90" > 
                <i class="ti-back-left"></i></button>
                <hr>
                
                <button class="primary-btn fix-gr-bg pull-right" id="upload_logo">@lang('lang.crop')</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('public/backend/')}}/js/croppie.js"></script>
<script src="{{asset('public/backend/')}}/js/editStaff.js"></script>
@endsection
