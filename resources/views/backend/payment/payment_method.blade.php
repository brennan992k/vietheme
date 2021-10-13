
@extends('backend.master')
<link rel="stylesheet" href="{{asset('public/backEnd/')}}/approved_deposit.css">
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.payment')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.payment')</a>
                <a href="#">@lang('lang.author_balance') @lang('lang.list')</a>
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

            <div class="row mt-40 mb-25">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 no-gutters">
                            <div class="main-title ">
                                <h3 class="mb-0">@lang('lang.author_balance') @lang('lang.list')</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                        
            <!-- </div> -->
            <div class="row">
                <div class="col-lg-12">
                    <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="10%">@lang('lang.user') @lang('lang.name')</th>
                                <th width="15%">@lang('lang.email')</th>
                                <th width="15%">@lang('lang.earnings') </th>
                                <th width="15%">@lang('lang.status')</th>
                                <th width="15%">@lang('lang.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $value)
                                   <tr id="{{ @$value->id}}">
                                    <td>{{@$value->user->username}}</td>
                                    <td>{{@$value->user->email}}</td>
                                    <td>{{@GeneralSetting()->currency_symbol}}{{@$value->user->balance->amount}}</td>
                                    <td>{{@$value->status == 1? 'Active' : 'Pending'}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{ route('admin.paymentMethodView',@$value->id)}}"> @lang('lang.view')</a>              
                                            </div>
                                        </div>
                                    </td>
                                        
                                </tr> 

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
                  
    </div>
</section>


@endsection
