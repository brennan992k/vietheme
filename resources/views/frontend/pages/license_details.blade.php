@extends('frontend.master')
@push('css')
    
@endpush
@section('content')

      <!-- banner-area start -->
    <div class="banner-area4">
        <div class="banner-area-inner">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="banner-info">
                            <h2>@lang('lang.license') @lang('lang.details')</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner-area end -->
    <!-- privaci_polecy_area start -->
    <div class="privaci_polecy_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 offset-xl-2 col-12">
                    <div class="privacy_inner gray-bg">
                       
     
                        <div class="single_privacy">
                            <h2>{{ @$about_company->heading_title }}</h2>
                            <span>{{ @$about_company->sub_title }}</span>
                            @if (!empty(@$about_company->image))
                                <img src="{{ url('/').'/'.@$about_company->image }}" alt="">
                            @endif
                            <br>
                            <br>
                            <p>{{   @$about_company->short_description }}</p>
                            <p>{!! @$about_company->description !!}</p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- privaci_polecy_area end -->
   
 @endsection
 @push('js')
     
<script src="{{ asset('public/frontend/js/') }}/package.js"></script>
 @endpush