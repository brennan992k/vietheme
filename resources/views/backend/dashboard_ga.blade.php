
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

<script>
    $(function () {
      /* ChartJS
       * -------
       * Here we will create a few charts using ChartJS
       */
  
      //--------------
      //- AREA CHART -
      //--------------
  
      // Get context with jQuery - using jQuery's .get() method.
      var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
      // This will get the first returned node in the jQuery collection.
      var areaChart = new Chart(areaChartCanvas);
  
      var areaChartData = {
      labels: {!! json_encode($data['dates']->map(function($date) { return $date->format('d/m'); })) !!},
    
        datasets: [
          {
            label: "Page views",
            fillColor: "rgba(210, 214, 222, 1)",
            strokeColor: "rgba(210, 214, 222, 1)",
            pointColor: "rgba(210, 214, 222, 1)",
            pointStrokeColor: "#c1c7d1",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: {!! json_encode($data['pageViews']) !!}
          },
          {
            label: "Visitors",
            fillColor: "rgba(60,141,188,0.9)",
            strokeColor: "rgba(60,141,188,0.8)",
            pointColor: "#3b8bba",
            pointStrokeColor: "rgba(60,141,188,1)",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(60,141,188,1)",
            data: {!! json_encode($data['visitors']) !!}
          }
        ]
      };
  
      var areaChartOptions = {
        //Boolean - If we should show the scale at all
        showScale: true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines: false,
        //String - Colour of the grid lines
        scaleGridLineColor: "rgba(0,0,0,.05)",
        //Number - Width of the grid lines
        scaleGridLineWidth: 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,
        //Boolean - Whether the line is curved between points
        bezierCurve: true,
        //Number - Tension of the bezier curve between points
        bezierCurveTension: 0.3,
        //Boolean - Whether to show a dot for each point
        pointDot: false,
        //Number - Radius of each point dot in pixels
        pointDotRadius: 4,
        //Number - Pixel width of point dot stroke
        pointDotStrokeWidth: 1,
        //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
        pointHitDetectionRadius: 20,
        //Boolean - Whether to show a stroke for datasets
        datasetStroke: true,
        //Number - Pixel width of dataset stroke
        datasetStrokeWidth: 2,
        //Boolean - Whether to fill the dataset with a color
        datasetFill: true,
        //String - A legend template
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
        //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: true,
        //Boolean - whether to make the chart responsive to window resizing
        responsive: true
      };
  
      //Create the line chart
      areaChart.Line(areaChartData, areaChartOptions);
  
      //-------------
      //- LINE CHART -
      //--------------
      var lineChartData = {
      labels:  {!! json_encode($data['country']) !!} ,
    
        datasets: [
          {
            label: "Visitors",
            fillColor: "rgba(60,141,188,0.9)",
            strokeColor: "rgba(60,141,188,0.8)",
            pointColor: "#3b8bba",
            pointStrokeColor: "rgba(60,141,188,1)",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(60,141,188,1)",
            data: {!! json_encode($data['country_sessions']) !!}
          }
        ]
      };
  
      var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
      var lineChart = new Chart(lineChartCanvas);
      var lineChartOptions = areaChartOptions;
      lineChartOptions.datasetFill = false;
      lineChart.Line(lineChartData, lineChartOptions);
  
      //Create the line chart
      areaChart.Line(areaChartData, areaChartOptions);
  
      //-------------
      //- LINE CHART -
      //--------------
      var lineChartData = {
      labels:  {!! json_encode($data['visitor_type']) !!} ,
    
        datasets: [
          {
            label: "Visitor Type",
            fillColor: "rgba(60,141,188,0.9)",
            strokeColor: "rgba(60,141,188,0.8)",
            pointColor: "#3b8bba",
            pointStrokeColor: "rgba(60,141,188,1)",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(60,141,188,1)",
            data: {!! json_encode($data['visitor_session']) !!}
          }
        ]
      };
  
      var lineChartCanvas = $("#myChart").get(0).getContext("2d");
      var lineChart = new Chart(lineChartCanvas);
      var lineChartOptions = areaChartOptions;
      lineChartOptions.datasetFill = false;
      lineChart.Line(lineChartData, lineChartOptions);
  
      //-------------
      //- PIE CHART -
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
      var pieChart = new Chart(pieChartCanvas);
      var PieData = {!! $data['browserjson'] !!};
      var pieOptions = {
        //Boolean - Whether we should show a stroke on each segment
        segmentShowStroke: true,
        //String - The colour of each segment stroke
        segmentStrokeColor: "#fff",
        //Number - The width of each segment stroke
        segmentStrokeWidth: 2,
        //Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout: 50, // This is 0 for Pie charts
        //Number - Amount of animation steps
        animationSteps: 100,
        //String - Animation easing effect
        animationEasing: "easeOutBounce",
        //Boolean - Whether we animate the rotation of the Doughnut
        animateRotate: true,
        //Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale: false,
        //Boolean - whether to make the chart responsive to window resizing
        responsive: true,
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: true,
        //String - A legend template
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
      };
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      pieChart.Doughnut(PieData, pieOptions);
  
      //-------------
      //- BAR CHART -
      //-------------
      var barChartCanvas = $("#barChart").get(0).getContext("2d");
      var barChart = new Chart(barChartCanvas);
      var barChartData = areaChartData;
      barChartData.datasets[1].fillColor = "#00a65a";
      barChartData.datasets[1].strokeColor = "#00a65a";
      barChartData.datasets[1].pointColor = "#00a65a";

      var barChartOptions = {
        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero: true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines: true,
        //String - Colour of the grid lines
        scaleGridLineColor: "rgba(0,0,0,.05)",
        //Number - Width of the grid lines
        scaleGridLineWidth: 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,
        //Boolean - If there is a stroke on each bar
        barShowStroke: true,
        //Number - Pixel width of the bar stroke
        barStrokeWidth: 2,
        //Number - Spacing between each of the X value sets
        barValueSpacing: 5,
        //Number - Spacing between data sets within X values
        barDatasetSpacing: 1,
        //String - A legend template
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
        //Boolean - whether to make the chart responsive
        responsive: true,
        maintainAspectRatio: true
      };
  
      barChartOptions.datasetFill = false;
      barChart.Bar(barChartData, barChartOptions);


    var monthChartData = {
      labels: [ 'January',
                        'February',
                        'March',
                        'April',
                        'May',
                        'June',
                        'July ',
                        'August',
                        'September',
                        'October',
                        'November',
                        'December'],
    
        datasets: [
          {
            label: "Page views",
            fillColor: "rgba(210, 214, 222, 1)",
            strokeColor: "rgba(210, 214, 222, 1)",
            pointColor: "rgba(210, 214, 222, 1)",
            pointStrokeColor: "#c1c7d1",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: [{{$yearlyValue}}]
          }
        ]
      };

       var barChartCanvas = $("#bar-chart").get(0).getContext("2d");
      var barMonthChart = new Chart(barChartCanvas);
      var barChartMonthData = monthChartData;
      // barChartMonthData.datasets[1].fillColor = "#00a65a";
      // barChartMonthData.datasets[1].strokeColor = "#00a65a";
      // barChartMonthData.datasets[1].pointColor = "#00a65a";

      barMonthChart.Bar(barChartMonthData, barChartOptions);

    });
</script>

@endsection

