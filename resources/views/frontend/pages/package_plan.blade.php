@extends('frontend.master')
@push('css')
    
@endpush
@php
   $infix_general_settings =app('infix_general_settings');
@endphp
@section('content')

    <!-- banner-area start -->
    <div class="banner-area4">
        <div class="banner-area-inner">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="banner-info">
                            <h2>@lang('lang.Pricing') @lang('lang.Plans')</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner-area end -->
    <!-- pricing_area_start -->
    <div class="pricing_area section-padding">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-xl-12">
                    <div class="section_title_2 text-center mb-77">
                        <h3>@lang('lang.Get_your_right_choice')</h3>
                        <p>@lang('lang.package_plan_page_subtitle') </p>
                       
                    </div>
                </div>
            </div>
            <div class="row">
              @foreach ($data['package'] as $item)
                <div class="col-xl-3 col-md-6">
                    <div class="single_pricing gray-bg text-center">
                        <div class="pricing_heading">
                        <h1>{{@$infix_general_settings->currency_symbol}}{{ @$item->packageType->month }}</h1>
                        
                            <span>@lang('lang.per_month')</span>
                        </div>
                        <div class="pricing_thumb">
                            <img src="{{ asset(@$item->image)}}" alt="">
                        </div>
                        <h3>{{ @$item->packageType->name }} @lang('lang.plan')</h3>
                        <ul>
                            <li>{!! @$item->description !!}</li>
                        </ul>
                        <a href="{{ route('user.packageOption',@$item->packageType->slug) }}" onclick="PackagePlan({{@$item->id}})" class="boxed-btn-white">@lang('lang.get_package')</a>
                    </div>
                </div>                  
              @endforeach
            </div>
        </div>
    </div>
    <!-- pricing_area_end -->
 @endsection
 @push('js')
     
<script src="{{ asset('public/frontend/js/') }}/package.js"></script>
 @endpush