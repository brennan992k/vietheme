@extends('frontend.master')
@push('css')

<link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/dashboard.css">
<link rel="stylesheet" href="{{ asset('public/frontend/') }}/payment_selection.css">

<script src='https://js.stripe.com/v2/' type='text/javascript'></script>
<script src="{{ asset('/')}}public/frontend/js/jquery-3.3.1.js"></script>
@endpush
@section('content')

      <!-- banner-area start -->
    <div class="banner-area4">
        <div class="banner-area-inner">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="banner-info">
                            <h2>@lang('lang.fund_deposit')</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner-area end -->
    <!-- payment area start -->
    <div class="privaci_polecy_area section-padding checkout_area ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="deposite_payment_wrapper">
                        <!-- single_deposite_item  -->
                        @if( in_array('Stripe',$data))
                            <div class="single_deposite_item">
                                <div class="deposite_header text-center">
                                    {{__('Stripe')}}
                                </div>
                                <div class="deposite_button text-center"> 
                                    <form action="{{ route('user.stripe_deposit')}}" method="POST">
                                        @csrf
                                        <script
                                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                            data-key="{{ env('STRIPE_KEY') }}"
                                            data-name="Stripe Payment"
                                            data-image={{ asset(GeneralSetting()->logo) }}
                                            data-locale="auto"
                                            data-currency="usd">
                                        </script>
                                        <input hidden value="{{ Session::get('deposit_amount') }}"  readonly="readonly" type="text" id="amount" name="amount">
                                        <div class="mt-5 text-center mb-5">
                                            <button href="#" class="boxed-btn" type="submit">@lang('lang.make') @lang('lang.payment')</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif

                        @if( in_array('PayPal',$data))
                            <!-- single_deposite_item  -->
                            <div class="single_deposite_item">
                                <div class="deposite_header text-center">
                                    {{__('Paypal')}}
                                </div>
                                <div class="deposite_button text-center">
                                    <form action="{{ route('paypal_deposit')}}" method="POST">
                                        @csrf
                                        <input hidden value="{{ Session::get('deposit_amount') }}"  readonly="readonly" type="text" id="amount" name="amount">
                                        <div class="mt-5 text-center mb-5">
                                            {{-- <button href="#" class="boxed-btn" type="submit">@lang('lang.make') @lang('lang.payment')</button> --}}
                                            <input type="submit" name="submit" style="border: aliceblue;"  class="boxed-btn" value="@lang('lang.make') @lang('lang.payment')">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif

                        @if( in_array('Razorpay',$data)) 
                            <!-- single_deposite_item  -->
                            <div class="single_deposite_item">
                                <div class="deposite_header text-center">
                                    Razorpay
                                </div>
                                <div class="deposite_button text-center"> 
                                    <form action="{{ route('user.deposit_payment.razer')}}" method="POST">
                                        @csrf                                                       
                                        <script src="https://checkout.razorpay.com/v1/checkout.js"
                                                data-key="{{ env('RAZOR_KEY') }}"
                                                data-amount={{ (int)Session::get('deposit_amount')*100 }}
                                                data-buttontext=""
                                                data-name="{{str_replace('_', ' ',config('app.name') ) }}"
                                                data-description="Cart Payment"
                                                data-image="{{ asset(GeneralSetting()->logo) }}"
                                                data-prefill.name= {{ @Auth::user()->username }}
                                                data-prefill.email= {{ @Auth::user()->email }}
                                                data-theme.color="#531191">
                                        </script>
                                        <div class="mt-5 text-center mb-5">
                                                <button href="#" class="boxed-btn" type="submit">@lang('lang.make') @lang('lang.payment')</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif

                        @if( in_array('Bank',$data)) 
                            <!-- single_deposite_item  -->
                            <div class="single_deposite_item">
                                <div class="deposite_header text-center">
                                    Bank
                                </div>
                                <div class="deposite_button text-center">
                                    <div class="mt-5 text-center mb-5">
                                        <a href="#" data-toggle="modal" data-target="#exampleModal" class="boxed-btn">Make Payment</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div  class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Bank Payment </h5>
                                </div>
                                <form name="bank_payment" action=" {{ route('user.bank_payment')}} " class="single_account-form" method="POST" id=""  onsubmit="return validateForm()" >
                                    <div class="modal-body">
                                        @csrf
                                        {{-- {{ isset($bank_validator) ? 'show active' :''}} --}}
                                        <div class="row">
                                            <div class="col-xl-6 col-md-6">
                                                <label for="name" class="mb-2">@lang('lang.bank_name') <span>*</span></label>
                                                <input type="text" class="bank_deposit_input"  placeholder="Bank Name" name="bank_name" value="{{@old('bank_name')}}" >
                                                <span class="invalid-feedback" role="alert" id="bank_name"></span>
                                            </div>
                                            <div class="col-xl-6 col-md-6">
                                                <label for="name" class="mb-2">@lang('lang.name_of_account_owner') <span>*</span></label>
                                                <input type="text"  name="owner_name" class="bank_deposit_input"  placeholder="Name of account owner" value="{{@old('owner_name')}}">
                                                <span class="invalid-feedback" role="alert" id="owner_name"></span>
                                            </div> 
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-6 col-md-6">
                                                <label for="name" class="mb-2">@lang('lang.account_no') <span>*</span></label>
                                                <input type="text" class="bank_deposit_input"  placeholder="Account number" name="account_number" value="{{@old('account_number')}}" >                                             
                                                <span class="invalid-feedback" role="alert" id="account_number"></span> 
                                            </div>
                                            <div class="col-xl-6 col-md-6">
                                                <label for="name" class="mb-2">@lang('lang.amount') <span>*</span></label>
                                                <input type="number" step="any" min="0"  name="amount" class="bank_deposit_input"  placeholder="Amount"
                                                 value="{{ Session::get('deposit_amount') }}">
                                                <span class="invalid-feedback" role="alert" id="amount_validation"></span>
                                            </div>
                                        </div>
                                            @php
                                                $bank_setup=explode(',',$payment_methods->where('id',4)->first()->env_terms);
                                            @endphp
                                            <fieldset>
                                                <legend>Bank Account Info</legend>
                                                    <table class="table">
                                                        @foreach ($bank_setup as $setup)
                                                        
                                                            @php
                                                                $b_setup=explode(':',$setup);
                                                            @endphp
                                                            <tr>
                                                                <td><strong>{{str_replace('_',' ',@$b_setup[0])}}</strong> </td>
                                                                <td>{{@$b_setup[1]}}</td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                            </fieldset>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-between">
                                        <button type="button" class="boxed-btn-white " data-dismiss="modal">@lang('lang.cancel')</button>
                                        <button class="boxed-btn" type="submit">@lang('lang.make') @lang('lang.payment')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                     
                </div>
            </div>
        </div>
    </div>
    
    <!-- payment area end -->
   
 @endsection
 @push('js')
 <script src="{{ asset('public/frontend/js/') }}/fund_add.js"></script>
 <script src="https://checkout.stripe.com/checkout.js"></script>
 <script src="{{ asset('/')}}public/frontend/js/v_4.4_jquery.form.js"></script>
<script src="{{ asset('public/frontend/js/') }}/payment_section.js"></script>


 @endpush