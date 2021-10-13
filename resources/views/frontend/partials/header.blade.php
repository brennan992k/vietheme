@php 
    $data['category'] =  app('item_categories');
    $data['cart_item']=Cart::content();
    $logo_conditions = ['title'=>'Logo', 'active_status'=>1];
    $logo = dashboard_background($logo_conditions);
@endphp
<header>
   
        <div id="sticky-header" class="header-area">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-between">
                    <!-- <div class=" col-md-3 col-lg-2 col-xl-3 col-md-12"> -->
                        <div class="logo-img" >
                          <a href="{{url('/')}}">
                               <img src="{{ @$logo ? asset(@$logo->image) : asset('public/frontend/img/Logo.png') }}" alt="" class="mw">
                            </a>
                        </div>
                    <!-- </div> -->
                    <!-- <div class="col-xl-6 d-none d-lg-block col-lg-6"> -->
                        <div class="main-menu">
                            <nav>
                                <ul id="navigation">
                                    @foreach (app('item_categories') as $item)
                                       <li><a href="{{ route('categoryItem',@$item->slug) }}">{{ @$item->title}}</a>
                                            <ul class="submenu">
                                                
                                                @foreach (@$item->subCategory as $sub_cat)
                                                    <li><a href="{{ url('category/sub/'.@$item->slug.'/'.@$sub_cat->slug) }}">{{ @$sub_cat->title}}</a></li>
                                                @endforeach
                                                
                                            </ul>
                                       </li>
                                    @endforeach
                                </ul>
                            </nav>
                        </div>
                    <!-- </div> -->
                    <!-- <div class="col-xl-3 col-md-6 col-lg-4 d-none d-lg-block"> -->
               

                     
                        @if (Auth::check())
                        <div class="main_user-pro_wrap d-flex align-items-center justify-content-end">
                            <a class="" href="{{ route('Cart') }}"><span class="cart"><i class="ti-shopping-cart" id="ti_Shop">
                                @if (@count($data['cart_item']) >0 )
                                    <span class="badge_icon" id="cartItem">{{ count(@$data['cart_item'])}}</span>  
                                @endif
                            </i></span></a>

                            {{-- @dd( app('infix_languages')) --}}
                      
                            <select class="niceSelect languageChange" name="languageChange" id="languageChangeMenu">
                                <option data-display="@lang('lang.language')" value="0">@lang('lang.language')</option>
                                @php
                                    $languages=app('infix_languages');
                                @endphp
                                
                                @foreach($languages as $lang)
    
                                @if (Auth::check())
                                    <option data-display="{{$lang->native}}" value="{{ $lang->language_universal}}" {{$lang->language_universal == userActiveLanguage()? 'selected':''}}>{{$lang->native}}</option>
                                
                                @else
                                    <option data-display="{{$lang->native}}" value="{{ $lang->language_universal}}" {{$lang->language_universal == activeLanguage()? 'selected':''}}>{{$lang->native}}</option>
                                
                                @endif
                                  
                                    @endforeach
                            </select>

                                <div class="profile-area">
                                    <a class="user_author_pro" > <span class="name"> {{ Str::limit(@Auth::user()->username, 8) }}</span> 
                                    @if (Auth::user()->role_id != 1)
                                        
                                    <span class="simple_line">|</span> 
                                    @endif
                                         <span class="prise">
                                            @if (Auth::user()->role_id == 4)
                                                {{@$infix_general_settings->currency_symbol}}{{ @Auth::user()->balance->amount}}
                                            @endif
                                            @if (Auth::user()->role_id == 5)
                                                {{@$infix_general_settings->currency_symbol}}{{ @Auth::user()->balance->amount}}
                                            @endif
                                        
                                        </span> </a>
                                    <div class="profile_dropdwon">
                                        <div class="profile_hover_links">
                                            <h3> {{ @Auth::user()->username}}</h3>
                                                @if (@Auth::user()->role_id==1 || @Auth::user()->role_id==2)
                                                    <ul>
                                                        <li> <a href="{{route('admin.dashboard')}} ">@lang('lang.dashboard')</a> </li>   
                                                    </ul> 
                                                @endif
                                            <ul>
                                                @if (Auth::user()->role_id == 4)
                                                    <li><a href="{{ route('author.profile',@Auth::user()->username)}}">@lang('lang.profile')</a></li>
                                                    <li><a href="{{ route('author.setting',@Auth::user()->username) }}">@lang('lang.settings')</a></li>
                                                    <li><a href="{{ route('author.download',@Auth::user()->username) }}">@lang('lang.Downloads')</a></li>
                                                    <li><a href="{{ route('user.deposit',@Auth::user()->username)}}">@lang('lang.fund_deposit')</a></li>
                                                @endif
                                                @if (Auth::user()->role_id == 5)
                                                    <li><a href="{{ route('customer.profile',@Auth::user()->username) }}">@lang('lang.profile')</a></li>
                                                    <li><a href="{{ route('customer.downloads',@Auth::user()->username) }}">@lang('lang.Downloads')</a></li>
                                                    <li><a href="{{ route('user.deposit',@Auth::user()->username)}}">@lang('lang.fund_deposit')</a></li>
                                                    @if (GeneralSetting()->public_vendor==1)
                                                        
                                                    <li><a href="{{ route('user.BecomeAuthor') }}">@lang('lang.become_a_author')</a></li>
                                                    @endif

                                                @endif
                                                {{-- <li><a href="{{ route('user.affiliate') }}">@lang('lang.affiliate')</a></li> --}}
                                            </ul>
                                        </div>
                                        @if (Auth::user()->role_id == 5 || Auth::user()->role_id == 4)
                                            <div class="profile_hover_links">
                                                @if (Auth::user()->role_id == 4)
                                                <h3>@lang('lang.author_settings')</h3>
                                                @endif
                                                @if (Auth::user()->role_id == 5)
                                                <h3>@lang('lang.user_settings')</h3>
                                                @endif
                                                <ul>
                                                    @if (Auth::user()->role_id == 5)
                                                    <li><a href="{{ route('customer.setting',@Auth::user()->username) }}">@lang('lang.settings')</a></li>
                                                    @endif
                                                    @if (Auth::user()->role_id == 4)
                                                    <li><a href="{{ route('author.dashboard',@Auth::user()->username)}}">@lang('lang.dashboard')</a></li>
                                                    <li><a href="{{ route('author.portfolio',@Auth::user()->username)}}">@lang('lang.portfolio')</a></li>
                                                    <li><a href="{{ route('author.coupon_list',@Auth::user()->username)}}">@lang('lang.coupon')</a></li>
                                                    <li><a href="{{ route('author.content')}}">@lang('lang.upload')</a></li>
                                                    <li><a href="{{ route('author.earning',@Auth::user()->username)}}">@lang('lang.earnings')</a></li>
                                                    <li><a href="{{ route('author.statement',@Auth::user()->username)}}">@lang('lang.statement')</a></li>
                                                    <li><a href="{{ route('author.payout',@Auth::user()->username)}}">@lang('lang.payouts')</a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="sign_out">
                                                <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">@lang('lang.sign_out')</a>
            
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="dn">
                                                    @csrf
                                                </form>
                                        </div>
                                    </div>
                                </div> 
                        </div>                       
                        @endif
                        @if (!Auth::check())

                        <div class="main_user-pro_wrap d-flex align-items-center justify-content-end">
                            <a class="" href="{{ route('Cart') }}"><span class="cart"><i class="ti-shopping-cart" id="ti_Shop">
                                @if (@count($data['cart_item']) >0 )
                                    <span class="badge_icon" id="cartItem">{{ count(@$data['cart_item'])}}</span>  
                                @endif
                            </i></span></a>

                            @if (Illuminate\Support\Facades\Config::get('app.app_sync') && Auth::check()==false)
                            @php
                                if( App::getLocale()!=null){
                                    $local= App::getLocale();
                                }else{
                                    $local= activeLanguage();
                                }
                            @endphp
                                <select class="niceSelect languageChange" name="languageChange" id="languageChangeMenuOut">
                                    <option data-display="@lang('lang.select') @lang('lang.language')" value="0">@lang('lang.select') @lang('lang.language')</option>
                                    @php
                                        $languages=app('infix_languages');
                                    @endphp
                                    
                                    @foreach($languages as $lang)
    
                                        <option data-display="{{$lang->native}}" value="{{ $lang->language_universal}}" {{$lang->language_universal == $local? 'selected':''}}>{{$lang->native}}</option>
                                    
                                        @endforeach
                                </select>
                            @endif
                                <div class="profile-area m-0">

                                    {{-- <a class=" " href="{{ url('customer/login') }}">@lang('lang.sign_in')</a> --}}
                                    <a class="login_icon" href="{{ url('customer/login') }}"> <span class="signin_text" >@lang('lang.sign_in')</span> <i class="fa fa-sign-in m-0 p-0 signin_btn" aria-hidden="true"></i></a>
                                </div>
                        </div>
                            {{-- <div class="profile-area">
                                <p class="main_user-pro_wrap d-flex align-items-center justify-content-end"> <a href="{{ route('Cart') }}"><span class="cart"><i class="ti-shopping-cart" id="ti_Shop">
                                    @if (@count(@$data['cart_item']) >0 )
                                        <span class="badge_icon" id="cartItem">{{ count(@$data['cart_item'])}}</span>  
                                    @endif
                                </i></span></a>  
                                <a class="" href="{{ url('customer/login') }}">Sign In</a></p>
                            </div> --}}
                        @endif
                    <!-- </div> -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                    <div class="col-12 d-lg-none">
                         @if (Auth::check())
                        <div class="profile-area">
                            <a class="user_author_pro" ><i class="ti-user"></i> <span
                                    class="name">{{ @Auth::user()->username}}</span> <span class="simple_line">|</span> <span
                                    class="prise"></span> 
                                    @if (Auth::user()->role_id == 4)
                                    @lang('lang.earnings'): {{@$infix_general_settings->currency_symbol}}{{ @Auth::user()->balance->amount}}
                                    @endif
                                    @if (Auth::user()->role_id == 5)
                                    @lang('lang.balances'): {{@$infix_general_settings->currency_symbol}}{{ @Auth::user()->balance->amount}}
                                    @endif
                                </a>
                            <div class="profile_dropdwon">
                                <div class="profile_hover_links">
                                    <h3>{{ @Auth::user()->username}}</h3>
                                    <ul>
                                            @if (Auth::user()->role_id == 5)
                                            <li><a href="{{ route('customer.profile',@Auth::user()->username) }}">@lang('lang.profile')</a></li>
                                            <li><a href="{{ route('customer.downloads',@Auth::user()->username) }}">@lang('lang.Downloads')</a></li>
                                            @if (GeneralSetting()->public_vendor==1)
                                                
                                                <li><a href="{{ route('user.BecomeAuthor') }}">@lang('lang.become_a_author')</a></li>
                                            @endif
                                            @endif
                                            @if (Auth::user()->role_id == 4)
                                            <li><a href="{{ route('author.profile',@Auth::user()->username)}}">@lang('lang.profile')</a></li>
                                            <li><a href="{{ route('author.download',@Auth::user()->username) }}">@lang('lang.Downloads')</a></li>                                            
                                            @endif
                                            @if (Auth::check() && @Auth::user()->role_id==1 || @Auth::user()->role_id==2)
                                                <li> <a href="{{route('admin.dashboard')}} ">@lang('lang.dashboard')</a> </li>   
                                            @else
                                                <li><a href="{{ route('user.deposit',@Auth::user()->username)}}">@lang('lang.fund_deposit')</a></li>
                                            @endif
                                           
                                    </ul>
                                </div>
                                    
                                <div class="profile_hover_links">
                                    @if (Auth::user()->role_id == 4)
                                    <h3>@lang('lang.author_settings')</h3>
                                    @endif
                                    @if (Auth::user()->role_id == 5)
                                    <h3>@lang('lang.user_settings')</h3>
                                    @endif
                                    <ul> 
                                            @if (Auth::user()->role_id == 5)
                                            <li><a href="{{ route('customer.setting',@Auth::user()->username) }}">@lang('lang.settings')</a></li>
                                            @endif
                                            @if (Auth::user()->role_id == 4)
                                            <li><a href="{{ route('author.setting',@Auth::user()->username) }}">@lang('lang.settings')</a></li>
                                            <li><a href="{{ route('author.dashboard',@Auth::user()->username)}}/">@lang('lang.dashboard')</a></li>
                                            <li><a href="{{ route('author.coupon_list',@Auth::user()->username)}}">@lang('lang.coupon')</a></li>
                                            <li><a href="{{ route('author.content')}}">@lang('lang.upload')</a></li>
                                            <li><a href="{{ route('author.earning',@Auth::user()->username)}}">@lang('lang.earnings')</a></li>
                                            <li><a href="{{ route('author.statement',@Auth::user()->username)}}">@lang('lang.statement')</a></li>
                                            <li><a href="{{ route('author.payout',@Auth::user()->username)}}">@lang('lang.payouts')</a></li>
                                            @endif
                                    </ul>
                                </div>
                                <div class="sign_out">
                                    <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">@lang('lang.sign_out')</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="dn">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                       @endif
                    </div>
                </div>
            </div>
        </div>
</header>
