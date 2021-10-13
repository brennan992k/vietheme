@extends('backend.master')
@section('mainContent')


<link rel="stylesheet" href="{{'public/bkacEnd/'}}/modules.css">

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.KnowledgeBase')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#" class="active">@lang('lang.KnowledgeBase') @lang('lang.list')</a>
            </div>
        </div>
    </div>
</section>


<section class="admin-visitor-area DM_table_info">

        <div class="row">
                <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                    <a href="{{route('add_knowledge_base')}}" class="primary-btn small fix-gr-bg">
                        <span class="ti-plus pr-2"></span>
                        @lang('lang.add')
                    </a>
                </div>
            </div>
        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'SearchquestionList', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'infix_form']) }}
        <div class="row mb-25">
            <div class="col-lg-12">
            <div class="white-box">
                <div class="row">
                    <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                    <div class="col-lg-6 sm_mb_20 sm2_mb_20 md_mb_20">
                        <select class="niceSelect w-100 bb form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="select_class" name="category">
                            <option data-display="@lang('lang.select') @lang('lang.category') *" value="">@lang('lang.select') @lang('lang.category')</option>
                            @foreach($data['categories'] as $item)
                            <option value="{{$item->id}}" {{isset($data['category'])? ($item->id == $data['category']? 'selected':''):''}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('class'))
                        <span class="invalid-feedback invalid-select" role="alert">
                            <strong>{{ $errors->first('class') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-lg-6">
                        <div class="input-effect sm_mb_20 sm2_mb_20 md_mb_20">
                            <input class="primary-input" type="text" name="key" value="{{ isset($data['key'])?$data['key']:''}}">
                            <label>@lang('lang.search_by_name')</label>
                            <span class="focus-border"></span>
                        </div>
                    </div>
                    
                    <div class="col-lg-12 mt-20 text-right">
                        <button type="submit" class="primary-btn small fix-gr-bg" id="btnsubmit">
                            <span class="ti-search pr-2"></span>
                            @lang('lang.search')
                        </button>
                    </div>
                </div>
                </div>
            </div>
        </div>

        {{ Form::close() }}

  @if(isset($data['knowledge_base']))
    <div class="container-fluid p-0">
            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
        <div class="row">

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-10 no-gutters">
                        <div class="main-title ">
                            <h3 class="mb-0">@lang('lang.KnowledgeBase') @lang('lang.list')</h3>
                        </div>
                    </div>

                </div>
                <div class="row pt-20">
                    <div class="col-lg-12">
                        {{-- Ajax Table --}}
                        {{-- <table id="table_id" class="display school-table knowledgebase_table" cellspacing="0" width="100%">

                            <thead>

                                <tr>
                                    
                                    <th>@lang('lang.category')</th>
                                    <th>@lang('lang.question')</th>
                                    <th>@lang('lang.sub') @lang('lang.question')</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>
                            <tbody id="knowledgebase_list">
                                   
                            </tbody>
                        </table> --}}


                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>

                                <tr>
                                    
                                    <th>@lang('lang.category')</th>
                                    <th>@lang('lang.question')</th>
                                    <th>@lang('lang.sub') @lang('lang.question')</th>
                                    {{-- <th>@lang('lang.answer')</th> --}}
                                    {{-- <th>@lang('lang.user')</th> --}}

                                    {{-- <th>@lang('lang.status')</th> --}}
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($data['knowledge_base'] as $item)

                                <tr>
                                    <td valign="top">{{Str::limit($item->name)}}</td>
                                    <td valign="top">{{Str::limit($item->first_question)}}</td>
                                    <td valign="top">{{Str::limit($item->sub_question)}}</td>
                                  
                                  
                                    <td valign="top">
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                             {{-- @if ($item->active_status == 1)
                                               <a class="dropdown-item" > @lang('lang.active')</a>
                                                @else
                                                  <a class="dropdown-item" > @lang('lang.pending')</a>
                                                @endif --}}
                                                <a class="dropdown-item" data-toggle="modal" data-target="#showBlogModal{{$item->id}}">@lang('lang.view')</a>
                                                <a class="dropdown-item" href="{{ route('kn_baseEdit',$item->id)}}">@lang('lang.edit')</a>
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteblogModal{{$item->id}}"  href="">@lang('lang.delete')</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                
                                <div class="modal fade admin-query" id="showBlogModal{{$item->id}}" >
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <div class="text-center">
                                            </div>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-12">                                
                                                    <b>@lang('lang.question') : </b>  {{ $item->first_question }} </div>                                                
                                                    <div class="col-lg-12">  
                                                        <b>@lang('lang.sub_question') : </b>  {{ $item->sub_question }} </div>                                                
                                                    </div>
                                                    <div class="row mt-40">
                                                    <div class="col-lg-12">  
                                                        <p  class="mb-0 blog_description"> <b>@lang('lang.answer'):</b>  {!! $item->answer !!}</p>                                
                                                    </div>
                                                    </div>
                                                    <div class="row">                                             
                                                        <div class="col-lg-12 text-right">
                                                            <img src="{{ url('/') }}/Modules/Blog/002-grid.png" height="20px" width="20px" alt="category_icon"> {{ $item->name }}                                                             
                                                        </div>
                                                    </div>
                                                </div>
                                        
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                  <div class="modal fade admin-query" id="deleteblogModal{{$item->id}}" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('lang.delete') @lang('lang.KnowledgeBase')</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                    <a href="{{ route('blogKnBase',$item->id) }}" class="text-light">
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
    @endif
</section>

@endsection



