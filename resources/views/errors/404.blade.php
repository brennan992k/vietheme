<!doctype html>
<html lang="en">
  <head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap.css"/>
    <link rel="stylesheet" href="{{ asset('public/frontend/') }}/error.css">
    <title>Sorry ! Page not found</title>
 
  </head>
  @php
        $dashboard_background = Modules\Systemsetting\Entities\InfixBackgroundSetting::where('is_default',1)->where('active_status',1)->where('id',5)->first();
    @endphp
  <body  class="antialiased font-sans">

    <div class="error_page_wrapper">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-10">
                    <div class="error_Page_main_content text-center">
                        <div class="error_thumb">
                            <img width="400" height="auto" src="{{asset('/')}}{{@$dashboard_background->image}}" alt="" class="img img-fluid">
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-6">
                                <div class="error_page_content">
                            {!! @$dashboard_background->additional_text !!}
                            <a href="{{URL::previous()}}">
                                <button class="primary_button">
                                    Go Back
                                </button>
                            </a>
                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="{{asset('public/backEnd/error')}}/js/jquery-3.3.1.slim.min.js"></script>
    <script src="{{asset('public/backEnd/error')}}/js/popper.min.js"></script>
    <script src="{{asset('public/backEnd/error')}}/js/bootstrap.min.js"></script>
  
</body>
</html>
