 <!-- footer-start -->
 <footer>
    @php
        $logo_conditions = ['title'=>'Logo', 'active_status'=>1];
        $logopic = dashboard_background($logo_conditions);
    @endphp
    <div class="footer-area footer-bg">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 offset-xl-1">
                        <div class="row">
                            <div class="col-xl-4 col-md-3">
                                <div class="footer-widget">
                                    <div class="footer-logo"> 
                                       <a href="{{ url('/') }}">
                                            <img src="{{ @$logopic ? asset($logopic->image) : asset('public/frontend/img/Logo.png') }}" alt="" class="mw">
                                        </a>
                                    </div>
                                    <div class="community-area">
                                            @php
                                            $getData=App\Models\ManageQuery::FooterSellCount();
                                                @$ItemEarning=$getData['ItemEarning'];
                                            @endphp
                                        <div class="total-community">
                                            @php
                                                $system_settings=app('infix_general_settings');
                                            @endphp
                                            <h3> {{ @$system_settings->currency_symbol}} {{ isset($ItemEarning) ? round($ItemEarning) : 0}}</h3>
                                            <p>@lang('lang.total_community_earnings')</p>
                                        </div>
                                        <div class="total-community second">
                                            @php
                                                @$ItemSale=$getData['ItemSale'];

                                            @endphp
                                            <h3>{{ @$ItemSale }}</h3>
                                            <p>@lang('lang.total_items_sold')</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                                $custom_link=InfixFooterMenu();
                            @endphp
                            @if ($custom_link!='')
                                
                            
                            <div class="col-xl-2 col-md-3">
                                <div class="footer-widget">
                                    <div class="footer-title">
                                    <h3>{{ $custom_link->title1 }}</h3>
                                    </div>
                                    <div class="footer-list">
                                        <nav>
                                            <ul>
                                                @if ($custom_link->link_href1!='')
                                                  <li><a href="{{ url($custom_link->link_href1) }}">{{ $custom_link->link_label1 }} </a></li>
                                                  
                                                @endif
                                                @if ($custom_link->link_href5!='')
                                                <li><a href="{{ url($custom_link->link_href5) }}">{{ $custom_link->link_label5 }}</a></li>
                                                @endif
                                                @if ($custom_link->link_href9!='')
                                                    <li><a href="{{ url($custom_link->link_href9) }}">{{ $custom_link->link_label9 }}</a></li>
                                                
                                                @endif
                                                @if ($custom_link->link_href13!='')
                                                      <li><a href="{{ url($custom_link->link_href13) }}">{{ $custom_link->link_label13 }} </a></li>
                                                    @endif
                                                
                                                @if (!@Auth::check())                                                    
                                                  <li><a href="{{url('register')}}">@lang('lang.start_selling')</a></li>
                                                @endif
                                                {{-- @if (@Auth::user()->role_id == 4 || @Auth::user()->role_id == 5)                                                    
                                                  <li><a href="{{ route('user.affiliate',@Auth::user()->username) }}">Become an affiliate</a></li>
                                                @endif --}}
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 offset-xl-1 col-md-3">
                                <div class="footer-widget">
                                    <div class="footer-title">
                                        <h3>{{ $custom_link->title2 }}</h3>
                                    </div>
                                    <div class="footer-list">
                                        <nav>
                                            <ul>
                                                    @if ($custom_link->link_href2!='')
                                                    <li><a href="{{ $custom_link->link_href2}}">{{ $custom_link->link_label2}}</a></li>
                                                
                                                @endif
                                                @if ($custom_link->link_href6!='')
                                                <li><a href="{{ url($custom_link->link_href6) }}">{{ $custom_link->link_label6 }}</a></li>
                                      
                                                @endif
                                                @if ($custom_link->link_href10!='')
                                                <li><a href="{{ $custom_link->link_href10 }}">{{ $custom_link->link_label10 }}</a></li>
                                      
                                                @endif
                                                @if ($custom_link->link_href14!='')
                                                <li><a href="{{ $custom_link->link_href14 }}">{{ $custom_link->link_label14 }}</a></li>
                                           
                                               @endif
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 offset-xl-1 col-md-3">
                                <div class="footer-widget">
                                    <div class="footer-title">
                                        <h3>{{ $custom_link->title3 }}</h3>
                                    </div>
                                    <div class="footer-list">
                                        <nav>
                                            <ul>
                                             @if ($custom_link->link_href3!='')
                                                    <li><a href="{{ $custom_link->link_href3}}">{{ $custom_link->link_label3}}</a></li>
                                               @endif
                                                    @if ($custom_link->link_href7!='')
                                                        <li><a href="{{ $custom_link->link_href7 }}">{{ $custom_link->link_label7 }}</a></li>
                                                    @endif
                                                    @if ($custom_link->link_href11!='')
                                                        <li><a href="{{ $custom_link->link_href11 }}">{{ $custom_link->link_label11 }}</a></li>
                                                    @endif
                                                    @if ($custom_link->link_href15!='')
                                                        <li><a href="{{ $custom_link->link_href15 }}">{{ $custom_link->link_label15 }}</a></li>
                                                    @endif
                                                {{-- <li><a href="{{ route('faqPage') }}">FAQ</a></li> --}}
                                                @if (@Auth::user()->role_id == 4 || @Auth::user()->role_id == 5)   
                                                   <li><a href="{{ route('user.refundRequest')}}">@lang('lang.Refund')</a></li>
                                                @endif
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 offset-xl-1">
                        <div class="line-border mb-50"></div>
                        <div class="row ">
                            <div class="col-xl-7 col-md-12 col-lg-7">
                                <div class="footer-bottom">
                                    <div class="footer-link">
                                        <nav>
                                            <ul>
                                                @php
                                                    $menus = FooterMenu();
                                                @endphp
                                                @foreach ($menus as $menu)
                                                <li>
                                                <a href="{{$menu->menu_url}}">{{$menu->menu_title}}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </nav>
                                    </div>
                                     @php
                                         $footer_link=InfixFooterSetting();
                                    @endphp
                                    <p class="copy-right-text">{{ @$footer_link->copyright_text }}. </p>
                                   
                                </div>
                            </div>
                            <div class="col-xl-5 col-md-12 col-lg-5">
                                <div class="social-links">
                                    <nav>
                                        <ul>
                                            {!! getSocialIconsDynamic() !!} 
                                        </ul> 
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer-end -->