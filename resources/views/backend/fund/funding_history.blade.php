
@extends('backend.master')
<link rel="stylesheet" href="{{asset('public/backend/')}}/approved_deposit.css">
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.offline_payment') </h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.funding_history') </a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
       {{--  <div class="row justify-content-between p-3">
            <div class="bc-pages">
             
            </div>
    </div> --}}

            <div class="row mt-40 mb-25">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 no-gutters">
                            <div class="main-title">
                            <h3 class="mb-0">{{@$user_info->full_name}}</h3>
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
                                <th width="10%">@lang('lang.f_id')</th>
                                <th width="15%">@lang('lang.details')</th>
                                <th width="15%">@lang('lang.amount')</th>
                                <th width="15%">@lang('lang.date')</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($funds as $value)
                                <tr>
                                    <td>{{@$value->id}}</td>
                                    <td>{{@$value->details}}</td>
                                    <td>{{@$value->amount}}</td>
                                    <td>{{DateFormat(@$value->created_at)}}</td>
                                </tr>  
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

    </div>
</section>


@endsection
