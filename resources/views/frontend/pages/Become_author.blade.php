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
                            <h2>@lang('lang.become_an') @lang('lang.author')</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner-area end -->

    <div class="privaci_polecy_area section-padding">
        <div class="container">
            <div class="row">
                    <div class="col-xl-8 offset-xl-2 col-12">
                  <div class="row">
                      <form action="javascript:;" method="POST" id="become_form">
                          @csrf
                      <div class="col-10">
                        {!! @$author_text->description!!}
                          <div class="row mt-5">
                              <div class="col-lg-10"><input type="checkbox" value="0"  id="tearms_"><label for="tearms_" class="ml-2"> @lang('lang.by_continuing_you_agree_to_the') <a href="javasrcipt:;">{{ GeneralSetting()->system_name }} @lang('lang.terms')</a></label></div>                                                                                     
                              <span class="invalid-feedback invalid-select ml-4 dm_display_block" role="alert">
                                  <strong id="Selectterms"></strong>
                              </span>
                         </div>
                         <div class="coupns-btn mt-5">
                            <button type="submit" onclick="BeAuthor()" class="boxed-btn">@lang('lang.continue')</button>
                        </div>
                      </div>
                    </form>
                  </div>
                    
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
<script src="{{ asset('public/frontend/js/') }}/ticket.js"></script>
@endpush