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
                           <h2>@lang('lang.faq')</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner-area end -->
   <!-- faq_area_start -->
  
    <!-- faq_area_end -->
    <!-- faq_area_start -->
    <div class="faq_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-xl-10 offset-xl-1">
                    <div class="faq-_inner_area gray-bg">
                        <div class="row">

                        <div class="col-xl-6">
                             @foreach ($faqs_odd as $faq) 
                                    <div class="single_faq">
                                        <div id="accordion2">
                                            <div class="card">
                                                <div class="card-header" id="headingTwoo{{ @$faq->id }}">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                                            data-target="#collapseTwoo{{ @$faq->id }}" aria-expanded="false"
                                                            aria-controls="collapseTwoo{{ @$faq->id }}">
                                                            {{ @$faq->question_title }}</span>
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="collapseTwoo{{ @$faq->id }}" class="collapse" aria-labelledby="headingTwoo"
                                                    data-parent="#accordion">
                                                    <div class="card-body">
                                                            {{ @$faq->question_answer }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                 @endforeach
                            </div> 
                        
                            <div class="col-xl-6">
                              @foreach ($faqs_even as $faq) 
                                <div class="single_faq">
                                    <div id="accordion">
                                        <div class="card">
                                            <div class="card-header" id="headingTwo">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                                        data-target="#collapseTwo{{ @$faq->id }}" aria-expanded="false"
                                                        aria-controls="collapseTwo{{ @$faq->id }}">
                                                        {{ @$faq->question_title }}</span>
                                                    </button>
                                                </h5>
                                            </div>
                                        <div id="collapseTwo{{ @$faq->id }}" class="collapse" aria-labelledby="headingTwo"
                                                data-parent="#accordion">
                                                <div class="card-body">
                                                        {{ @$faq->question_answer }}
                                                </div>
                                            </div>
                                        </div>
 
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- faq_area_end -->
 @endsection
 @push('js')
     
<script src="{{ asset('public/frontend/js/') }}/package.js"></script>
 @endpush