<?php
// $setting = Modules\Systemsetting\Entities\InfixGeneralSetting::find(1);
@$setting = GeneralSetting();
@$favicon = BackgroundSetting()[1];

if(Auth::user() == ""){ header('location:'.url('/login')); exit(); }
$dashboard_background = BackgroundSetting()[2];
if(empty(@$dashboard_background)){
    @$css = "background: url('/public/backEnd/img/body-bg.jpg')  no-repeat center; background-size: cover; ";
}else{
    if(!empty(@$dashboard_background->image)){
        @$css = "background: url('". url(@$dashboard_background->image) ."')  no-repeat center; background-size: cover; ";
    }else{
        $css = "background:".@$dashboard_background->color;
    }
}



$login_background = App\SmBackgroundSetting::where([['is_default',1],['title','Login Background']]);

// if(isset($favicons->favicon)){ @$fav = @$favicons->favicon; }else{ @$fav = 'public/backEnd/img/favicon.png'; }

if(isset($setting->system_title)){ @$system_title = @$setting->system_title; }else{ @$system_title = 'Infix Digital Marketplace'; }
if(isset($setting->system_name)){ @$system_name = @$setting->system_name; }else{ @$system_name = 'Infix Market'; }
$ROLE_ID=Auth::user()->role_id;

        if(Schema::hasTable('infix_styles')){
        @$styles = Modules\Systemsetting\Entities\InfixStyle::where('active_status', 1)->get();

        if (Auth::user()->style_id!=null) {
            @$active_style = Modules\Systemsetting\Entities\InfixStyle::where('id', Auth::user()->style_id)->first();
        } else {
            @$active_style = Modules\Systemsetting\Entities\InfixStyle::where('is_active', 1)->first();
        }

        }

?>
  @php
            if(Schema::hasTable('infix_general_settings')){
                    @$inifx_general_settings=GeneralSetting();
                    @$ttl_rtl = $inifx_general_settings->ttl_rtl;

            }
            
    @endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{checkRTL(app()->getLocale())}}" class="{{checkRTL(app()->getLocale())}}">
   
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="icon" href="{{url('/')}}/{{$favicon->image}}" type="image/png"/>
    {{-- <link rel="icon" href="{{url('/')}}/{{isset($fav)?$fav:''}}" type="image/png"/> --}}
    <title>{{@$system_name}} | {{@$system_title}}</title>
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <!-- Bootstrap CSS -->
    @if(checkRTL(app()->getLocale()) =='rtl')
        <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/rtl/bootstrap.min.css"/>
    @else
        <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap.css"/>
    @endif

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
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/color_picker/rgbaColorPicker.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/js/select2/select2.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/fullcalendar.min.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/summernote.css') }}">
    <script src="https://cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script>
    @stack('css')
    <!-- main css -->
    <link rel="stylesheet" href="{{asset('public/css/toastr.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/common_style.css')}}">

    @if(checkRTL(app()->getLocale()) =='rtl')
        <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/rtl/style.css"/>
        <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/rtl/infix.css"/>
    @else

            @if (isset($active_style))
                <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/{{@$active_style->path_main_style}}"/>
                <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/{{@$active_style->path_infix_style}}"/>
            @else
                <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/style.css"/>
                <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/infix.css"/>
            @endif


    @endif


  
     <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-162089702-1"></script>

</head>
<body class="admin" style="{{@$css}}">
    <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
    <input type="text" hidden  class="currencyIn" value="{{ @GeneralSetting()->currency_symbol }}">
    <div class="main-wrapper dm_min_height_600" >
        <!-- Sidebar  -->
    @include('backend.partials.sidebar')
    
    <!-- Page Content  -->
        <div id="main-content">
    @include('backend.partials.menu')
