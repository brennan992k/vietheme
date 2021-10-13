@extends('backend.master')
@section('mainContent')

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.user') @lang('lang.log')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="{{ route('admin.userLog')}}" class="active">@lang('lang.user') @lang('lang.log')</a>
                
            </div>
        </div>
    </div>
</section>


<section class="admin-visitor-area DM_table_info">
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title sm_mb_20 lm_mb_20">
                            <h3 class="mb-0">@lang('lang.user') @lang('lang.log')</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                           
                                <tr>
                                    <th>@lang('lang.name')</th>
                                    <th>@lang('lang.role')</th>
                                    <th>@lang('lang.last') @lang('lang.login')</th>
                                    <th>@lang('lang.last') @lang('lang.login') @lang('lang.ip')</th>
                                    <th>@lang('lang.device')</th>
                                    <th>@lang('lang.Browsers')</th>
                                    <th>@lang('lang.country')</th>
                                    <th>@lang('lang.city')</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['userlog'] as $item)
                                <tr>
                                    <td valign="top">{{@$item->user->username}}</td>
                                    <td valign="top">{{@$item->user->role->name}}</td>
                                    <td valign="top">{{ DateFormat(@$item->last_login_at)}}</td>
                                    <td valign="top">{{@$item->last_login_ip}}</td>
                                    <td valign="top">{{@$item->device}}</td>
                                    <td valign="top">{{@$item->browser}}</td>
                                    <td valign="top">{{@$item->country_name}}</td>
                                    <td valign="top">{{@$item->city}}</td>
                                    <td valign="top">
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteClassModal{{@$item->id}}" >@lang('lang.delete')</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                  <div class="modal fade admin-query" id="deleteClassModal{{@$item->id}}" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('lang.delete') @lang('lang.user') @lang('lang.log')</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                      <a href="{{ route('admin.userLogDelete',$item->id)}}" class="text-light">
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
@endsection


