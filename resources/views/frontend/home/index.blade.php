@extends('frontend.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/index_item.css">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/index_modal.css">

@endpush
@section('content')

@include('frontend.partials.banner')
@php 
$homepage = Modules\Pages\Entities\InfixHomePage::where('active_status', 1)->first();
@endphp 
<input type="hidden" id="url" value="{{url('/')}}">
<div class="features-area section-padding1" onscroll="OnScroll()">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 offset-xl-3">
                <div class="section-title text-center mb-70">
                <h3>{{$homepage->feature_title}}</h3>
                    {{-- <p>{{$homepage->feature_title_description}}</p> --}}
                    <h4>{{$homepage->feature_title_description}}</h4>
                </div>
            </div>
        </div>


        {{-- <div class="features_item_modal"></div> --}}
        <div class="row">
            <div class="col-xl-6 offset-xl-3">
                <div class="features-wrap " id="FeatureItem">

                </div>
            </div>
            <div class="col-lg-12">
                <div class="view-features text-center mt-80">
                   <a href="{{ route('feature_item')}}"  class="black-btn">@lang('lang.view_all_featured_products')</a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- features-area-end -->


@php
   $infix_general_settings = app('infix_general_settings');
@endphp




<!-- latest-goods-start -->
<div class="latest-goods-area gray-bg section-padding1" onscroll="OnScroll()">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-xl-6">
                <div class="section-title mb-40">
                    <h3>{{$homepage->product_title}}</h3>
                    {{-- <p>{{$homepage->product_title_description}}</p> --}}
                    <h4>{{$homepage->product_title_description}}</h4>
                </div>
            </div>
            <input type="hidden" id="currency_symbol" value="{{@$infix_general_settings->currency_symbol}}">
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
        <div class="row grid databox " id="databox">
        </div>
        <div class="row bt">
        </div>
    </div>
</div>

@if (@$free_items_count >0)
<!-- Free item Start -->
<div class="features-area section-padding1 pt-0" onscroll="OnScroll()">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 offset-xl-3">
                <div class="section-title text-center mb-70 mt-4">
                <h3>@lang('lang.free_product_of_the_month')</h3>
                    {{-- <p>{{$homepage->feature_title_description}}</p> --}}
                    <h4>{{$homepage->feature_title_description}}</h4>
                </div>
            </div>
        </div>


        {{-- <div class="free_item_modal"></div> --}}
        {{-- <div class="row justify-content-center">
            <div class="col-xl-6 d-flex justify-content-center">
                <div class="features-wrap" id="FreeItem">

                </div>
            </div>
            <div class="col-lg-12">
                <div class="view-features text-center mt-80">
                   <a href="{{ route('free_items')}}"  class="black-btn">View All Free Products</a>
                </div>
            </div>
        </div> --}}

         {{-- <div class="features_item_modal"></div> --}}
         <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="features-wrap d-flex justify-content-center" id="FreeItem">

                </div>
            </div>

            <div class="col-lg-12">
                <div class="view-features text-center mt-80">
                    <a href="{{ route('free_items')}}"  class="black-btn">@lang('lang.view_all_free_products')</a>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Free item end -->
@endif
@endsection
@push('js')
<script src="{{ asset('public/frontend/js/') }}/item_load.js"></script>
<script src="{{ asset('public/frontend/js/') }}/filter.js"></script>


@endpush