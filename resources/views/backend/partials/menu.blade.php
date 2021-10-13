@php
     $notification=app('sm_notifications');
@endphp
<link rel="stylesheet" href="{{ asset('public/backend/css/') }}/live_search.css">
<nav class="navbar navbar-expand-lg up_navbar">
    <div class="container-fluid">
        <div class="col-lg-12">
        <div class='up_dash_menu'>
        <button type="button" id="sidebarCollapse" class="btn d-lg-none nav_icon">
                <i class="ti-more"></i>
            </button>
<input type="hidden" id="url" value="{{url('/')}}">
        <ul class="nav navbar-nav mr-auto search-bar">
                <li class="">
                    <div class="input-group">
                        <span>
                            <i class="ti-search" aria-hidden="true" id="search-icon"></i>
                        </span>

                        <input type="text" class="form-control primary-input input-left-icon" placeholder="Search"
                            id="search" onkeyup="showResult(this.value)"/>
                        <span class="focus-border"></span>
                    </div>
                    <div id="livesearch"></div>
                </li>
            </ul>

            <button class="btn btn-dark d-inline-block d-lg-none ml-auto nav_icon" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="ti-menu"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="nav navbar-nav mr-auto nav-buttons flex-sm-row">
                <li class="nav-item">
                    <a class="primary-btn white mr-10" href="{{url('/')}}">@lang('lang.website')</a>
                </li>
                <li class="nav-item">
                    <a class="primary-btn white mr-10" href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="primary-btn white" href="#">@lang('lang.reports')</a>
                </li> --}}
            </ul>

                    @php
                    if(Schema::hasTable('infix_languages')){
                        // @$languages = Modules\Systemsetting\Entities\InfixLanguage::all();
                        @$active_language=Modules\Systemsetting\Entities\InfixLanguage::where('active_status',1)->first();
                    }
                    @endphp


           {{--  @if (isset($languages))


            <ul class="nav navbar-nav mr-auto nav-setting flex-sm-row d-none d-lg-block">
                <li class="nav-item">

                    <select class="niceSelect languageChange" name="languageChange" id="languageChange">

                        @foreach($languages as $lang)
                            <option data-display="{{@$lang->native}}" {{@$lang->id == @$active_language->id? 'selected':''}} value="{{URL::to('/systemsetting/locale/'.@$lang->language_universal)}}">{{@$lang->native}}</option>
                        @endforeach

                    </select>
                </li>
            </ul>
            @endif --}}
            @if(@$styles)
            {{-- @if(@$styles && Auth::user()->role_id == 1) --}}
                      
                        <ul class="nav navbar-nav mr-auto nav-setting flex-sm-row d-none d-lg-block colortheme">
                            <li class="nav-item active">
                                <select class="niceSelect infix_theme_style" id="infix_theme_style">
                                    <option data-display="@lang('lang.select_styles')" value="0">@lang('lang.select_styles')</option>
                                    @foreach($styles as $style)

                                        <option value="{{@$style->id}}" {{@$style->id == $active_style->id?'selected':''}}>{{@$style->style_name}}</option>

                                    @endforeach
                                </select>
                            </li>
                        </ul>


                        <ul class="nav navbar-nav mr-auto nav-setting flex-sm-row d-none d-lg-block colortheme">
                            <li class="nav-item active">
                               <select class="niceSelect languageChange" name="languageChange" id="languageChangeMenu">
                                        <option data-display="@lang('lang.select') @lang('lang.language')" value="0">@lang('lang.select') @lang('lang.language')</option>
                                        @php
                                            $languages=app('infix_languages');
                                        @endphp
                                        @foreach($languages as $lang)
                                            <option data-display="{{$lang->native}}" value="{{ $lang->language_universal}}" {{$lang->language_universal == app()->getLocale()? 'selected':''}}>{{$lang->native}}</option>
                                        @endforeach
                                    </select>
                            </li>
                        </ul>



                        {{-- <ul class="nav navbar-nav mr-auto nav-setting flex-sm-row d-none d-lg-block colortheme">
                            <li class="nav-item active">
                                <select class="niceSelect infix_theme_rtl" id="infix_theme_rtl">
                                    <option data-display="Select Alignment" value="0">@lang('lang.select_alignment')</option>
                                    @php
                                    @$is_rtl = @$inifx_general_settings->ttl_rtl;

                                    @endphp
                                        <option value="2" {{@$is_rtl==2?'selected':''}}>@lang('lang.LTL')</option>
                                        <option value="1" {{@$is_rtl==1?'selected':''}}>@lang('lang.RTL')</option>
                                </select>
                            </li>
                        </ul> --}}

                        @endif

            <!-- Start Right Navbar -->
            <ul class="nav navbar-nav right-navbar">
                

                    <li class="nav-item notification-area   d-none d-lg-block">
                            <div class="dropdown">
                                <button type="button" class="dropdown-toggle" data-toggle="dropdown">
    
                                    <span class="badge">{{ count(@$notification)}}</span>
                                    <span class="flaticon-notification"></span>
                                </button>
                                <div class="dropdown-menu">
                                    <div class="white-box">
                                        <div class="p-h-20">
                                            <p class="notification">@lang('lang.you_have') <span>{{count(@$notification)}} @lang('lang.new')</span>
                                                @lang('lang.notification')</p>
                                        </div>
                                        @foreach(@$notification as $val)
                                    <a class="dropdown-item pos-re linkk" href="{{ @$val->link}}" name="tabs" data-id="{{ @$val->id }}">
                                        <div class="single-message single-notifi">
                                            <div class="d-flex">
                                                <span class="ti-bell"></span>
                                                <div class="d-flex align-items-center ml-10">
                                                    <div class="mr-60">
                                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="{{@$val->message}}">
                                                        <p class="message">{{@$val->message}}</p>
                                                        </span>
                                                    </div>
                                                <div class="mr-10 text-right bell_time">
                                                    <p class="time pl-2"><small>{{DateFormat(@$val->created_at)}}</small></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </a>
                                        @endforeach    
                                        <a href="{{ route('admin.mark_all_as_read') }}" class="primary-btn text-center text-uppercase mark-all-as-read">
                                            @lang('lang.mark_all_as_read')
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>

                <li class="nav-item setting-area">
                    <div class="dropdown">
                        <button type="button" class="dropdown-toggle" data-toggle="dropdown">

                                @if(!empty(@Auth::user()->profile->image))
                                <img class="rounded-circle" src="{{asset(@Auth::user()->profile->image)}}"  alt="">
                                @else
                                <img class="rounded-circle" src="{{asset('public/backend/img/admin/staff.png')}}"  alt="">
                                @endif
                        </button>
                        <div class="dropdown-menu profile-box">
                            <div class="white-box">
                                <a class="dropdown-item" href="#">
                                    <div class="">
                                        <div class="d-flex">
                                            @if(!empty(@Auth::user()->profile->image))
                                                <img class="client_img" src="{{asset(@Auth::user()->profile->image)}}"alt="">
                                            @else
                                                <img class="client_img" src="{{asset('public/backend/img/admin/staff.png')}}"alt="">
                                            @endif
                                            <div class="d-flex ml-10">
                                                <div class="">
                                                    <h5 class="name text-uppercase">{{Auth::user()->username}}</h5>
                                                    <p class="message">{{Auth::user()->email}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <ul class="list-unstyled">
                                    <li>
                                        {{-- @if(Auth::user()->role_id == 1) --}}
                                        <a href="{{route('admin.profile', Auth::user()->id)}}">
                                            <span class="ti-user"></span>
                                            @lang('lang.profile') @lang('lang.view')
                                        </a>
                                        {{-- @endif --}}
                                    </li>
                                    <li>
                                        <a href="{{route('admin.password_change')}}">
                                            <span class="ti-key"></span>
                                            @lang('lang.password')
                                        </a>
                                    </li>
                                    <li>

                                        <a href="{{  route('admin.logout')}}">
                                            <span class="ti-unlock"></span>
                                            @lang('lang.logout')
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <!-- End Right Navbar -->
        </div>
        </div>
        </div>
    </div>
</nav>


@section('script')


@endsection
