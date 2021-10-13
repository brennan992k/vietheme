
@extends('backend.master')


@section('mainContent')


@php  $setting =GeneralSetting();  
if(!empty(@$setting->currency_symbol)){ @$currency = @$setting->currency_symbol; }else{ @$currency = '$'; }   

@endphp 
<script src="{{asset('public/backEnd/js/jquery_1_9_1.js')}}"></script>
<link rel="stylesheet" href="{{ asset('public/backEnd/css/') }}/dashboard.css">
{{-- <script src="{{asset('public/backEnd/chart/')}}/Chart.min.css"></script> --}}
{{-- <script src="{{asset('public/backEnd/chart/')}}/Chart.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.1.1/Chart.min.js"></script>
<section class="mb-40 up_dashboard">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-title">
                    <h3>@lang('lang.welcome')</h3> 
                    {{-- {{Session::get('LoginData')->school_name}}--}}
 
                </div>
            </div>
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
    {{-- first row users --}}
    <div class="col-lg-3 col-md-6 mt-30-md">
      <a href="#" class="d-block">
        <div class="white-box single-summery">
          <div class="d-flex justify-content-between">
            <div>
              <h3>@lang('lang.active') @lang('lang.users')</h3>
              <p class="mb-0">@lang('lang.total') @lang('lang.active') @lang('lang.users')</p>
            </div>
            <h1 class="gradient-color2">{{isset($Activeuser)?$Activeuser:'0'}}</h1>
          </div>
        </div>
      </a>
    </div>

    <div class="col-lg-3 col-md-6 mt-30-md">
      <a href="#" class="d-block">
        <div class="white-box single-summery">
          <div class="d-flex justify-content-between">
            <div>
              <h3>@lang('lang.blocked') @lang('lang.users')</h3>
              <p class="mb-0">@lang('lang.total') @lang('lang.blocked') @lang('lang.users')</p>
            </div>
            <h1 class="gradient-color2">{{isset($blocked_users)?$blocked_users:'0'}}</h1>
          </div>
        </div>
      </a>
    </div> 
    <div class="col-lg-3 col-md-6 mt-30-md">
        <a href="#" class="d-block">
          <div class="white-box single-summery">
            <div class="d-flex justify-content-between">
              <div>
                <h3>@lang('lang.total') @lang('lang.authors')</h3>
                <p class="mb-0">@lang('lang.total') @lang('lang.authors')  </p>
              </div>
              <h1 class="gradient-color2">{{isset($ActiveVendor)?$ActiveVendor:'0'}}</h1>
            </div>
          </div>
        </a>
      </div>
      <div class="col-lg-3 col-md-6 mt-30-md">
        <a href="#" class="d-block">
          <div class="white-box single-summery">
            <div class="d-flex justify-content-between">
              <div>
                <h3>@lang('lang.total') @lang('lang.customers')</h3>
                <p class="mb-0">@lang('lang.total') @lang('lang.customers')  </p>
              </div>
              <h1 class="gradient-color2">{{isset($ActiveCustomer)?$ActiveCustomer:'0'}}</h1>
            </div>
          </div>
        </a>
      </div>
    

   </div>

 {{-- 2nd row products --}}
<div class="row">    
    <div class="col-lg-3 col-md-6 mt-30-md">
      <a href="#" class="d-block">
        <div class="white-box single-summery">
          <div class="d-flex justify-content-between">
            <div>
              <h3>@lang('lang.active') @lang('lang.products')</h3>
              <p class="mb-0">@lang('lang.total') @lang('lang.active') @lang('lang.products')</p>
            </div>
            <h1 class="gradient-color2">{{isset($ActiveItem)?$ActiveItem:'0'}}</h1>
          </div>
        </div>
      </a>
    </div>
    
    
    <div class="col-lg-3 col-md-6 mt-30-md">
      <a href="#" class="d-block">
        <div class="white-box single-summery">
          <div class="d-flex justify-content-between">
            <div>
              <h3>@lang('lang.approval') @lang('lang.pending')</h3>
              <p class="mb-0">@lang('lang.total') @lang('lang.approval') @lang('lang.pending')</p>
            </div>
            <h1 class="gradient-color2">{{isset($InactiveItem)?$InactiveItem:'0'}}</h1>
          </div>
        </div>
      </a>
    </div> 
    <div class="col-lg-3 col-md-6 mt-30-md">
      <a href="#" class="d-block">
        <div class="white-box single-summery">
          <div class="d-flex justify-content-between">
            <div>
              <h3>@lang('lang.update') @lang('lang.pending')</h3>
              <p class="mb-0">@lang('lang.total') @lang('lang.update') @lang('lang.pending')</p>
            </div>
            <h1 class="gradient-color2">{{isset($update_pending)?$update_pending:'0'}}</h1>
          </div>
        </div>
      </a>
    </div> 
    <div class="col-lg-3 col-md-6 mt-30-md">
        <a href="#" class="d-block">
          <div class="white-box single-summery">
            <div class="d-flex justify-content-between">
              <div>
                <h3>@lang('lang.total') @lang('lang.products')</h3>
                <p class="mb-0">@lang('lang.total') @lang('lang.products')  </p>
              </div>
              <h1 class="gradient-color2">{{isset($TotalItem)?$TotalItem:'0'}}</h1>
            </div>
          </div>
        </a>
      </div>
 
</div>

{{-- 4th products row withdraws --}}
<div class="row">    


    {{-- <div class="col-lg-3 col-md-6 mt-30-md">
      <a href="#" class="d-block">
        <div class="white-box single-summery">
          <div class="d-flex justify-content-between">
            <div>
              <h3>@lang('lang.total') @lang('lang.subscribers')</h3>
              <p class="mb-0">@lang('lang.total') @lang('lang.subscribers')  </p>
            </div>
            <h1 class="gradient-color2">{{isset($active_status)?$active_status:'0'}}</h1>
          </div>
        </div>
      </a>
    </div> --}}

    <div class="col-lg-3 col-md-6 mt-30-md">
      <a href="#" class="d-block">
        <div class="white-box single-summery">
          <div class="d-flex justify-content-between">
            <div>
              <h3>@lang('lang.total') @lang('lang.sale') @lang('lang.products')</h3>
              <p class="mb-0">@lang('lang.total') @lang('lang.sale')  </p>
            </div>
            <h1 class="gradient-color2">{{isset($ItemSale)?$ItemSale:'0'}}</h1>
          </div>
        </div>
      </a>
    </div> 
    <div class="col-lg-3 col-md-6 mt-30-md">
      <a href="#" class="d-block">
        <div class="white-box single-summery">
          <div class="d-flex justify-content-between">
            <div>
              <h3>@lang('lang.total') @lang('lang.sale') @lang('lang.amount')</h3>
              <p class="mb-0">@lang('lang.total') @lang('lang.sale')  </p>
            </div>
            <h1 class="gradient-color2">{{@GeneralSetting()->currency_symbol}} {{ isset($ItemEarning) ? round($ItemEarning) : 0}}</h1>
          </div>
        </div>
      </a>
    </div> 
</div>
@if (GeneralSetting()->google_an==1)
    

<div class="alert alert-warning mt-20" role="alert">
  @lang('lang.google_analytics_warning') -<a href="{{ route('edit_general_settings') }}">@lang('lang.general_settings')</a> 
</div>
  <div class="row mt-40">   


    @php
        $year=date('Y');
        $month_num = date('m');
        $month_name = date("F", mktime(0, 0, 0, $month_num, 10));
        $total_days=cal_days_in_month(CAL_GREGORIAN,$month_num,$year);
        // echo $total_days;
       
    @endphp

   
      <input type="hidden" id="month_name" value="{{@$month_name}}">

    <div class="col-lg-6 col-md-6 mt-30-md mb-30" class="" >
    <h3>@lang('lang.visitor_and_page_view')</h3>
      <div class="white-box DM_full_height">
         <canvas id="areaChart" width="500" height="280"  ></canvas>
      </div>
    </div>

    <div class="col-lg-6 col-md-6 mt-30-md mb-30">
    <h3>@lang('lang.Browsers')</h3>
      <div class="white-box DM_full_height">
         <canvas id="pieChart" ></canvas>
      </div>
    </div>

    <div class="col-lg-12 col-md-6 mt-30-md mb-30">
    <h3 class="box-title">@lang('lang.visitor_country')</h3>
      <div class="white-box DM_full_height">
          
          <canvas id="lineChart" ></canvas>
      </div>
    </div>
    
    <div class="col-lg-6 col-md-6 mt-30-md mb-30">
    <h3>@lang('lang.visitor_type')</h3>
      <div class="white-box DM_full_height">
          <canvas id="myChart" ></canvas>
      </div>
    </div>


    
    <div class="col-lg-6 col-md-12 mt-30-md mb-30">
    <h3>@lang('lang.monthly_sales_report') {{$year}}</h3>
      <div class="white-box DM_full_height">
        <canvas id="bar-chart"></canvas> 
      </div>
    
  </div>
  <div class="col-lg-12 col-md-12 mt-30-md mb-30">
    <h3>@lang('lang.daily_sales_report') {{$month_name.' '.$year}}</h3>
      <div class="white-box DM_full_height">
          <canvas id="barChart" ></canvas>
    </div>

  </div>
</div>

@endif


<input type="text" hidden value="{{ url('/') }}" id="url">



<div class="row mt-40">
    <div class="col-lg-6 col-md-6 mt-30-md">
        <h3>@lang('lang.top_best_saller')</h3>
        <div class="white-box col-lg-12 DM_full_height table-responsive">
            <table id="dashboard_table_id" class="p-0 school-table-style w-100 without-box-shadow">
                <thead>
                    <tr>
                        <th>
                            @lang('lang.sl')
                        </th>
                        <th nowrap>
                            @lang('lang.name')
                        </th>
                        <th>
                            @lang('lang.email')
                        </th>
                        <th nowrap>
                            @lang('lang.number_of_sale')
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($top_ten_seller as $key => $item)
                   <tr>
                   <td>{{$key+1}}</td>
                   <td><a href="{{ route('user.portfolio',@$item->username)}}" target="_blank"> {{ @$item->username }}</a></td>
                   <td>{{ @$item->email}}</td>
                   <td>{{ isset($item->sell) ? $item->sell : 0}}</td>
                   </tr>
                @endforeach
                </tbody>
            </table>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 mt-30-md">
          <h3>@lang('lang.new_saller')</h3>
          <div class="white-box col-lg-12 DM_full_height table-responsive">
              <table id="dashboard_table_id" class="p-0 school-table-style w-100 without-box-shadow">
                  <thead>
                      <tr>
                          <th>
                              @lang('lang.sl')
                          </th>
                          <th nowrap>
                              @lang('lang.name')
                          </th>
                          <th>
                              @lang('lang.email')
                          </th>
                          <th nowrap>
                              @lang('lang.date_of_joining') 
                          </th>
                          <th nowrap>
                              @lang('lang.number_of_sale')
                          </th>
                      </tr>
                  </thead>
                  <tbody>  
                      @foreach ($new_ten_seller as $key => $item)
                      <tr>
                      <td>{{$key+1}}</td>
                      <td><a href="{{ route('user.portfolio',@$item->username)}}" target="_blank"> {{ @$item->username }}</a></td>
                      <td>{{ @$item->email}}</td>
                      <td>{{ DateFormat(@$item->updated_at)}}</td>
                      <td>{{ isset($item->sell) ? $item->sell : 0}}</td>
                      </tr>
                   @endforeach
                  </tbody>
              </table>
          </div>
        </div>
</div> 
<div class="row">
  
</div>
<div class="row mt-40">   
  
  @endsection
  @section('script')
  <script src="{{ url('/') }}/public/backEnd/js/dashboard.js"></script>



@endsection

