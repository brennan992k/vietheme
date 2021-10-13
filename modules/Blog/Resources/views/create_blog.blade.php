@extends('backend.master')
@section('mainContent')

<link rel="stylesheet" href="{{url('Modules/Pages/Assets/css/style.css')}}">
<script src="https://cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script>

 
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.blog')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.blog') </a>
                <a href="#">@lang('lang.add') @lang('lang.blog') </a>
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

                                    @lang('lang.add')  @lang('lang.blog')
                            </h3>
                        </div>

                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'create_blog',
                        'method' => 'POST', 'enctype' => 'multipart/form-data']) }}


                         <input type="hidden" name="id" value="{{isset($data['edit'])? $data['edit']->id: ''}}">
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" type="text" name="title"
                                                   autocomplete="off" value="{{ old('title')}}">

                                            {{-- <input type="hidden" name="id" value="{{isset($data['edit'])? $data['edit']->id: ''}}"> --}}
                                            <label>@lang('lang.title') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('title'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                 <div class="row mt-40">
                                    <div class="col-lg-12">
                                            <label>@lang('lang.description')   <span class="text-red">*</span></label>
                                        <div class="input-effect">
                                            <textarea id="editor1" class="primary-input form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="" cols="30" rows="10" data-sample-short>{{  old('description')}}</textarea>

                                            <span class="focus-border"></span>
                                            @if ($errors->has('description'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-6">
                                        <div class="input-effect">
                                            <select class="niceSelect w-100 bb form-control{{ $errors->has('category') ? ' is-invalid' : '' }}" name="category">
                                                <option data-display="@lang('lang.category') *" value="">@lang('lang.category') *</option>
                                                @foreach($data['categories'] as $item)
                                                    <option value={{$item->id}} >{{$item->name}}</option>
                                                 @endforeach
                                            </select>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('category'))
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong>{{ $errors->first('category') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-effect taglist_input">
                                            <input class="primary-input form-control{{ $errors->has('tags') ? ' is-invalid' : '' }}" type="text"  name="tags" id="input-tags"
                                                    data-role="tagsinput" data-toggle="tooltip"  title="Tag should be single word" placeholder="Tags" value="{{ old('tags')}}">                      
                                                    <span class="focus-border"></span>
                                                    @if ($errors->has('tags'))
                                                    <span class="invalid-feedback invalid-select" role="alert">
                                                        <strong>{{ $errors->first('tags') }}</strong>
                                                    </span>
                                                    @endif
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="row mt-40">
                                    <div class="col-lg-6">
                                        <div class="row no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input" type="text" id="placeholderPhoto" placeholder="@lang('lang.upload') @lang('lang.image')" readonly="">
                                                    <span class="focus-border"></span>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="primary-btn-small-input" type="button">
                                                    <label class="primary-btn small fix-gr-bg" for="photo">@lang('lang.browse')</label>
                                                    <input accept=".jpg,.png,.jpeg" type="file" class="d-none" value="{{ old('photo') }}" name="photo" id="photo">
                                                </button>
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
