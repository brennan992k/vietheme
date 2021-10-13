@extends('frontend.master')
@push('css')

@endpush
@php 
    $homepage = Modules\Pages\Entities\InfixHomePage::where('active_status', 1)->first();
@endphp 
@section('content')

<input type="text" id="_categor_id" hidden value="{{ @$data['category']->id}}">
<input type="text" id="_subcategor_id" hidden value="{{ @$data['subcategory']}}">
<input type="text" id="_tag" hidden value="{{ @$data['tag']}}">
<input type="text" id="_attribute" hidden value="{{ @$data['attribute']}}">
<input type="text" id="_key" hidden value="{{ @$data['key']}}">
  <!-- banner-area start -->
    <div class="banner-area2">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 offset-xl-2">
                    <div class="banner-info text-center mb-30">
                        {{-- <h2>{{ @$data['tag']}}</h2> --}}
                    </div>
                    <div class="row">
                        <div class="col-xl-10 offset-xl-1 col-lg-10 offset-lg-1">
                            <div class="search-field">
                                <div class="search-field-inner">
                                    <form class="search-relative" action="javascript:;">
                                        <input type="text" placeholder="Search your product" onkeyup="showResult(this.value)" class="lolz">
                                        <button type="submit"> <i class="ti-search"></i> </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner-area end -->
    <!-- categori-menu-area-start -->
    <div class="categori-menu-area d-none d-lg-block">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="catagori-menu">
                            <nav>
                                <ul>
                                        @php
                                        $uniqueTags =[];
                                            foreach ($data['item'] as $key => $item) {
                                               foreach (array_unique(explode(",",$item->tags)) as $key => $value) {
                                               $uniqueTags[$value]=$value;
                                                   }
                                               
                                           }
                                          
                                       @endphp
                                    <li><a href="javascript:;">@lang('lang.Tags')</a>
                                        <div class="catagori-submenu-area">
                                            <div class="catagori-submenu-inner">
                                                <span href="javascript:;" class="submenu-close"> <i class="ti-close"></i> </span>
                                                <div class="catagori-content">
                                                    <ul>
                                                        @foreach ($uniqueTags as $val)   
                                                        {{-- @dd($data['sub_cat']->id) --}}
                                                            @php
                                                                if (@$data['sub_cat']) {
                                                                   $number = @App\Models\ManageQuery::ItemWithSubCategoryTag($data['sub_cat']->id,$val); 
                                                                }else {
                                                                    $number = App\Models\ManageQuery::ItemWithCategoryTag($data['category']->id,$val);  
                                                                }
                                                            @endphp 
                                                                                                                
                                                                @if ($val) 
                                                                   <li><a href="{{ @$data['sub_cat']? route('tagSubItem',[@$data['category']->slug,@$data['sub_cat']->slug,'tag',strtolower(str_replace(' ', '_',@$val))]) : route('tagCatItem',[@$data['category']->slug,'tags',strtolower(str_replace(' ', '_',@$val))])}}">{{@$val}}<span> ({{ @$number }})</span></a></li>                                                        
                                                                @endif
                                                                
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a href="javascript:;">@lang('lang.Price')</a>
                                        <div class="catagori-submenu-area">
                                            <div class="catagori-submenu-inner">
                                                <span href="javascript:;" class="submenu-close"> <i class="ti-close"></i> </span>
                                                <div class="catagori-content text-xl-center text-lg-center">
                                                    <div class="prise-form">
                                                        <form action="javascript:;">
                                                            <input type="text" placeholder="{{ @GeneralSetting()->currency_symbol}} 10" id="min_price">
                                                            <input type="text" placeholder="{{ @GeneralSetting()->currency_symbol}} 60" id="max_price">
                                                            <button type="submit" id="price_submit">@lang('lang.filter')</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a href="javascript:;">@lang('lang.sales')</a>
                                        <div class="catagori-submenu-area">
                                            <div class="catagori-submenu-inner">
                                                <span href="javascript:;" class="submenu-close"> <i class="ti-close"></i> </span>
                                                <div class="catagori-content">
                                                    <ul>
                                                            @php
                                                              if (@$data['sub_cat']) {
                                                                    $getData=App\Models\ManageQuery::ItemWithSubCategoryTag($data['sub_cat']->id,null);
                                                                    $no = @$getData['no'];
                                                                    $low = @$getData['low'];
                                                                    $medium = @$getData['medium'];
                                                                    $high =@$getData['high'];
                                                                    $top =@$getData['top'];
                                                            }
                                                            else {
                                                                $getData=App\Models\ManageQuery::ItemSaleCountWithCat($data['category']->id);
                                                                    $no = @$getData['no'];
                                                                    $low = @$getData['low'];
                                                                    $medium = @$getData['medium'];
                                                                    $high =@$getData['high'];
                                                                    $top =@$getData['top'];
                                                            }
                                                        @endphp
                                                        
                                                        <li><a value="NoSell" id="NoSell">@lang('lang.no_sales') <span> ({{ @$no }})</span></a></li>
                                                        <li><a value="LowSell" id="LowSell">@lang('lang.low') <span> ({{ @$low }})</span></a></li>
                                                        <li><a value="MediumSell" id="MediumSell">@lang('lang.mudium') <span> ({{ @$medium }})</span></a></li>
                                                        <li><a value="HighSell" id="HighSell">@lang('lang.high') <span> ({{ @$high }})</span></a></li>
                                                        <li><a value="TopSell" id="TopSell">@lang('lang.top_seller') <span> ( {{ @$top }} )</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li> 
                                    <li><a href="javascript:;">@lang('lang.rating')</a>
                                        <div class="catagori-submenu-area">
                                            <div class="catagori-submenu-inner">
                                                <span href="javascript:;" class="submenu-close"> <i class="ti-close"></i> </span>
                                                <div class="catagori-content">
                                                    <ul>
                                                            @php
                                                            if (@$data['sub_cat']) {
                                                               $getData=App\Models\ManageQuery::ItemStarCountWithSubCat($data['sub_cat']->id);
                                                                    $oneStar = $getData['oneStar'];
                                                                    $TwoStar = $getData['TwoStar'];
                                                                    $ThreStar = $getData['ThreStar'];
                                                                    $FourStar =$getData['FourStar'];
                                                                    $FivStar =$getData['FivStar'];
                                                            }
                                                            else {
                                                                $getData=App\Models\ManageQuery::ItemStarCountWithCat($data['category']->id);
                                                                    $oneStar = $getData['oneStar'];
                                                                    $TwoStar = $getData['TwoStar'];
                                                                    $ThreStar = $getData['ThreStar'];
                                                                    $FourStar =$getData['FourStar'];
                                                                    $FivStar =$getData['FivStar'];
                                                            }
                                                        @endphp
                                                        <li><a onclick="Star(1)">@lang('lang.1_star_and_higher') <span> ({{ @$oneStar }})</span></a></li>
                                                        <li><a onclick="Star(2)">@lang('lang.2_star_and_higher') <span> ({{ @$TwoStar }})</span></a></li>
                                                        <li><a onclick="Star(3)">@lang('lang.3_star_and_higher') <span> ({{ @$ThreStar }})</span></a></li>
                                                        <li><a onclick="Star(4)">@lang('lang.4_star_and_higher') <span> ({{ @$FourStar }})</span></a></li>
                                                        <li><a onclick="Star(5)">@lang('lang.5_star_and_higher') <span> ({{ @$FivStar }})</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a href="javascript:;">@lang('lang.date_added')</a>
                                        <div class="catagori-submenu-area">
                                            <div class="catagori-submenu-inner">
                                                <span href="javascript:;" class="submenu-close"> <i class="ti-close"></i> </span>
                                                <div class="catagori-content">
                                                        @php 
                                                        if (@$data['sub_cat']) {

                                                             $getData=App\Models\ManageQuery::ItemDateWiseWithSubCat($data['category']->id,$data['sub_cat']->id);
                                                                    $Any_Date = $getData['Any_Date'];
                                                                    $LastYear = $getData['LastYear'];
                                                                    $Last_month = $getData['Last_month'];
                                                                    $Last_week =$getData['Last_week'];
                                                                    $Last_day =$getData['Last_day'];


                                                            // $Any_Date=DB::table('items')->where('category_id',@$data['category']->id)->where('sub_category_id',@$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->count();
                                                            // $LastYear=DB::table('items')->where('category_id',@$data['category']->id)->where('sub_category_id',@$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->whereDate('created_at', '<=', date('Y-m-d',strtotime('-1 years')))->count();
                                                            // $Last_month=DB::table('items')->where('category_id',@$data['category']->id)->where('sub_category_id',@$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->whereBetween('created_at',[date('Y-m-d',strtotime('-1 months')),date('Y-m-d')])->count();
                                                            // $Last_week=DB::table('items')->where('category_id',@$data['category']->id)->where('sub_category_id',@$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->whereBetween('created_at',[date('Y-m-d',strtotime('-1 weeks')),date('Y-m-d')])->count();
                                                            // $Last_day=DB::table('items')->where('category_id',@$data['category']->id)->where('sub_category_id',@$data['sub_cat']->id)->where('active_status', 1)->where('status', 1)->whereBetween('created_at',[date('Y-m-d',strtotime('-1 days')),date('Y-m-d')])->count();
                                                        }else {

                                                             $getData=App\Models\ManageQuery::ItemDateWiseWithCat($data['category']->id);
                                                                    $Any_Date = $getData['Any_Date'];
                                                                    $LastYear = $getData['LastYear'];
                                                                    $Last_month = $getData['Last_month'];
                                                                    $Last_week =$getData['Last_week'];
                                                                    $Last_day =$getData['Last_day'];

                                                            // $Any_Date=DB::table('items')->where('category_id',@$data['category']->id)->where('active_status', 1)->where('status', 1)->count();
                                                            // $LastYear=DB::table('items')->where('category_id',@$data['category']->id)->where('active_status', 1)->where('status', 1)->whereDate('created_at', '<=', date('Y-m-d',strtotime('-1 years')))->count();
                                                            // $Last_month=DB::table('items')->where('category_id',@$data['category']->id)->where('active_status', 1)->where('status', 1)->whereBetween('created_at',[date('Y-m-d',strtotime('-1 months')),date('Y-m-d')])->count();
                                                            // $Last_week=DB::table('items')->where('category_id',@$data['category']->id)->where('active_status', 1)->where('status', 1)->whereBetween('created_at',[date('Y-m-d',strtotime('-1 weeks')),date('Y-m-d')])->count();
                                                            // $Last_day=DB::table('items')->where('category_id',@$data['category']->id)->where('active_status', 1)->where('status', 1)->whereBetween('created_at',[date('Y-m-d',strtotime('-1 days')),date('Y-m-d')])->count();
                                                       
                                                        }
                                                        @endphp
                                                    <ul>
                                                        <li><a href="{{ @$data['sub_cat']? route('tagSubItem',[@$data['category']->slug,@$data['sub_cat']->slug,'date','anydate']) : route('tagCatItem',[@$data['category']->slug,'date','anydate'])}}">Any Date<span> ( {{@$Any_Date}} )</span></a></li>
                                                        <li><a href="{{ @$data['sub_cat']? route('tagSubItem',[@$data['category']->slug,@$data['sub_cat']->slug,'date','last_year']) : route('tagCatItem',[@$data['category']->slug,'date','last_year'])}}">In the Last Year <span> ({{ @$LastYear }})</span></a></li>
                                                        <li><a href="{{ @$data['sub_cat']? route('tagSubItem',[@$data['category']->slug,@$data['sub_cat']->slug,'date','last_month']) : route('tagCatItem',[@$data['category']->slug,'date','last_month'])}}">In the Last month <span> ({{ @$Last_month}})</span></a></li>
                                                        <li><a href="{{ @$data['sub_cat']? route('tagSubItem',[@$data['category']->slug,@$data['sub_cat']->slug,'date','last_week']) : route('tagCatItem',[@$data['category']->slug,'date','last_week'])}}">In the Last week <span> ({{@$Last_week}})</span></a></li>
                                                        <li><a href="{{ @$data['sub_cat']? route('tagSubItem',[@$data['category']->slug,@$data['sub_cat']->slug,'date','last_day']) : route('tagCatItem',[@$data['category']->slug,'date','last_day'])}}">In the Last day <span> ({{@$Last_day}})</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a href="javascript:;">@lang('lang.software_version')</a>
                                        <div class="catagori-submenu-area">
                                            <div class="catagori-submenu-inner">
                                                <span href="javascript:;" class="submenu-close"> <i class="ti-close"></i> </span>
                                                <div class="catagori-content">
                                                    <ul>
                                                        @foreach ($data['item']->unique('software_version') as $item)
                                                        @php
                                                        if (@$data['sub_cat']) {
                                                           $software_version =App\Models\ManageQuery::ItemSubCatWithSoftwareVersion($data['sub_cat']->id,$item->software_version);
                                                            // DB::table('items')->where('sub_category_id',@$data['sub_cat']->id)->where('software_version',@$item->software_version)->get()->count(); 
                                                          }else {
                                                              $software_version =App\Models\ManageQuery::ItemCatWithSoftwareVersion($data['category']->id,$item->software_version);
                                                            //    DB::table('items')->where('category_id',@$data['category']->id)->where('software_version',@$item->software_version)->get()->count(); 
                                                          }
                                                        @endphp
                                                         @if (@$item) 
                                                         <li><a href="{{ @$data['sub_cat']? route('tagSubItem',[@$data['category']->slug,@$data['sub_cat']->slug,'software_version',strtolower(str_replace(' ', '_',@$item->_software_version->name))]) : route('tagCatItem',[@$data['category']->slug,'software_version',strtolower(str_replace(' ', '_',@$item->_software_version->name))])}}">{{ @$item->_software_version->name }}<span> ({{ @$software_version  }})</span></a></li>
                                                       @endif
                                                      @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a href="javascript:;">@lang('lang.compatiability')</a>
                                        <div class="catagori-submenu-area">
                                            <div class="catagori-submenu-inner">
                                                <span href="javascript:;" class="submenu-close"> <i class="ti-close"></i> </span>
                                                <div class="catagori-content">
                                                    <ul>
                                                        @foreach ($data['item']->unique('compatible_with') as $item)
                                                        @php
                                                        if (@$data['sub_cat']) {
                                                           $compatible_with = App\Models\ManageQuery::ItemSubCatWithCompatibleWith($data['sub_cat']->id,$item->compatible_with);
                                                        //    DB::table('items')->where('sub_category_id',@$data['sub_cat']->id)->where('compatible_with',@$item->compatible_with)->get()->count(); 
                                                          }else {
                                                              $compatible_with =App\Models\ManageQuery::ItemCatWithCompatibleWith($data['category']->id,$item->compatible_with);
                                                            //    DB::table('items')->where('category_id',@$data['category']->id)->where('compatible_with',@$item->compatible_with)->get()->count(); 
                                                          }
                                                        @endphp
                                                          <li><a href="{{ @$data['sub_cat']? route('tagSubItem',[@$data['category']->slug,@$data['sub_cat']->slug,'compatible_with',strtolower(str_replace(' ', '_',@$item->_compatible_with->name))]) : route('tagCatItem',[@$data['category']->slug,'compatible_with',strtolower(str_replace(' ', '_',@$item->_compatible_with->name))])}}">{{ @$item->_compatible_with->name }}<span> ({{ @$compatible_with  }})</span></a></li>
                                                      @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- categori-menu-area-end -->
    <!-- latest-goods-start -->
    <div class="latest-goods-area gray-bg section-padding1 mt-40">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-xl-12 portfolio-menu">                   

                     @if(@$data['category']) 
                     <font><button class="active">{{@$data['category']->title }}</button></font>
                     @endif
                     @if(@$data['sub_cat'])
                     <font><button class="active">{{@$data['sub_cat']->title }}</button></font>
                     @endif

                     @if(@$data['tag'])
                    <font> <button class="active">{{str_replace('_',' ',@ucfirst(trans($data['tag']))) }}</button></font>
                     @endif
                     {{-- @if(@$data['attribute'])
                     <font><button class="active">{{ @$data['attribute'] }}</button></font>
                     @endif --}}
                     @if(@$data['key'])
                     <font><button class="active">{{@$data['key'] }}</button></font>
                     @endif
                     @if(@$data['category'])
                         <font><button onclick="window.location.href = '{{URL('/')}}';" class="active">@lang('lang.clear_filter')</button></font>
                     @endif
                     <font class="filter_cat_sale"></font>
                     <font class="filter_cat_rate"></font>
                     <font class="filter_cat_price"></font>
                </div>
                <div class="col-xl-6">
                    <div class="section-title mb-40">
                        <h3>{{$homepage->product_title}}</h3>
                        <p>{{$homepage->product_title_description}}</p>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="portfolio-menu portfolio-menu2 text-xl-right text-lg-left text-sm-center">
                            <button class="active" value="all" id="all" data-filter="*">@lang('lang.all_items')</button>
                            <button data-filter=".cat1" value="bestsell" id="bestsell">@lang('lang.best_sellers')</button>
                            <button data-filter=".cat2" value="newest" id="newest">@lang('lang.Newest')</button>
                            <button data-filter=".cat3" value="bestrated" id="bestrated">@lang('lang.best_rated')</button>
                            <button data-filter=".cat4" value="trending" id="trending">@lang('lang.Trending')</button>
                            <button data-filter=".cat5" value="high" id="high">@lang('lang.price_high_to_low')</button>
                            <button data-filter=".cat6" value="low" id="low">@lang('lang.price_low_to_high')</button>
                    </div>
                </div>
            </div>
            <div class="row grid databox" id="databox">

            </div>
            <div class="row bt">
            </div>
        </div>
    </div>
    <!-- latest-goods-end -->
@endsection
@push('js')
<script src="{{ asset('public/frontend/js/') }}/tag.js"></script>

@endpush