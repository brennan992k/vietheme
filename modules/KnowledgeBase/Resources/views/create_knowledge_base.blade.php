@extends('backend.master')
@section('mainContent')

<link rel="stylesheet" href="{{url('Modules/Pages/Assets/css/style.css')}}">
<script src="https://cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script>

 
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.KnowledgeBase')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.KnowledgeBase') </a>
                <a href="#">@lang('lang.add') @lang('lang.question') @lang('lang.&') @lang('lang.answer')  </a>
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
                            <h3 class="mb-30">

                                    @lang('lang.add')  @lang('lang.KnowledgeBase')
                            </h3>
                        </div>

                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'create_kn_base',
                        'method' => 'POST', 'enctype' => 'multipart/form-data']) }}


                         <input type="hidden" name="id" value="{{isset($data['edit'])? $data['edit']->id: ''}}">
                        <div class="white-box">
                                {{-- @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif --}}
                            <div class="add-visitor">
                                 <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <select class="niceSelect w-100 bb form-control{{ $errors->has('question') ? ' is-invalid' : '' }}" name="question">
                                                <option data-display="@lang('lang.question') *" value="">@lang('lang.question') *</option>
                                                @foreach($data['questions'] as $item)
                                                    <option value={{$item->id}} >{{$item->first_question}}</option>
                                                 @endforeach
                                            </select>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('question'))
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong>{{ $errors->first('question') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                     
                                    </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('sub_question') ? ' is-invalid' : '' }}" type="text" name="sub_question"
                                                   autocomplete="off" value="{{ old('sub_question')}}">
                                                 <label>@lang('lang.sub') @lang('lang.question') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('sub_question'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('sub_question') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                 <div class="row mt-40">
                                    <div class="col-lg-12">
                                            <label>@lang('lang.answer')   <span class="text-red">*</span></label>
                                        <div class="input-effect">
                                            <textarea id="editor1" class="primary-input form-control{{ $errors->has('answer') ? ' is-invalid' : '' }}" name="answer" id="" cols="30" rows="10" data-sample-short>{{  old('answer')}}</textarea>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('answer'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('answer') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>                             
                                </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                      <button class="primary-btn fix-gr-bg" data-toggle="tooltip">
                                            <span class="ti-check"></span>
                                                @lang('lang.save')
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

<link rel="stylesheet" href="{{ url('/') }}/Modules/Blog/Resources/assets/css/tag_input.css">
<script src="{{ asset('/')}}public/backEnd/js/jquery.min.js"></script>
<script src="{{ asset('/')}}public/backEnd/backend_modules.js"></script>

@endsection
