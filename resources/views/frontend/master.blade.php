
<!DOCTYPE html>
@if (Auth::check())
    @php
        if(userActiveLanguage()==null){
            App::setLocale(activeLanguage());
            $local= App::getLocale();
        }else{
            $local= userActiveLanguage();
        }
        
    @endphp
    <html dir="{{ $local=='ar'? 'rtl' :'ltl' }}" class="{{ $local=='ar'? 'rtl' :'ltl' }}" lang="{{ $local }}">
        @php
         App::setLocale(userActiveLanguage());
         $local=userActiveLanguage();
        
        @endphp
@else
@php
    if( session()->get('guest_locale')!=null){
        App::setLocale(session()->get('guest_locale'));
        $local= App::getLocale();
    }else{
        $local= activeLanguage();
    }
    
@endphp

    <html dir="{{ checkRTL($local) }}" class="{{ checkRTL($local) }}" lang="{{$local!=null? $local: activeLanguage() }}">
        @php App::setLocale(App::getLocale()!=null? App::getLocale(): activeLanguage()); @endphp
@endif
{{-- {{dd($local)}} --}}
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>{{ @app('infix_general_settings')? app('infix_general_settings')->system_name :'Infix Market' }} | {{ @app('infix_general_settings')? app('infix_general_settings')->system_title :'Infix Digital Marketplace' }}</title>
    @if (Request::url() === url('/'))
        <meta name="description" content="{{ @app('infix_seo_settings')? app('infix_seo_settings')->description :'Infix Digital Market Place' }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="{{ @app('infix_seo_settings')? app('infix_seo_settings')->keyword :'HTML,CSS,XML,JavaScript' }}">
        <meta name="author" content="{{ @app('infix_seo_settings')? app('infix_seo_settings')->site_author :'Spondonit' }}">
    @endif
        <meta name="_token" content="{!! csrf_token() !!}"/>
    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="icon" href="{{url('/')}}/{{app('infix_background_settings')[1]->image}}" type="image/png"/>
    <!-- Place favicon.ico in the root directory -->
@if (Auth::check())
    @php
        $language_from=userActiveLanguage();
    @endphp
@else
    @php
        // $language_from=activeLanguage();
        $language_from=$local;
    @endphp
@endif
    <!-- CSS here -->
    {{-- {{dd($language_from)}} --}}
    @if(checkRTL($language_from) =='rtl')
        <link rel="stylesheet" href="{{ asset('public/frontend/rtl/') }}/bootstrap.rtl.min.css">
    @else
        <link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/bootstrap.min.css">
    @endif
    
    <link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/nice-select.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/gijgo.min.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/animate.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/slicknav.css">
     <link rel="stylesheet" href="{{asset('public/css/common_style.css')}}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/style.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/summernote.css') }}">
    <link rel="stylesheet" href="{{asset('public/css/toastr.css')}}">
    <!-- <link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/responsive.css"> -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/update.css">
    @stack('css')   
    <link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/responsive.css">
    @php 
    $banner_coller = App\FrontSetting::where('active_status', 1)->first();

    @endphp 
<link rel="stylesheet" href="{{ asset('public/frontend/') }}/master.css">
@php
    $home_page=Modules\Pages\Entities\InfixHomePage::first();
    if (file_exists($home_page->banner_image)) {
        $banner=$home_page->banner_image;
    } else {
        $banner=url('public/frontend/img/banner/banner-img-1.png');
    }
    
@endphp
     <style>
         .banner-area::after {
            background-image: url({{$banner}});
         }

     .banner-area::before, .banner-area2::before, .banner-area3::before, .banner-area4::before{
        background-image: -webkit-linear-gradient(90deg, {{@$banner_coller->color1}} 0%, {{@$banner_coller->color2}} 100%) !important;
     }
     .banner-area .search-field::before, .banner-area2 .search-field::before, .banner-area3 .search-field::before, .banner-area4 .search-field::before{
         background: {{@$banner_coller->color3}} !important;
     } 
     </style>
     <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-162089702-1"></script>
 
</head>


<body>
<input type="text" hidden  class="url" value="{{url('/') }}">
<input type="text" hidden  class="system_url" value="{{url('/') }}">
<input type="text" hidden  class="currencyIn" value="{{ @GeneralSetting()->currency_symbol }}">

   
   @include('frontend.partials.header')
    <!-- header-area-end -->

    <!-- banner-area start -->
    {{-- @include('frontend.partials.banner') --}}
    <!-- banner-area end -->

    <!-- features-area-start -->
    @yield('content')
    <!-- latest-goods-end -->

   @include('frontend.partials.footer')


    <!-- JS here -->
    <script src="{{ asset('public/frontend/js/') }}/vendor/modernizr-3.5.0.min.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/vendor/jquery-1.12.4.min.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/popper.min.js"></script>
    @if(checkRTL($language_from) =='rtl')
        <script src="{{ asset('public/frontend/css/') }}/bootstrap.rtl.min.js"></script>
    @else
        <script src="{{ asset('public/frontend/js/') }}/bootstrap.min.js"></script>
    @endif
    
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
    <script src="{{ asset('public/frontend/js/') }}/chart.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/gijgo.min.js"></script>

    <!--contact js-->
    <script src="{{ asset('public/frontend/js/') }}/contact.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/jquery.ajaxchimp.min.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/jquery.form.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/image_loaded.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/jquery.validate.min.js"></script>
    <script src="{{ asset('public/frontend/js/') }}/mail-script.js"></script>

    <script src="{{ asset('public/frontend/js/') }}/main.js"></script>
    <script>
    $(document).ready(function () {
        console.log('selected');
        $('#languageChangeMenuOut').on('change', function () {
        var str = $('#languageChangeMenuOut').val();
        var url = $('.system_url').val();
        var formData = {
            id: $(this).val()
        };
        console.log('url ='+url);
        // get section for student
        $.ajax({
            type: "GET",
            data: formData,
            dataType: 'json',
            url: url + '/' + 'frontend/language-change',
            success: function (data) {
                url= url + '/' + 'frontend/locale'+ '/' + data[0].language_universal;
                console.log(url);
                window.location.href = url;
                //   console.log(data);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});
</script>
    <script>
    $(document).ready(function () {
        console.log('selected');
        $('#languageChangeMenu').on('change', function () {
        var str = $('#languageChangeMenu').val();
        var url = $('.system_url').val();
        var formData = {
            id: $(this).val()
        };
        console.log('url ='+url);
        // get section for student
        $.ajax({
            type: "GET",
            data: formData,
            dataType: 'json',
            url: url + '/' + 'frontend/language-change',
            success: function (data) {
                url= url + '/' + 'systemsetting/locale'+ '/' + data[0].language_universal;
                window.location.href = url;
                //   console.log(data);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});
</script>

    <script src="{{ asset('public/js/')}}/additional.js"></script>
    <script src="{{ asset('public/js/')}}/validate.js"></script>
    <script src="{{asset('public/js/toastr.js')}}"></script>
    <script src="{{asset('public/js/sweet-alert.js')}}"></script>
     <script src="{{asset('public/frontend/frontend.js')}}"></script>
     <script src="https://cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script>
    {!! Toastr::message() !!}

    @stack('js')
  

 

</body>

</html>