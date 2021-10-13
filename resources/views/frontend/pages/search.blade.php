@extends('frontend.master')
@push('css')

    <link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/index_modal.css">
@endpush
@section('content')

<input type="text" id="_categor_id" hidden value="{{ @$data['category']->id}}">
<input type="text" id="_subcategor_id" hidden value="{{ @$data['subcategory']}}">
<input type="text" id="_tag" hidden value="{{ @$data['tag']}}">
<input type="text" id="_attribute" hidden value="{{ @$data['attribute']}}">
<input type="text" id="_key" hidden value="{{ @$data['key']}}">
<input type="text" id="_feature_item" hidden value="{{ @$data['_feature_item']}}">


  <!-- banner-area start -->
    <div class="banner-area2">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 offset-xl-2">
                    {{-- <div class="banner-info text-center mb-30">
                        <h2>{{ @$data['sub_cat']? @$data['sub_cat']->title :@$data['key']}}</h2>
                    </div> --}}
                    <div class="row">
                        <div class="col-xl-10 offset-xl-1 col-lg-10 offset-lg-1">
                            <div class="search-field">
                                <div class="search-field-inner">
                                    <form class="search-relative" action="{{ route('_by_search')}}" method="POST">
                                        @csrf
                                        <input type="text" placeholder="@lang('lang.search_your_product')"  name="key">  {{-- filter.js --}}
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
                                    @if (!@$data['sub_cat'] && @$data['category'])
                                    <li><a href="javascript:;">@lang('lang.sub') @lang('lang.category')</a>
                                        <div class="catagori-submenu-area">
                                            <div class="catagori-submenu-inner">
                                                <span href="javascript:;" class="submenu-close"> <i class="ti-close"></i> </span>
                                                <div class="catagori-content">
                                                    <ul>
                                                        @foreach (@$data['sub_category'] as $item)                                                           
                                                        <li><a href="{{ route('searchCategoryItem',[@$data['category']->slug,@$item->slug]) }}">{{ @$item->title }} <span> ({{ @$item->CountItem( @$data['category']->id,@$item->id) }})</span></a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>                                        
                                    @endif
                                    @if (!@$data['category'])
                                    <li><a href="javascript:;">@lang('lang.category')</a>
                                        <div class="catagori-submenu-area">
                                            <div class="catagori-submenu-inner">
                                                <span href="javascript:;" class="submenu-close"> <i class="ti-close"></i> </span>
                                                <div class="catagori-content">
                                                    <ul>
                                                            @php
                                                            $uniqueCat =[];
                                                            $countCategory =0;
                                                                foreach ($data['item'] as $key => $item) {
                                                                          @$uniqueCat[@$item->category]=@$item->category;
                                                                          @$cid[$countCategory++]=@$item->category_id;
                                                                       }
                                                           @endphp
                                                           @php 
                                                           $countCategory =0;
                                                           @endphp 
                                                        @foreach (@$uniqueCat as $val)  
                                                        @php
                                                            $catCount= App\Models\ItemCounter::countByCategoryTag($cid[$countCategory++],$val);
                                                            // DB::table('items')->where('category_id',@$cid[$countCategory++])->where('title','LIKE', '%'.@$data['key'].'%')->count();
                                                        @endphp 
                                                        @if ($catCount > 0)                                                            
                                                           <li><a href="{{ route('searchCategoryItem',strtolower(str_replace(' ', '_',@$val))) }}">{{ @$val }} <span> ({{ @$catCount }})</span></a></li>
                                                        @endif                                                       
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>                                        
                                    @endif
                                    <li><a href="javascript:;">@lang('lang.Tags')</a>
                                        @php
                                         $uniqueTags =[];
                                         $uniqueCat =[];
                                             foreach ($data['item'] as $key => $item) {
                                                foreach (array_unique(explode(",",$item->tags)) as $key => $value) {
                                                $uniqueTags[@$value]=@$value;
                                                $uniqueCat[@$item->category]=@$item->category;
                                                    }
                                                
                                            }
                                        @endphp
                                        
                                        <div class="catagori-submenu-area">
                                            <div class="catagori-submenu-inner">
                                                <span href="javascript:;" class="submenu-close"> <i class="ti-close"></i> </span>
                                                <div class="catagori-content">
                                                    <ul>                                  
                                                         @foreach ($uniqueTags as $val)   
                                                         @php
                                                         if (@$data['category']) {
                                                              $number=App\Models\ItemCounter::countByCategoryTag(@$data['category']->id,$val);
                                                         }else {
                                                              $number=App\Models\ItemCounter::countByTag($val);
                                                              $_cat_slug=App\Models\ItemCounter::getCatSlag($val);
                                                           
                                                         }
                                                         @endphp 
                                                          {{-- @dd($data['category']->slug) --}}
                                                             @if (@$val && @$number > 0) 
                                                               <li><a href="{{ @$data['sub_cat']? route('tagSubItem',[@$data['category']->slug,@$data['sub_cat']->slug,'tag',strtolower(str_replace(' ', '_',@$val))]) : route('tagCatItem',[@$data['category']->slug ? @$data['category']->slug:@$_cat_slug->slug,'tags',strtolower(str_replace(' ', '_',@$val))]) }}">{{@$val}}<span> ({{ @$number }})</span></a></li>                                                        
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
                                                            <button type="submit" id="price_submit">Filter</button>
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
                                                          
                                                       <li><a value="NoSell" id="NoSell">@lang('lang.no_sales') <span> ({{ @$data['no'] }})</span></a></li>
                                                        <li><a value="LowSell" id="LowSell">@lang('lang.low') <span> ({{ @$data['low'] }})</span></a></li>
                                                        <li><a value="MediumSell" id="MediumSell">@lang('lang.mudium') <span> ({{ @$data['medium'] }})</span></a></li>
                                                        <li><a value="HighSell" id="HighSell">@lang('lang.high') <span> ({{ @$data['high'] }})</span></a></li>
                                                        <li><a value="TopSell" id="TopSell">@lang('lang.top_seller') <span> ( {{ @$data['top'] }} )</span></a></li>
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
                                                         
                                                         <li><a onclick="Star(1)">@lang('lang.1_star_and_higher') <span> ({{ $data['oneStar'] }})</span></a></li>
                                                        <li><a onclick="Star(2)">@lang('lang.2_star_and_higher') <span> ({{ $data['TwoStar'] }})</span></a></li>
                                                        <li><a onclick="Star(3)">@lang('lang.3_star_and_higher') <span> ({{ $data['ThreStar'] }})</span></a></li>
                                                        <li><a onclick="Star(4)">@lang('lang.4_star_and_higher') <span> ({{ $data['FourStar'] }})</span></a></li>
                                                        <li><a onclick="Star(5)">@lang('lang.5_star_and_higher') <span> ({{ $data['FivStar'] }})</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    {{-- <li><a href="javascript:;">@lang('lang.date') @lang('lang.added')</a>
                                        <div class="catagori-submenu-area">
                                            <div class="catagori-submenu-inner">
                                                <span href="javascript:;" class="submenu-close"> <i class="ti-close"></i> </span>
                                                <div class="catagori-content">

                                                    <ul>
                                                       <li><a href="{{ @$data['sub_cat']? route('tagSubItem',[@$data['category']->slug,@$data['sub_cat']->slug,'date','anydate']) : route('tagCatItem',[@$data['category']->slug,'date','anydate'])}}">@lang('lang.any') @lang('lang.date')<span> ( {{$data['Any_Date']}} )</span></a></li>
                                                        <li><a href="{{ @$data['sub_cat']? route('tagSubItem',[@$data['category']->slug,@$data['sub_cat']->slug,'date','last_year']) : route('tagCatItem',[@$data['category']->slug,'date','last_year'])}}">@lang('lang.in_the_last') @lang('lang.year') <span> ({{ $data['LastYear'] }})</span></a></li>
                                                        <li><a href="{{ @$data['sub_cat']? route('tagSubItem',[@$data['category']->slug,@$data['sub_cat']->slug,'date','last_month']) : route('tagCatItem',[@$data['category']->slug,'date','last_month'])}}">@lang('lang.in_the_last') @lang('lang.month')<span> ({{ $data['Last_month']}})</span></a></li>
                                                        <li><a href="{{ @$data['sub_cat']? route('tagSubItem',[@$data['category']->slug,@$data['sub_cat']->slug,'date','last_week']) : route('tagCatItem',[@$data['category']->slug,'date','last_week'])}}">@lang('lang.in_the_last') @lang('lang.week') <span> ({{$data['Last_week']}})</span></a></li>
                                                        <li><a href="{{ @$data['sub_cat']? route('tagSubItem',[@$data['category']->slug,@$data['sub_cat']->slug,'date','last_day']) : route('tagCatItem',[@$data['category']->slug,'date','last_day'])}}">@lang('lang.in_the_last') @lang('lang.days') <span> ({{$data['Last_day']}})</span></a></li>
                                                    </ul> 
                                                </div>
                                            </div>
                                        </div>
                                    </li> --}}
                                   
                                    <li><a href="javascript:;">@lang('lang.software') @lang('lang.version')</a>
                                        <div class="catagori-submenu-area">
                                            <div class="catagori-submenu-inner">
                                                <span href="javascript:;" class="submenu-close"> <i class="ti-close"></i> </span>
                                                <div class="catagori-content">
                                                    <ul>
                                                        @foreach (@$data['item']->unique('software_version') as $item)
                                                          @php
                                                           if (@$data['category']) {
                                                              $software_version=App\Models\ItemCounter::ItemCount('category_id',@$data['category']->id,'software_version',$item->software_version);
                                                            //  $software_version = DB::table('items')->where('category_id',@$data['category']->id)->where('software_version',@$item->software_version)->get()->count(); 
                                                            }else {
                                                                $da=App\Models\ManageQuery::FindSubAttributes(@$item->software_version);
                                                                $software_version =App\Models\ManageQuery::ItemWithTitelVersion(@$data['key'],@$item->software_version);
                                                            }
                                                          @endphp 
                                                           @if ($item) 
                                                           <li><a href="{{ @$data['category']? route('dateItem',[@$data['category']->slug,'software_version',strtolower(str_replace(' ', '_',@$da->name))]) : route('dateItem',['software_version',strtolower(str_replace(' ', '_',@$da->name))])}}">{{ @$da->name }}<span> ({{ @$software_version  }})</span></a></li>
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
                                                               if (@$data['category']) {
                                                                $compatible_with =App\Models\ManageQuery::ItemCatWithCompatibleWith(@$data['category']->id,@$item->compatible_with);
                                                                //  DB::table('items')->where('category_id',@$data['category']->id)->where('compatible_with',@$item->compatible_with)->get()->count(); 
                                                                }else {
                                                                    $compatible_with =App\Models\ManageQuery::ItemCatWithCompatibleWith(@$data['category']->id,@$item->compatible_with);
                                                                    //  DB::table('items')->where('category_id',@$data['category']->id)->where('compatible_with',@$item->compatible_with)->get()->count(); 
                                                                    $da=App\Models\ManageQuery::FindSubAttributes(@$item->compatible_with);
                                                                    //  DB::table('sub_attributes')->find(@$item->compatible_with);
                                                                    $compatible_with =App\Models\ManageQuery::ItemWithTitelCompatible(@$data['key'],@$item->compatible_with);
                                                                    //  DB::table('items')->where('title','LIKE', '%'.@$data['key'].'%')->where('compatible_with',@$item->compatible_with)->get()->count(); 
                                                                }
                                                              @endphp
                                                                <li><a href="{{ @$data['category']? route('dateItem',[@$data['category']->slug,'compatible_with',strtolower(str_replace(' ', '_',@$da->name))]) : route('dateItem',['compatible_with',strtolower(str_replace(' ', '_',@$da->name))])}}">{{ @$da->name }}<span> ({{ @$compatible_with  }})</span></a></li>
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
                    <font> <button class="active">{{ @$data['tag'] }}</button></font>
                     @endif
                     @if(@$data['attribute'])
                     <font><button class="active">{{ @$data['attribute'] }}</button></font>
                     @endif
                     @if(@$data['key'])
                     <font><button class="active">{{@$data['key'] }}</button></font>
                     @endif
                     <font class="filter_cat_sale"></font>
                     <font class="filter_cat_rate"></font>
                     <font class="filter_cat_price"></font>
                </div>
                <div class="col-xl-6">
                    <div class="section-title mb-40">
                        <h3>@lang('lang.DiscoverOLDG')</h3>
                        <p>@lang('lang.product_header_sub_title')</p>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="portfolio-menu portfolio-menu2 text-xl-right text-lg-left text-sm-center">
                            <button class="active" value="all" id="all" data-filter="*">@lang('lang.all_items')</button>
                            <button data-filter=".cat1" value="bestsell" id="bestsell">@lang('lang.Best') @lang('lang.Sellers')</button>
                            <button data-filter=".cat2" value="newest" id="newest">@lang('lang.Newest')</button>
                            <button data-filter=".cat3" value="bestrated" id="bestrated">@lang('lang.Best') @lang('lang.Rated')</button>
                            <button data-filter=".cat4" value="trending" id="trending">@lang('lang.Trending')</button>
                            <button data-filter=".cat5" value="high" id="high">@lang('price') @lang('lang.High_to_Low')</button>
                            <button data-filter=".cat6" value="low" id="low">@lang('price') @lang('lang.Low_to_High')</button>
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
<script src="{{ asset('public/frontend/js/') }}/search.js"></script>

@endpush