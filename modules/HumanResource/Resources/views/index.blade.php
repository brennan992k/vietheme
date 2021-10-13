@extends('backend.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.user') @lang('lang.list')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.user') @lang('lang.management')</a>
                <a href="{{route('admin.user_list')}}">@lang('lang.user') @lang('lang.list')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area  DM_table_info ">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-8 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30">@lang('lang.select_criteria') </h3>
                </div>
            </div>
           @if(Auth::user()->role_id == 1 )
                <div class="col-lg-4 text-md-right text-left col-md-6 mb-30-lg">
                    <a href="{{route('admin.add_user')}}" class="primary-btn small fix-gr-bg">
                        <span class="ti-plus pr-2"></span>
                        @lang('lang.add') @lang('lang.user')
                    </a>
                </div>
            @endif
        </div>
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
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'admin.user_search', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        <div class="row">
                            <div class="col-lg-4">
                              <select class="niceSelect w-100 bb form-control" name="role_id" id="role_id">
                                    <option data-display="Role" value=""> @lang('lang.select') </option>
                                    @foreach($roles as $key=>$value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-4 mt-30-md">
                               <div class="col-lg-12">
                                <div class="input-effect">
                                    <input class="primary-input" type="text" placeholder=" @lang('lang.search_by_email')" name="email">
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                           </div>
                            <div class="col-lg-4 mt-30-md">
                               <div class="col-lg-12">
                                <div class="input-effect">
                                    <input class="primary-input" type="text" placeholder="@lang('lang.search_by_name')" name="username">
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                           </div>
                        <div class="col-lg-12 mt-20 text-right">
                            <button type="submit" class="primary-btn small fix-gr-bg">
                                <span class="ti-search pr-2"></span>
                                @lang('lang.search')
                            </button>
                        </div>
                    </div>
            {{ Form::close() }}
            </div>
        </div>
    </div>
 <div class="row mt-40">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4 no-gutters">
                    <div class="main-title lm_mb_35 sm_mb_20">
                        <h3 class="mb-0">@lang('lang.user') @lang('lang.list')</h3>
                    </div>
                </div>
            </div>

         <div class="row">
                <div class="col-lg-12">
                    <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>@lang('lang.username')</th>
                                <th>@lang('lang.role')</th>
                                <th>@lang('lang.country')</th>
                                <th>@lang('lang.image')</th>
                                <th>@lang('lang.mobile')</th>
                                <th>@lang('lang.email')</th>
                                <th>@lang('lang.action')</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($users as $value)
                            <tr>
                                <td>{{$value->username}}</td>
                                <td>{{!empty($value->role->name)?$value->role->name:''}}</td>
                                <td>{{@$value->profile->country->name}}</td>
                                <td><img src="{{ @$value->profile->image? asset(@$value->profile->image):asset('public/frontend/img/profile/1.png') }}" width="60" height="auto" alt=""></td>
                                <td>{{@$value->profile->mobile}}</td>
                                <td>{{@$value->email}}</td>

                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            @lang('lang.select')
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{route('admin.customer_view', $value->id)}}">@lang('lang.view')</a>
                                           @if(Auth::user()->role_id == 1 )

                                            <a class="dropdown-item" href="{{route('admin.user_edit', $value->id)}}">@lang('lang.edit')</a>
                                           @endif
                                           @if(Auth::user()->role_id == 1 )

                                                @if ($value->role_id != Auth::user()->role_id )
                                            
                                                <a class="dropdown-item modalLink" data-toggle="modal" data-modal-size="modal-md" data-target="#deleteHumanDepartModal{{ $value->id}}" href="#">@lang('lang.delete')</a>
                                                @endif
                                            @endif
                                       
                                        </div>
                                    </div>
                                </td>
                            </tr>




                            <div class="modal fade admin-query" id="deleteHumanDepartModal{{ $value->id}}" >
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">@lang('lang.delete') @lang('lang.user')</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        {{--  {{route('admin.vendorDeleted', $value->id)}}  --}}
                                        <div class="modal-body">
                                            <div class="text-center">
                                                <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                            </div>

                                            <div class="mt-40 d-flex justify-content-between">
                                                <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                 {{ Form::open(['url' => 'admin/vendor-deleted/'.$value->id, 'method' => 'DELETE', 'enctype' => 'multipart/form-data']) }}
                                                <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                                                 {{ Form::close() }}
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
