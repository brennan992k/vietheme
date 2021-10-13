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
                            <h2>@lang('lang.terms') @lang('lang.&') @lang('lang.conditions')</h2>
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
                        @foreach ($term_conditions as $term_condition)
     
                        <div class="single_privacy">
                            <h2>{{ @$term_condition->heading_title }}</h2>
                            <span>{{ @$term_condition->sub_title }}</span>
                            
                            @if (!empty(@$term_condition->image))
                                <img class="mb-20 mt-20" width="780" height="auto" src="{{ url('/').'/'.@$term_condition->image }}" alt="">
                            @endif
                            
                            
                            <p>{{   @$term_condition->short_description }}</p>
                            <p>{!! @$term_condition->description !!}</p>
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