<!DOCTYPE html>
<html lang="">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="icon" href="{{asset('public/backEnd/')}}/img/favicon.png" type="image/png"/>
    <title>InfixHub Digital Market Place</title>
    <meta name="_token" content="{{csrf_token()}}"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/jquery-ui.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/jquery.data-tables.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap-datepicker.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/themify-icons.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/flaticon.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/nice-select.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/magnific-popup.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/fastselect.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/software.css"/>
    <link rel="stylesheet" href="{{asset('/public/css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/fullcalendar.min.css">
    <link rel="stylesheet" media="print" href="{{asset('/public/css/fullcalendar.print.css')}}">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/js/select2/select2.css"/> 
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/style.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/infix.css"/>
    <link rel="stylesheet" href="{{asset('public/css/')}}/checkEnvironmentPage.css" />
    <link rel="stylesheet" href="{{asset('public/css/common_style.css')}}">
 
</head>

<body class="admin">
  @php 
    $advance_r = "Advance Requirements";
    $status = "Status";
    $current_av = "Current Available";
    $required = "Required";
    $php_v = "PHP >= 7.1.3";
    $OpenSSL = "OpenSSL PHP Extension";
    $pdo = "PDO PHP Extension";
    $Mbstring = "Mbstring PHP Extension";
    $Tokenizer = "Tokenizer PHP Extension";
    $XML = "XML PHP Extension";
    $JSON = "JSON PHP Extension";
    
  @endphp

<div class="container">
    <div class="col-md-6 offset-3 mb-20  mt-40">
            <ul id="progressbar">
                <li class="active">Welcome</li>
                <li class="active">Verification</li> 
                <li class="active">Environment</li>
                <li>System Setup</li>
            </ul> 

 
 
        <div class="card">
            <div class="single-report-admit">
            <div class="card-header installation_home">
                <h2 class="text-center text-uppercase dm_title_color">Environment Setup</h2>
            </div>
            </div>
            <div class="card-body environment-setup dm_card_padding"> 

                @if(Session::has('message-success'))
                    <p class="text-success text-center mt-20 mb-20">{{ Session::get('message-success') }}</p>
                @endif
                @if(Session::has('message-danger'))
                    <p class="text-danger text-center mt-20 mb-20">{{ Session::get('message-danger') }}</p>
                @endif


                <h4 class="dm_text_center">Basic Requirements') </h4>
                <p class="mb-20">Please make sure your server meets the following requirements: </p>


                @foreach($folders as $f)
                <p>** {{Session::get('domain')}}{{$f}}</p>
                @endforeach
                <p class="text-danger">Please make sure above folders has permission 777. </p>


                <h4 class="dm_text_center" class="mt-20"> {{$advance_r}} </h4>
                <div class="requirements">
                   <table class="table">
                       <thead>
                       <th>{{$status }}</th>
                       <th>{{$current_av}}</th>
                       <th>{{$required}}</th>
                       </thead>
                       <tbody>
                       <tr>
                           <td> <span class=' @if(phpversion()>=7.1) text-success ti-check-box @else text-danger ti-na @endif' ></span></td>
                           <td> <p class="@if(phpversion()>=7.1) text-success @else text-danger @endif"> PHP >={{phpversion()}}</p> </td>
                            <td>{{$php_v}}</td>
                       </tr>

                       <tr>
                           <td> <span class='@if( OPENSSL_VERSION_NUMBER < 0x009080bf) ti-na text-danger @else ti-check-box  text-success @endif'></span>  </td>
                           <td> <p class="@if( OPENSSL_VERSION_NUMBER < 0x009080bf)  text-danger @else  text-success @endif"> {{$OpenSSL}}</p>  </td>
                           <td>{{$OpenSSL}}</td>
                       </tr>

                       <tr>
                           <td> <span class='@if(PDO::getAvailableDrivers()) ti-check-box  text-success @else  ti-na text-danger  @endif'></span>  </td>
                           <td> <p class="@if(PDO::getAvailableDrivers())  text-success @else  text-danger  @endif"> {{$pdo}}</p>  </td>
                           <td>{{$pdo}}</td>
                       </tr>
                       <tr>
                           <td> <span class="@if(extension_loaded('mbstring')) ti-check-box  text-success @else  ti-na text-danger  @endif"></span>  </td>
                           <td> <p class="@if(extension_loaded('mbstring'))  text-success @else  text-danger  @endif"> {{$Mbstring}}</p>  </td>
                           <td>{{$Mbstring}}</td>
                       </tr>
                       <tr>
                           <td> <span class="@if(extension_loaded('tokenizer')) ti-check-box  text-success @else  ti-na text-danger  @endif"></span>  </td>
                           <td> <p class="@if(extension_loaded('tokenizer'))  text-success @else  text-danger  @endif"> {{$Tokenizer}}</p>  </td>
                           <td>{{$Tokenizer}}</td>
                       </tr>
                       <tr>
                           <td> <span class="@if(extension_loaded('xml')) ti-check-box  text-success @else  ti-na text-danger  @endif"></span>  </td>
                           <td> <p class="@if(extension_loaded('xml'))  text-success @else  text-danger  @endif"> {{$XML}}</p>  </td>
                           <td>{{$XML}}</td>
                       </tr>
                       <tr>
                           <td> <span class="@if(extension_loaded('json')) ti-check-box  text-success @else  ti-na text-danger  @endif"></span>  </td>
                           <td> <p class="@if(extension_loaded('json'))  text-success @else  text-danger  @endif"> {{$JSON}}</p>  </td>
                       <td>{{$JSON}}</td>
                       </tr> 

                       </tbody>
                   </table>


                </div>

                <form action="{{url('checking-environment')}}" method="get">
                    {{csrf_field()}}
                    <input type="submit" class="offset-3 col-sm-6  primary-btn fix-gr-bg mt-20 mb-20 dm_button_style" value="Next Step" 
                    name="next">
                </form>
            </div>
        </div>
    </div>

</div>
</body>
</html>


