@extends('backend.master')
@section('mainContent')

@php 
   
    $setting = Modules\Systemsetting\Entities\InfixGeneralSetting::find(1); 
    if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; } 
@endphp
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Modules</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="{{route('admin.vendor')}}">@lang('lang.modules_list')</a>
            </div>
        </div>
    </div>
</section>
<section class="mb-40 student-details">
    <div class="container-fluid p-0">
        <div class="row"> 

            <!-- Start Student Details -->
               <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0">@lang('lang.modules') @lang('lang.list')</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                                
                                <tr>
                                    <th>@lang('lang.sl')</th>
                                    <th>@lang('lang.module') @lang('lang.name') </th>
                                    <th>@lang('lang.status')</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sl=1; @endphp
                                @foreach($modules_name as $row)
                                <tr>
                                    <td>{{$sl++}}</td>
                                    <td>{{@$row}}</td> 
                                    <td>
                                        <button class="primary-btn small fix-gr-bg" onclick="modules"> @lang('lang.enable')</button>
                                        <button class="primary-btn small tr-bg" onclick="modules">@lang('lang.disable') </button>
                                    </td> 
                                    
                                    <td valign="top">
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right"> 
                                                <a class="dropdown-item" href="{{url('modules/'.@$row)}}">@lang('lang.edit')</a> 
                                                <a class="dropdown-item" data-toggle="modal" data-target="#M{{@$row}}"  href="{{url('modules/'.@$row)}}">@lang('lang.delete')</a> 
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                
                                  <div class="modal fade admin-query" id="M{{$row}}" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('lang.delete') @lang('lang.class')</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                    <a href="{{url('modules/'.$row)}}" class="text-light">
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
