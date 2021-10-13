@extends('backend.master')
@section('mainContent') 
<link rel="stylesheet" href="{{url('Modules/Pages/Assets/css/style.css')}}">  
<script src="https://cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script>

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.faqs') @lang('lang.list') </h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.frontend_CMS') </a>
                <a href="#">@lang('lang.faqs') @lang('lang.list') </a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        
        <div class="row">  

            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30"> 
                                @if(@$editData)
                                    @lang('lang.update')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.faqs') 
                            </h3>
                        </div>
                      
                        @if(@$editData)
                            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'faqs-update', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }} 
                            <input type="hidden" name="id" value="{{isset($editData)? $editData->id:old('id')}}"> 
                         @else
                            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'faqs-store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }} 
                         @endif 


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
                                <div class="row mt-40">
                                    <div class="col-lg-12"> 
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('question_title') ? ' is-invalid' : '' }}"
                                                type="text" name="question_title" autocomplete="off" value="{{isset($editData)? $editData->question_title:old('question_title')}}">
                                            <label>@lang('lang.question') @lang('lang.title') <span class="text-red">*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('question_title'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('question_title') }}</strong>
                                            </span>
                                            @endif
                                        </div> 
                                    </div> 
                                </div>



                                <div class="row mt-40">
                                    <div class="col-lg-12"> 
                                            <label>@lang('lang.question') @lang('lang.answer')  <span class="text-red">*</span></label>
                                        <div class="input-effect">
                                            <textarea id="editor" class="primary-input form-control{{ $errors->has('question_answer') ? ' is-invalid' : '' }}" name="question_answer" id="" cols="30" rows="10" data-sample-short>{!! isset($editData)? $editData->question_answer:old('question_answer') !!}</textarea> 
                                            
                                            <span class="focus-border"></span>
                                            @if ($errors->has('question_answer'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('question_answer') }}</strong>
                                            </span>
                                            @endif
                                        </div> 
                                    </div> 
                                </div>



                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                      <button type="submit" class="primary-btn fix-gr-bg">
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
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0">@lang('lang.faqs') @lang('lang.list')</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead> 
                                <tr>
                                    <th>@lang('lang.sl')</th>
                                    <th>@lang('lang.question') @lang('lang.title') </th>
                                    <th>@lang('lang.question') @lang('lang.answer') </th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sl=1;
                                @endphp
                                @foreach($data as $row)
                                <tr>
                                    <td>{{$sl++}}</td>
                                    <td>{{$row->question_title}}</td>
                                    <td>{!! $row->question_answer !!}</td>
                                    
                                    <td valign="top">
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right"> 
                                                <a class="dropdown-item" href="{{route('faqs-edit', [$row->id])}}">@lang('lang.edit')</a> 
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteFAQ{{$row->id}}"  href="{{route('faqs-delete', [$row->id])}}">@lang('lang.delete')</a>
                                        
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                
                                  <div class="modal fade admin-query" id="deleteFAQ{{$row->id}}" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('lang.delete') @lang('lang.faqs')</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                    <a href="{{route('faqs-delete', [$row->id])}}" class="text-light">
                                                    <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                                                     </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
 
        </div>
    </div>
</section>




    <script src="{{ asset('/')}}public/backend/backend_modules.js"></script>

@endsection
