
@extends('frontend.master')
@push('css')
<link rel="stylesheet" href="{{ asset('public/frontend/package/') }}/style.css">

@endpush
@section('content')

<div class="banner-area4">
    <div class="banner-area-inner">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="banner-info">
                        <h2>@lang('lang.package_plan')</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="upload_area section-padding account-area account-area2">
    <div class="container">
        <div class="row">
             <div class="col-md-6">
                
             </div>
        </div>
    </div>
</div>

<section class="login-area  registration_area mt-25">
    <form action="{{ route('user.packagePaid') }}" name="registration" id="Pricing_pan_Buy" method="POST">
       @csrf 
        <input hidden type="text" value="{{ @$data->package_plan}}" name="package_id">
        <div class="container">
            <input type="hidden" id="url" value="{{url('/')}}">          
            
            <div class="row mt-30">
                <div class="col-lg-12">
                    <div class="text-center white-box single_registration_area">
                        <div class="reg_tittle">
                            <h5>@lang('lang.package') @lang('lang.details')</h5>
                        </div>
                        <div class="order_details_iner">
                                <div class="single_order_details">
                                    <p>@lang('lang.package') @lang('lang.name')</p>
                                <p>{{ @$package->packageType->name }}</p>
                                </div>
                                <div class="single_order_details">
                                    <p>@lang('lang.package') @lang('lang.time')</p>
                                    @if (@$data['package_price'] == @$packagetype->month)
                                       <p>@lang('lang.one') @lang('lang.month') </p>     
                                       @elseif(@$data['package_price'] == @$packagetype->half_year)                                   
                                       <p>@lang('lang.six') @lang('lang.month') </p>   
                                       @else  
                                       <p>@lang('lang.one') @lang('lang.year') </p>   
                                    @endif
                                </div>
                                <div class="single_order_details">
                                    <p>@lang('lang.total') @lang('lang.item')</p>
                                    <p>{{ @$package->total_item }}</p>
                                </div>
                                <div class="single_order_details">
                                    <p>@lang('lang.total') @lang('lang.price')</p>
                                    <p> ${{  @$data['package_price'] }} </p>
                                </div>
                        </div>
                    
                    </div>
                </div>
            </div>
            <div class="row mt-30">
                    <div class="col-lg-12">
                        <div class="text-center white-box single_registration_area">
                            <div class="reg_tittle">
                                <h5>@lang('lang.payment') @lang('lang.select')</h5>
                            </div>    
                            <div class="col-lg-12">
                                <div class="input_box_tittle">
                                    <h4>@lang('lang.payment_method')</h4>
                                    <div class="input-group d-block">
                                        <div class="d-flex">
                                            <div class="mr-30">
                                                <input type="radio" name="payment_type" id="_main_balance" value="main_" class="common-radio relationButton" checked >
                                                <label for="_main_balance">@lang('lang.main') @lang('lang.balance')</label>
                                            </div>
                                            <div class="mr-30">
                                                <input type="radio" name="payment_type" id="_Online" value="online_" class="common-radio relationButton">
                                                <label for="_Online">@lang('lang.payment') @lang('lang.online')</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mt-40" id="main_balance_on">
                                    <div class="main_balance">
                                            <div class="input-group">
                                               <input class="form-control" id="_package_price_payment" type="text" name='amount' value="{{ @$data['package_price'] }}" placeholder="Ex:$400"/>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="login_button text-center">
                                                    <a id="Paid_main_balance" class="primary-btn fix-gr-bg">
                                                        @lang('lang.submit')
                                                    </a>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-40 d-none" id="Online_payment">
                                    <div class="payment_wrap account_tabs_pin">
                                            <nav>
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <form action="{{ route('user.packagePayment')}}" method="POST" id="Package_payment_stripe">
                                                    @csrf
                                                    <li class="nav-item" onclick="StripePayment()">
                                                        <a class="nav-link active" id="payouts1-tab"
                                                            data-toggle="tab" href="#payouts1" role="tab"
                                                            aria-controls="home" aria-selected="true">
                                                            <div class="thumb_pak text-center">
                                                                <img class="img-fluid"
                                                                  src="{{ asset('public/frontend/') }}/img/account_settings/stripe-logo.png" alt="">
                                                                <p>@lang('lang.minimum_amount_$50.00')</p>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <input hidden value="{{@$data['package_price']  }}"  readonly="readonly" type="text" id="amount" name="amount">
                                                    <input hidden value="{{@$data['package_price']  }}"  readonly="readonly" type="text" id="package_plan_id" name="package_plan_id">
                                                    <input type="hidden" name="stripeToken" id="stripeToken" value="" /> 
                                                </form>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="payouts2-tab" data-toggle="tab"
                                                            href="#payouts2" role="tab" aria-controls="profile"
                                                            aria-selected="false">
                                                            <div class="thumb_pak text-center">
                                                                <img class="img-fluid"
                                                                    src="{{ asset('public/frontend/') }}/img/account_settings/paystack-logo.png" alt="">
                                                                <p>@lang('lang.minimum_amount_$50.00')</p>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="payouts3-tab" data-toggle="tab"
                                                            href="#payouts3" role="tab" aria-controls="contact"
                                                            aria-selected="false">
                                                            <div class="thumb_pak text-center">
                                                                <img class="img-fluid"
                                                                    src="{{ asset('public/frontend/') }}/img/account_settings/3.png" alt="">
                                                                <p>@lang('lang.minimum_amount_$50.00')</p>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </nav>
                                            <div class="tab-content border-1px-solid" id="myTabContent">
                                                    <div class="tab-pane fade show active" id="payouts1" role="tabpanel"
                                                        aria-labelledby="payouts1-tab">
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <div class="account_swift_maintain">
                                                                    <h2 class="comn-heading">@lang('lang.your_stripe_account')</h2>
                                                                        <div class="row">
                                                                            <div class="col-lg-12">

                                                                                    <form action="{{ route('user.packagePayment')}}" method="POST">
                                                                                            @csrf
                                                                                            <script
                                                                                                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                                                                                    data-key="{{ env('STRIPE_KEY') }}"
                                                                                                    data-name="Stripe Payment"
                                                                                                    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                                                                                    data-locale="auto"
                                                                                                    data-currency="usd">
                                                                                            </script>
                                                                                               <input hidden value="{{@$data['package_price']  }}"  readonly="readonly" type="text" id="amount" name="amount">
                                                                                               <input hidden value="{{@$data['package_plan']  }}"  readonly="readonly" type="text" id="package_plan_id" name="package_plan_id">
                                                                                        </form>
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                        </div>
    
                                                    </div>
                                                    <div class="tab-pane fade" id="payouts2" role="tabpanel"
                                                        aria-labelledby="payouts2-tab">
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <div class="account_swift_maintain">
                                                                    <h2 class="comn-heading">@lang('lang.payouts2_tab')</h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="payouts3" role="tabpanel"
                                                        aria-labelledby="payouts3-tab">
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <div class="account_swift_maintain">
                                                                    <h2 class="comn-heading">@lang('lang.payouts3_tab')</h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                            </div>
                        
                        </div>
                    </div>
            </div>
            <div class="row mt-30">
                    <div class="col-lg-12">
                        <div class="text-center white-box single_registration_area">
                            <div class="reg_tittle">
                                <h5>@lang('lang.order_details')</h5>
                            </div>
                            <div class="order_details_iner">
                                <div class="single_order_details">
                                    {{-- <p>24/7/365 Phone, LiveChat, Email Support</p>
                                    <p>FREE!</p> --}}
                                </div>
                                <div class="cupon_code">
                                    <div class="cupon_code_iner single_cupon_code">
                                    </div>
                                    <div class="total single_cupon_code">
                                            <div class="single_order_details">
                                                <p>@lang('lang.total') @lang('lang.price'):</p>
                                                <p id="total_p">${{ @$data['package_price']  }}</p>
                                                <input hidden value="{{@$data['package_price']  }}"  readonly="readonly" type="text" name="total">
                                            </div>
                                            <div class="single_order_details">
                                                    <p>@lang('lang.total') @lang('lang.paid')</p>
                                                    <p id="amount_due">
                                                    $@if (count(@$paid_payment) > 0)
                                                    {{ @$paid_payment->amount  }}
                                                    @else
                                                    {{count(@$paid_payment)}}
                                                    @endif
                                                      </p>
                                            </div>
                                            <div class="single_order_details">
                                                <p>@lang('lang.total') @lang('lang.Due')</p>
                                            <p id="amount_due">$
                                                    @if (count(@$paid_payment) > 0)
                                                    {{ @$paid_payment->amount - @$data['package_price']  }}
                                                    @else
                                                     <input type="text" hidden name="due_payment">
                                                     {{ @$data['package_price']  }}
                                                    @endif
                                               </p>
                                            </div>
                                            
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="row mt-40 mb-40">
                <div class="col-lg-12">
                    <div class="login_button text-center">
                        <button type="submit" class="primary-btn fix-gr-bg">
                            @lang('lang.Checkout') @lang('lang.Now')!
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>    
</section>


<!--================ Start End Login Area =================-->

@endsection
@push('js')
<script src="{{asset('public/frontend/js/item.js')}}"></script>
<script src="{{ asset('public/frontend/js/') }}/package.js"></script>
<script>
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script>
@endpush