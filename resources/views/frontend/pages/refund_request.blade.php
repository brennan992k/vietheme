@extends('frontend.master')
@push('css')


    <link rel="stylesheet" href="{{ asset('public/frontend/') }}/refund_req.css">
  
@endpush
@section('content')

    <!-- banner-area start -->
    <div class="banner-area4">
        <div class="banner-area-inner">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="banner-info">  
                            <h2>@lang('lang.request_refund')</h2>
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
          {{--   <div class="row d-flex align-items-center">
                <div class="col-xl-12">
                    <div class="section_title_2 text-center mb-77">
                        <p>@lang('lang.Please detail the reason you are requesting a refund.
                            If you are having trouble with an item you can find out how to get help here.')</p>
                       
                    </div>
                </div>
            </div> --}}
            <div class="row justify-content-center">
                
                <div class="col-xl-8 col-lg-8">
                    @if (count($data['item_order']) > 0)                     
                <form action="{{ route('user.refundStore')}}" class="checkout-form" id="refund_store" method="POST" enctype="multipart/form-data">
                       @csrf
                        <div class="col-xl-12 col-md-12 ">
                            <label for="name">@lang('lang.choose') @lang('lang.your') @lang('lang.purchase') *</label>
                            <select class="wide state customselect "
                                 name="item_id">
                                <option data-display="" value="">@lang('lang.select')</option>
                               @foreach ($data['item_order'] as $item)
                               @php
                                if (in_array($item->order_id, $data['refunds_list']))
                                    {
                                    continue;
                                    }
                                @endphp  
                                   <option value="{{ @$item->order_id }}" {{ @$item->item_id== old('item_id') }}>{{ @$item->Item->title  }}</option>
                               @endforeach
                            </select><br>
                            <small>@lang('lang.submit_separate')</small>
                            @if ($errors->has('item_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('item_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-xl-12 col-md-12 mt-4">
                            <label for="name">@lang('lang.main_reason') *</label>
                            <select class="wide state customselect "
                                 name="ref_id" id="state">
                                <option data-display="Select" value="">@lang('lang.select')</option> 
                                @foreach ($data['refund'] as $item)
                                   <option value="{{ @$item->id }}" {{ @$item->item_id== old('ref_id') }}>{{ @$item->name  }}</option>
                               @endforeach
                            </select><br>
                            <small>@lang('lang.reason_request')</small>
                            @if ($errors->has('ref_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('ref_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-xl-12 col-md-12 mt-4 ml-1">
                                <label for="name">@lang('lang.describe_details') *</label><br>
                                <textarea name="refund_details" id="editor1" ></textarea>

                                @if ($errors->has('refund_details'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('refund_details') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-xl-12 col-md-12 mt-4 mb-5 text-right">
                                <button type="submit" class="boxed-btn">@lang('lang.send_request')</button>
                        </div>
                    </form>
                    @else

                    <div class="col-xl-12 col-md-12 mb-5 text-center">
                            <h3>@lang('lang.dont_item') @lang('lang.purchase')</h3>
                         </div>
                    @endif
            </div>
        </div>
    </div>
    </div>
    <!-- pricing_area_end -->
 @endsection
 @push('js')

 <script src="{{ asset('public/frontend/js/') }}/refund.js"></script>
 <script src="{{ asset('public/frontend/js/') }}/frontend_editor.js"></script>

 @endpush