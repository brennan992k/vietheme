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
                            <h2>@lang('lang.privacy') @lang('lang.policy')</h2>
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
                        @foreach ($privacyPolicies as $privacy_policy)
     
                        <div class="single_privacy">
                            <h2>{{ @$privacy_policy->heading_title }}</h2>
                            <p class="mb-20">{{ @$privacy_policy->sub_title }}</p>
                            @if (!empty(@$privacy_policy->image))
                                <img class="mb-20" width="780" height="auto" src="{{ url('/').'/'.@$privacy_policy->image }}" alt="">
                            @endif
                            <p>{!! @$privacy_policy->description !!}</p>
                        </div>
                         @endforeach
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