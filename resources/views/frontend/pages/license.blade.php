@extends('frontend.master')
@push('css')
    
    <link rel="stylesheet" href="{{ asset('public/frontend/') }}/license.css">
@endpush
@php 
  $banner_coller = App\FrontSetting::where('active_status', 1)->first();
@endphp 
@section('content')

      <!-- banner-area start -->
    <div class="banner-area4">
        <div class="banner-area-inner">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="banner-info">
                            <h2>@lang('lang.license')</h2> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner-area end -->
    <!-- privaci_polecy_area start -->
    



    <div class="lisense_wrap">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="content-main" id="content">
  
                    <div class="grid-container">
                
                    <h2 class="t-heading">{{$data->heading}}</h2>

                    
                        <p class="t-body">
                          {{$data->heading_text}}
                        </p>
                
                        <div class="table_wrapper">
                          <table class="table-general" data-view="tableHighlightColumn" data-disable-first-column="true" data-selected-column="js-column-">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class="js-column-regular">
                                        <h3 class="t-heading">@lang('lang.regular')</h3>
                                        {{-- <a class="h_link" href="#">@lang('lang.view_full_license')</a> --}}
                                    </th>
                                    <th class="js-column-extended">
                                        <h3 class="t-heading">@lang('lang.extended')</h3>
                                        {{-- <a class="h_link" href="#">@lang('lang.view_full_license')</a> --}}
                                    </th>
                                </tr>
                            </thead>
                
                            <tbody>
                              @foreach ($license_features as $value)
                                <tr>
                                    <td class="text-left">{{@$value->feature_title}}</td>
                                    <td class="">
                                        @if (@$value->regular==1)
                                          <span class="e-icon -icon-ok -color-green"><i class="fa fa-check" aria-hidden="true"></i></span>
                                        @else
                                          <span class="e-icon -icon-cancel -color-red"><i class="fa fa-times" aria-hidden="true"></i></span>
                                        @endif
                                    </td>
                                    <td class="">
                                        @if (@$value->extended==1)
                                          <span class="e-icon -icon-ok -color-green"><i class="fa fa-check" aria-hidden="true"></i></span>
                                        @else
                                          <span class="e-icon -icon-cancel -color-red"><i class="fa fa-times" aria-hidden="true"></i></span>
                                        @endif
                                    </td>
                                </tr>
                              @endforeach
                            </tbody>
                        </table>
                        </div>

                
                        <h3 class="t-heading">{{$data->heading2}}:</h3>
                        <p class="t-body">
                          {{$data->heading2_text}}
                        </p>
              
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