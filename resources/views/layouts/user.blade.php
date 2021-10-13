<!doctype html>
<html class="no-js" lang="zxx">
@php
    $fav_conditions = ['title'=>'Favicon', 'active_status'=>1];
    $fav = dashboard_background($fav_conditions);
@endphp
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title') - Infix</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="{{url('/')}}/{{isset($fav)?$fav->image:''}}">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/nice-select.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/animate.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/slicknav.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/style.css">
    <link rel="stylesheet" href="{{asset('public/css/toastr.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/common_style.css')}}">

    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
    @stack('css')
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->
<!-- login_resister_area-start -->
    @yield('content')
<!-- login_resister_area-end -->


    <!-- JS here -->
    
    <script src="{{ asset('public/frontend/js/') }}/vendor/modernizr-3.5.0.min.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/vendor/jquery-1.12.4.min.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/popper.min.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/bootstrap.min.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/owl.carousel.min.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/isotope.pkgd.min.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/ajax-form.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/waypoints.min.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/jquery.counterup.min.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/scrollIt.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/jquery.scrollUp.min.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/wow.min.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/nice-select.min.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/jquery.slicknav.min.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/plugins.js"></script>

    <!--contact js-->
    <script src="{{ asset('public/frontend/js/') }}/contact.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/jquery.ajaxchimp.min.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/jquery.form.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/jquery.validate.min.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/mail-script.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/main.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/login.js"></script>    
    <script src="{{ asset('js/')}}/validate.js"></script>
    <script src="{{ asset('js/')}}/additional.js"></script>
    <script src="{{asset('public/js/toastr.js')}}"></script>
    {!! Toastr::message() !!}
    @stack('js')
     

</body>

</html>