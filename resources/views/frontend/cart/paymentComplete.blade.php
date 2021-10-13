@extends('frontend.master')
@push('css') 
<link rel="stylesheet" href="{{ asset('public/frontend/') }}/payment_complete.css">
@endpush
@section('content')
@php
   $infix_general_settings =app('infix_general_settings');
@endphp
           <!-- banner-area start -->
           <div class="banner-area4">
            <div class="banner-area-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="banner-info">
                                <div class="payment_comfirmation_header">
                        <div class="payment_confirm_header">
                            <div class="payment_logo">
                                <img src="{{asset('public/uploads/img/cart/write2.png')}}" alt="">
                            </div>
                        </div>
                        <div class="conformation-title">
                                <h2>@lang('lang.payment_complete')!</h2>
                                <p>@lang('lang.an_confirmation_email_is_coming_your_way') <br>
                                    @lang('lang.this_item_is_now_available_on_your') 
                                    @if (Auth::user()->role_id == 4)
                                    <a href="{{ route('author.download',@Auth::user()->id) }}">@lang('lang.download') @lang('lang.page')</a> 
                                    @endif
                                    @if (Auth::user()->role_id == 5)
                                    <a href="{{ url('downloads/'.@Auth::user()->username) }}">@lang('lang.download') @lang('lang.page')</a> 
                                    {{-- <a href="{{ route('customer.profile',@Auth::user()->username) }}">Download page</a>  --}}
                                    @endif

                                </p>
                        </div>
                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- banner-area end -->

    <!-- payment_confirm_start    -->
    <div class="payment_confim_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-xl-10 offset-xl-1">
                    
                    <div class="payment_confirm_prise_wrap gray-bg">
                        <div class="payment_confirm_prise_header d-flex justify-content-between align-items-center">
                            <h4>@lang('lang.your_order')</h4>
                           {{--  <span> <a href="javascript:;">Install for $50</a>
                            </span> --}}
                        </div>

                        @foreach ($data['order'] as $value)
                            @foreach ($value->itemOrder as $item)  
                            @php
                             $obj = json_decode(@$item->item, true);
                           @endphp 

                            <div class="payment_wrap_body">
                                <div class="row">
                                    <div class="col-xl-6 col-md-7">
                                        <div class="single-confirmation d-flex align-items-center">
                                            <div class="payment_wrap_thumb">
                                                <img src="{{asset(@$obj['icon'])}}" alt="" width="80" height="80">
                                            </div>
                                            
                                            <div class="payment_info">
                                                    <h5> <a href="{{ route('singleProduct',[str_replace(' ', '-',$item->Item->title),$item->Item->id]) }}">{{ @$item->Item->title }}</a> </h5>
                                                    <p>@lang('lang.item_by') <a href="#">{{@$obj['username']}}</a> </p>
                                                    <p>@lang('lang.license'): <a href="#"> 
                                                        {{-- {{ @$obj['license_type'] == 1?'Regular':'Extended'}} --}}
                                                        @if (@$obj['license_type']== 1)
                                                                @lang('lang.Regular')
                                                            @elseif(@$obj['license_type']== 2)
                                                                @lang('lang.extended')
                                                            @else
                                                                @lang('lang.commercial')
                                                            @endif
                                                            @lang('lang.License')</a></span>
                                                    </a> </p>
                                                    <p>@lang('lang.Support'): <a href="#"> {{ @$obj['support_time'] == 1?'6 Months':'12 Mohths'}} @lang('lang.license')</a> </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-5">
                                        <div class="payment_btn_prise d-flex align-items-center">
                                            @if (Auth::user()->role_id == 4)
                                                <a class="boxed-btn" href="{{ route('user.ItemDownloadAll',@$item->order_id) }}">@lang('lang.download')</a> 
                                            @endif
                                            @if (Auth::user()->role_id == 5)
                                                <a class="boxed-btn" href="{{ route('user.ItemDownloadAll',@$item->order_id) }}">@lang('lang.download')</a> 
                                            @endif
                                             {{-- <a href="{{ @$item->Item->category->productSetting->url }}" target="_blank" class="boxed-btn-white">{{ isset($item->Item->category->productSetting) ?  $item->Item->category->productSetting->title .' '. GeneralSetting()->currency_symbol .''. $item->Item->category->productSetting->amount :''}}</a> --}}
                                            <div class="net_prise">
                                                <span>@lang('lang.price')</span>
                                                <h3>{{@$infix_general_settings->currency_symbol}}{{ @$item->subtotal }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection