@extends('frontend.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('public/frontend/') }}/kn_base.css">
@endpush
@section('content')


  <!-- banner-area start -->
    <div class="banner-area4">
        <div class="banner-area-inner">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="banner-info">
                            <h2>@lang('lang.knowledge_base')</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner-area end -->

    <!-- knowledge_tabs_area start -->
    <div class="knowledge_tabs_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-xl-10 offset-xl-1">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4">
                            <div class="my_custom_navs gray-bg">
                                <h5>@lang('lang.knowledge_base') @lang('lang.Category')</h5>
                                <div class="nav flex-column" id="v-pills-tab" role="tablist"
                                    aria-orientation="vertical">
                                    @foreach ($know_base_categories as $key=> $category)  
                                        <a class="nav-link @if($key==0) show active @endif" id="v-pills-home-tab" data-toggle="pill"
                                            href="#v-pills-home{{ @$category->id }}" role="tab" aria-controls="v-pills-home"
                                            aria-selected="true">{{ @$category->name }}</a>
                                     @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8">
                            <div class="my_tab_content gray-bg">
                                <div class="tab-content" id="v-pills-tabContent">
                                     @foreach ($know_base_categories as $key=> $category)
                                    <div class="tab-pane fade  @if($key==0) show active @endif " id="v-pills-home{{ @$category->id }}" role="tabpanel"
                                        aria-labelledby="v-pills-home-tab">
                                        <div class="single_knowledge_tab accordion-container">
                                            <nav>
                                                <ul>
                                                  
                                                    @foreach ($category->firstQuestion as $title_question)
                                                    <li>
                                                        <div class="set">
                                                            <a>
                                                                {{ @$title_question->first_question }}
                                                            </a>
                                                            <div class="content">
                                                                <div id="accordion">
                                                                 
                                                                    @foreach ($title_question->secondQuestion as $sub_q_answer)
                                                                  
                                                                        <div class="card">
                                                                            <div class="card-header" id="heading{{ @$sub_q_answer->id }}">
                                                                                <h5 class="mb-0">
                                                                                    <button class="btn btn-link collapsed"
                                                                                        data-toggle="collapse"
                                                                                        data-target="#collapse{{ @$sub_q_answer->id }}"
                                                                                        aria-expanded="false"
                                                                                        aria-controls="collapse{{ @$sub_q_answer->id }}">
                                                                                    {{ @$sub_q_answer->sub_question }}
                                                                                    </button>
                                                                                </h5>
                                                                            </div>
                                                                            <div id="collapse{{ @$sub_q_answer->id }}" class="collapse"
                                                                                aria-labelledby="heading{{ @$sub_q_answer->id }}"
                                                                                data-parent="#accordion">
                                                                                <div class="card-body">
                                                                                    {!! @$sub_q_answer->answer !!}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- <hr> --}}
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </nav>
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
    </div>
    <!-- knowledge_tabs_area end -->
 @endsection
 @push('js')
   
<script src="{{ asset('public/frontend/js/') }}/package.js"></script>

 @endpush