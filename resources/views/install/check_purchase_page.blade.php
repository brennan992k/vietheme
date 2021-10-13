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
    <link rel="stylesheet" href="{{asset('public/frontend/')}}/check_purchase_page.css" />
 
</head>



<body class="admin">
<div class="container">
    <div class="col-md-6 offset-3  mt-40">

            <ul id="progressbar">
                <li class="active">Welcome</li>
                <li class="active">Verification</li> 
                <li>Environment</li>
                <li>System Setup</li>
            </ul> 

 


        <div class="card">
            <div class="single-report-admit">
                <div class="card-header installation_home">
                    <h2 class="text-center text-uppercase dm_title_color title">VERIFICATION</h2>
                </div>
            </div>
            <div class="card-body">
                @if(Session::has('message-danger'))
                    <p class="text-danger">** {{ Session::get('message-danger') }}</p>
                @endif
                 @if ($errors->any()) 
                    Ops sorry ! Please enter valid input!
                       @foreach ($errors->all() as $error)
                          <p class="text-danger">** {{$error}}</p>
                       @endforeach 
                 @endif


               <form method="post" action="{{url('check-verified-input')}}">
                   {{csrf_field()}}
                   <div class="form-group">
                       <label for="user">Envato Username :</label>
                       <input type="text" class="form-control " name="envatouser" value="{{ old('envatouser') }}"  required="required"  placeholder="Enter Your Envato User Name"> 
                   </div>
                   <div class="form-group">
                       <label for="purchasecode">Envato Purchase Code:</label>
                       <input type="text" class="form-control" name="purchasecode" value="{{ old('purchasecode') }}" required="required" placeholder="Enter Your Envato Purchase Code">
                   </div>
                   <div class="form-group">
                       <label for="domain">Installation Domain:</label>
                       <input type="text" class="form-control" name="installationdomain" value="{{ old('installationdomain') }}" required="required"  placeholder="Enter Your Installation Domain">
                   </div>
                   <input type="submit" value="Next" class="offset-3 col-sm-6 primary-btn fix-gr-bg mt-40 dm_button_style">
               </form>
            </div>
        </div>
    </div>

</div>
</body>
</html>
