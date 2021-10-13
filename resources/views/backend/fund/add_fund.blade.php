
@extends('backend.master')
<link rel="stylesheet" href="{{asset('public/backEnd/css')}}/add_fund.css">
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.add') @lang('lang.fund')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.add') @lang('lang.fund')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area DM_table_info">
    <div class="container-fluid p-0">
       {{--  <div class="row justify-content-between p-3">
            <div class="bc-pages">
             
            </div>
    </div> --}}

    <div class="col-md-12">

        <div class="row student-details mt_0_sm">

            <!-- Start Sms Details -->
            <div class="col-lg-12 p-0">
                <ul class="nav nav-tabs mt_0_sm mb-20 ml-0 mb-40 sm_mb_20" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#group_email_sms" selectTab="G" role="tab" data-toggle="tab">@lang('lang.author')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" selectTab="I" href="#indivitual_email_sms" role="tab" data-toggle="tab">@lang('lang.customer')</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" selectTab="C" href="#class_section_email_sms" role="tab" data-toggle="tab">@lang('lang.class')</a>
                    </li> --}}

                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <input type="hidden" name="selectTab" id="selectTab">
                    <div role="tabpanel" class="tab-pane fade show active" id="group_email_sms">
                        <table id="table_id" class="display school-table  mt-20" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th width="10%">@lang('lang.user') @lang('lang.name')</th>
                                    <th width="15%">@lang('lang.email')</th>
                                    <th width="10%">@lang('lang.balance')</th>
                                    {{-- <th width="10%">@lang('lang.status')</th> --}}
                                    {{-- <th width="15%">@lang('lang.login') @lang('lang.permission')</th> --}}
                                    <th width="15%">@lang('lang.image')</th>
                                    <th width="5%">@lang('lang.date')</th>
                                    <th width="15%">@lang('lang.action')</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($author as $value)
                                    <tr id="{{ @$value->id}}">
                                    {{-- <td hidden>{{ @$value->id}}</td> --}}
                                    <td>{{@$value->username}}</td>
                                    <td>{{@$value->email}}</td>
                                    <td>{{@$value->amount}}</td>
                                    {{-- <td>
                                        <label class="switch">
                                            <input type="checkbox" class="switch_status" {{@$value->status == 1? 'checked':''}} value="{{ @$value->status}}">
                                                <span class="slider round"></span>
                                        </label>
                                    </td> --}}
                                    {{-- <td>
                                            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                            <label class="switch">
                                                <input type="checkbox" class="switch-input" {{@$value->access_status == 1? 'checked':''}} value="{{ @$value->access_status}}">
                                                <span class="slider round"></span>
                                            </label>
                                    </td> --}}
                                    <td valign="top"><img src="{{ @$value->profile->image ? asset(@$value->profile->image) :asset('public/frontend/img/profile/1.png') }}" class="add_fund_profile_img"></td>
                                    <td>{{DateFormat(@$value->balances_updated_at)}}</td>
                                    <td>
                                            <div class="row">
                                            <div class="col-sm-6">
            
                                            <div class="dropdown">
                                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                    @lang('lang.select')
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#AddFund{{@$value->id}}"  href="#">@lang('lang.add')</a>
                                                        <a class="dropdown-item" href="{{ route('admin.fundHistory',@$value->id)}}">@lang('lang.funding_history')</a>
                                                    
            
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                </tr>  

                                <div class="modal fade admin-query" id="AddFund{{@$value->id}}" >
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">@lang('lang.add') @lang('lang.fund')</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <div class="modal-body">
                                                <form action="{{url('admin/add-fund')}}" method="post">
                                                @csrf
                                                    <div class="row no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="input-effect">
                                                                <input class="primary-input form-control" id="fund_amount" min="1" type="number" name="fund_amount" value="">
                                                                <label>@lang('lang.amount')<span>*</span></label>
                                                                <span class="focus-border"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <input type="hidden" name="user_id" value="{{ @$value->id}}">
                                                    {{-- <div class="row mt-25">
                                                        <div class="col-lg-12">
                                                            <div class="input-effect">
                                                                <textarea class="primary-input form-control" cols="0" rows="4" name="note"></textarea>
                                                                <span class="focus-border textarea"></span>
                                                                <label>Note <span></span></label>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                        
                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                            <a href="{{ route('admin.customerDeleted',@$value->id)}}" class="text-light">
                                                        <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.add')</button>
                                                            </a>
                                                    </div>

                                                </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="indivitual_email_sms">
                        <div class="row mb-35">

                            <div class="col-lg-12">
                                <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="10%">@lang('lang.user') @lang('lang.name')</th>
                                            <th width="15%">@lang('lang.email')</th>
                                        <th width="10%">@lang('lang.balance')</th>
                                        {{-- <th width="10%">@lang('lang.status')</th> --}}
                                        {{-- <th width="15%">@lang('lang.login') @lang('lang.permission')</th> --}}
                                        <th width="15%">@lang('lang.image')</th>
                                        <th width="5%">@lang('lang.date')</th>
                                            <th width="15%">@lang('lang.action')</th>
                                        </tr>
                                    </thead>
            
                                    <tbody>
                                        @foreach($customer as $value)
                                            <tr id="{{ @$value->id}}">
                                            {{-- <td hidden>{{ @$value->id}}</td> --}}
                                            <td>{{@$value->username}}</td>
                                            <td>{{@$value->email}}</td>
                                                <td>{{@$value->amount}}</td>
                                            {{-- <td>
                                                <label class="switch">
                                                    <input type="checkbox" class="switch_status" {{@$value->status == 1? 'checked':''}} value="{{ @$value->status}}">
                                                        <span class="slider round"></span>
                                                </label>
                                            </td> --}}
                                            {{-- <td>
                                                    <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                                    <label class="switch">
                                                        <input type="checkbox" class="switch-input" {{@$value->access_status == 1? 'checked':''}} value="{{ @$value->access_status}}">
                                                        <span class="slider round"></span>
                                                    </label>
                                            </td> --}}
                                            <td valign="top"><img src="{{ @$value->profile->image ? asset(@$value->profile->image) :asset('public/frontend/img/profile/1.png') }}" class="add_fund_profile_img"></td>
                                            <td>{{DateFormat(@$value->balances_updated_at)}}</td>
                                            <td>
                                                <div class="row">
                                                <div class="col-sm-6">
                
                                                <div class="dropdown">
                                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                        @lang('lang.select')
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        
                                                        <a class="dropdown-item" data-toggle="modal" data-target="#AddFund{{@$value->id}}"  href="#">@lang('lang.add')</a>
                                                            <a class="dropdown-item" href="{{ route('admin.fundHistory',@$value->id)}}">@lang('lang.funding_history')</a>
                                                        
                
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                    </tr>  
        
                                    <div class="modal fade admin-query" id="AddFund{{@$value->id}}" >
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">@lang('lang.add') @lang('lang.fund')</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
        
                                                    <div class="modal-body">
                                                    <form action="{{url('admin/add-fund')}}" method="post">
                                                    @csrf
                                                        <div class="row no-gutters input-right-icon">
                                                            <div class="col">
                                                                <div class="input-effect">
                                                                    <input class="primary-input form-control" id="fund_amount" min="0" type="number" name="fund_amount" value="">
                                                                    <label>@lang('lang.amount')<span>*</span></label>
                                                                    <span class="focus-border"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="hidden" name="user_id" value="{{ @$value->id}}">
                                                        {{-- <div class="row mt-25">
                                                            <div class="col-lg-12">
                                                                <div class="input-effect">
                                                                    <textarea class="primary-input form-control" cols="0" rows="4" name="note"></textarea>
                                                                    <span class="focus-border textarea"></span>
                                                                    <label>Note <span></span></label>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                            
                                                        <div class="mt-40 d-flex justify-content-between">
                                                            <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                                
                                                            <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.add')</button>
                                                            
                                                        </div>

                                                    </form>
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
                    <!-- End Individual Tab -->

                   
                </div>
            </div>
        </div>
    </div>




    </div>
</section>


@endsection
