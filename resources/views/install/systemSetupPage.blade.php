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
    <link rel="stylesheet" href="{{ asset('/public/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/fullcalendar.min.css">
    <link rel="stylesheet" media="print" href="{{ asset('/public/css/fullcalendar.print.css') }}">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/js/select2/select2.css"/> 
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/style.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/infix.css"/> 
    
    <link rel="stylesheet" href="{{asset('public/frontend/')}}/check_purchase_page.css" />
</head>



<body class="admin">
<div class="container">
    <div class="col-md-6 offset-3 mt-40" > 
             
            <ul id="progressbar">
                <li class="active">Welcome</li>
                <li class="active">Verification</li> 
                <li  class="active">Environment</li>
                <li  class="active">System Setup</li>
            </ul>  
         
        <div class="card">
            <div class="single-report-admit">
                <div class="card-header  card-header-1006 installation_home">
                    <h2 class="dm_title title">System Setup</h2>
                </div>
            </div>
            <div class="card-body card-body-1007"> 
                <form method="post" action="{{url('confirm-installing')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="institution_name">{{__('System Name')}}</label>
                        <input type="text" class="form-control  {{ @$errors->has('institution_name') ? ' is-invalid' : '' }}" name="institution_name"  value="{{old('institution_name')}}">                        
                        @if ($errors->has('institution_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ @$errors->first('institution_name') }}</strong>
                            </span>
                        @endif
                    </div> 

                    <div class="form-group">
                        <label for="system_admin_email">{{__('Admin Email')}}</label>
                        <input type="text" class="form-control  {{ @$errors->has('system_admin_email') ? ' is-invalid' : '' }}" name="system_admin_email"  autocomplete="off" value="{{old('system_admin_email')}}">
                        @if ($errors->has('system_admin_email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ @$errors->first('system_admin_email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="system_admin_password">System Admin Password:</label>
                        <input type="password" class="form-control {{ @$errors->has('system_admin_password') ? ' is-invalid' : '' }}" name="system_admin_password"  autocomplete="off" value="{{old('system_admin_password')}}" >
                        @if ($errors->has('system_admin_password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ @$errors->first('system_admin_password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password:</label>
                        <input type="password" class="form-control {{ @$errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation"   autocomplete="false" value="{{old('password_confirmation')}}" >
                        @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ @$errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
 

                    <input type="submit" value="Let's Go" class="offset-3 col-sm-6  primary-btn fix-gr-bg mt-40 dm_button_style">
                </form>
            </div>
        </div>
    </div>

</div>
</body>
</html>

