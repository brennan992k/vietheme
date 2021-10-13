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


<section class="admin-visitor-area">
    <div class="row">
        <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
            <a href="{{route('add_knowledge_base')}}" class="primary-btn small fix-gr-bg">
                <span class="ti-plus pr-2"></span>
                @lang('lang.add')
            </a>
        </div>
    </div>

    <div class="container-fluid p-0">

        <div class="row">

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-10 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0">@lang('lang.KnowledgeBase') @lang('lang.list')</h3>
                        </div>
                    </div>

                </div>
                <div class="row pt-20">
                    <div class="col-lg-12">

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
                                    <td valign="top">{{str_limit($item->name)}}</td>
                                    <td valign="top">{{str_limit($item->first_question)}}</td>
                                    <td valign="top">{{str_limit($item->sub_question)}}</td>


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
                                                <a class="dropdown-item" data-toggle="modal"
                                                    data-target="#showBlogModal{{$item->id}}">@lang('lang.view')</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('kn_baseEdit',$item->id)}}">@lang('lang.edit')</a>
                                                <a class="dropdown-item" data-toggle="modal"
                                                    data-target="#deleteblogModal{{$item->id}}"
                                                    href="">@lang('lang.delete')</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>


                                <div class="modal fade admin-query" id="showBlogModal{{$item->id}}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="text-center">
                                                    <h4 class="modal-title">{{ $item->first_question }}</h4>
                                                </div>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <b>-></b> {{ $item->sub_question }}
                                                    </div>
                                                    <div class="col-lg-6">
                                                    </div>
                                                </div>
                                                <br>
                                                <p class="mb-0 blog_description"> <b>Answer:</b> {!! $item->answer !!}
                                                </p>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                    </div>
                                                    <div class="col-lg-6 text-right">
                                                        <img src="{{ url('/') }}/Modules/Blog/002-grid.png"
                                                            height="20px" width="20px" alt="category_icon">
                                                        {{ $item->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="modal fade admin-query" id="deleteblogModal{{$item->id}}">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('lang.delete') @lang('lang.blog')</h4>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg"
                                                        data-dismiss="modal">@lang('lang.cancel')</button>
                                                    <a href="{{ route('blogKnBase',$item->id) }}" class="text-light">
                                                        <button class="primary-btn fix-gr-bg"
                                                            type="submit">@lang('lang.delete')</button>
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

@endsection