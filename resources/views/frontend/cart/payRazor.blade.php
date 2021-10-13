@extends('frontend.master')
@section('content')
@php

    $system_logo = app('infix_background_settings');
   $logo = $system_logo[0];
@endphp
    <form action="{{ route('user.payment.razer')}}" method="POST" id='rozer-pay'>
        @csrf                                                        
        <script src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="{{ env('RAZOR_KEY') }}"
        data-amount={{ (int)Cart::subtotal()*100 }}
        data-buttontext=""
        data-name="{{str_replace('_', ' ',config('app.name') ) }}"
        data-description="Cart Payment"
        data-image="{{ asset(@$logo->image) }}"
        data-prefill.name= {{ @Auth::user()->username }}
        data-prefill.email= {{ @Auth::user()->email }}
        data-theme.color="#ff7529">
    </script>
    </form>
<script src="{{asset('public//frontend/js/payRazor.js')}}"></script>
@endsection