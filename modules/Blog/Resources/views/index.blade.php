@extends('backend.master')
@section('mainContent')

<link rel="stylesheet" href="{{'public/bkacEnd/'}}/modules.css">
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.blog')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#" class="active">@lang('lang.blog') @lang('lang.list')</a>
            </div>
        </div>
    </div>
</section>


<section class="admin-visitor-area">
<div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{route('add_blog')}}" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-0">@lang('lang.blog') @lang('lang.list')</h3>
                        </div>
                    </div>

                </div>
                <div class="row pt-20">
                    <div class="col-lg-12">
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                            <thead>

                                <tr>
                                    <th>@lang('lang.title')</th>
                                    <th>@lang('lang.category')</th>
                                    <th>@lang('lang.Tags')</th>
                                    <th>@lang('lang.user')</th>

                                    <th>@lang('lang.status')</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($data['blog'] as $item)

                                <tr>
                                    <td valign="top">{{Str::limit($item->title,20)}}</td>
                                    <td valign="top">{{$item->category_name}}</td>
                                    <td valign="top">{{$item->tags}}</td>
                                    <td valign="top">{{$item->username}}</td>

                                    <td valign="top">
                                        <div class="dropdown">
                                        <button type="button" class="primary-btn small fix-gr-bg" >
                                                @if ($item->status == 1)
                                                @lang('lang.active')
                                                @else
                                                @lang('lang.pending')
                                                @endif
                                        </button>
                                        </div>
                                    </td>
                                    <td valign="top">
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                             <a class="dropdown-item" data-toggle="modal" data-target="#showBlogModal{{$item->id}}">@lang('lang.view')</a>
                                                <a class="dropdown-item" href="{{ route('blogEdit',$item->id)}}">@lang('lang.edit')</a>
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteblogModal{{$item->id}}"  href="">@lang('lang.delete')</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                  <div class="modal fade admin-query" id="deleteblogModal{{$item->id}}" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('lang.delete') @lang('lang.blog')</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                    <a href="{{ route('blogDelete',$item->id) }}" class="text-light">
                                                    <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                                                     </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                  <div class="modal fade admin-query" id="showBlogModal{{$item->id}}" >
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <div class="text-center">
                                                 <h4 class="modal-title">{{ $item->title }}</h4>
                                            </div>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                                                            
                                                <div class="text-center">  

                                                    @if (!empty($item->photo))
                                                    <figure class="figure">
                                                     <img src="{{ url($item->photo) }}" class="img-fluid" alt="{{ $item->title }}">   
                                                @if(Schema::hasTable('infix_general_settings'))
                                                         
                                                            <figcaption class="figure-caption"><p> {{  Modules\Systemsetting\Entities\InfixGeneralSetting::DateConvater($item->created_at)}} </p>   </figcaption>
                                                            
                                                            @else
                                                           
                                                                <figcaption class="figure-caption"><p> {{ $item->created_at }} -  {{ \Carbon\Carbon::parse($item->created_at)->diffForhumans() }}</p></figcaption>
                                                            @endif
                                                             
                                                     @endif  
                                                    </figure>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-lg-6">                                
                                                      <img src="{{ url('/') }}/Modules/Blog/002-grid.png" height="20px" width="20px" alt="category_icon"> {{ $item->category_name }}                   
                                                    </div>                                                
                                                    <div class="col-lg-6">
                                                       <img src="{{ url('/') }}/Modules/Blog/001-tag.png" height="20px" width="20px" alt="category_icon">
                                                   {{-- <span class="badge badge-pill badge-primary">{{ $item->tags }}</span> --}}
                                                    @php
                                                        $tags=explode(",",$item->tags);
                                                        foreach($tags as $tag){
                                                           @endphp
                                                          <span  class="badge badge-pill badge-primary blog_tag"> {{ $tag }}</span>
                                                            @php
                                                        }
                                                    @endphp
                                                    </div>
                                                </div>
                                                <hr>
                                                <br>
                                            <p class="mb-0 blog_description">  {!! $item->description !!}</p>
                                            <cite title="Source Title" class="blog_creator" >- {{ $item->username }}</cite>
                                       

                                        </footer>
                                        </blockquote>
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



