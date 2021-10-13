@extends('backend.master')
@section('mainContent')

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.knowledge_base') @lang('lang.list')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#" class="active">@lang('lang.knowledge_base') @lang('lang.list')</a>
            </div>
        </div>
    </div>
</section>


<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        @if(isset($data['edit']) && !empty(@$data['edit']))
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{route('admin.ceateBlog')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    @lang('lang.add')
                </a>
            </div>
        </div>
        @endif



                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">

                                @if(isset($data['edit']) && !empty(@$data['edit']))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.knowledge_base')
                            </h3>
                        </div>
                        @if(isset($data['edit']) && !empty(@$data['edit']))
                            <form action="{{ route('admin.updateBlog')}}"  method="POST" class="form-horizontal" enctype="multipart/form-data" id="updateBlog">
                        @else
                            <form action="{{ route ('admin.storeBlog')}}" method="POST" class="form-horizontal" enctype="multipart/form-data" id="storeBlog">
                        @endif
                            @csrf

                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" type="text" name="title"
                                                   autocomplete="off" value="{{isset($data['edit'])? $data['edit']->title :old('title')}}">

                                            <input type="hidden" name="id" value="{{isset($data['edit'])? $data['edit']->id: ''}}">
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
                                        <div class="input-effect">
                                        <label>@lang('lang.description') <span>*</span></label>
                                         <textarea required class="{{ $errors->has('blog_description') ? ' is-invalid' : '' }}" name="blog_description">{{ isset($data['edit'])? $data['edit']->description: '' }} {{ old('blog_description') }}</textarea>
                                           


                                            <span class="focus-border"></span>
                                            @if ($errors->has('blog_description'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('blog_description') }}</strong>
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
                                                @foreach($data['category'] as $item)
                                                    <option value={{@$item->id}} {{ @$item->id == @$data['edit']->blog_category_id ?'selected':""}} >{{@$item->name}}</option>
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
                                        <div class="input-effect">
                                             <input class="primary-input form-control{{ $errors->has('tags') ? ' is-invalid' : '' }}" type="text" name="tags"
                                                   id="tags" placeholder="Tags" value="{{isset($data['edit'])? $data['edit']->tags :old('tags')}}">

                                            <span class="focus-border"></span>
                                            @if ($errors->has('tags'))
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong>{{ $errors->first('tags') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <select class="niceSelect w-100 bb form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status">
                                                <option data-display="@lang('lang.status') *" value="">@lang('lang.status') *</option>
                                                <option value="1" {{ @$data['edit']->status ==1 ?'selected':""}}>@lang('lang.active')</option>
                                                <option value="2" {{ @$data['edit']->status ==2 ?'selected':""}}>@lang('lang.inactive')</option>
                                            </select>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('status'))
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>



                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg">
                                            <span class="ti-check"></span>
                                            @if(isset($data['edit']))
                                                @lang('lang.update')
                                            @else
                                                @lang('lang.save')
                                            @endif
                                            @lang('lang.knowledge_base')

                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>



        </div>
    </div>
</section>

@endsection
@section('script')
      
<script src="{{asset('public/backend/backend.js')}}"></script>
@endsection



