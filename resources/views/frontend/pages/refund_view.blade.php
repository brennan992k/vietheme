@extends('frontend.master')
@push('css')
   <link rel="stylesheet" href="{{ asset('public/frontend/') }}/refund_view.css">
  
@endpush
@section('content')
@php
   $infix_general_settings = app('infix_general_settings');
@endphp
<input type="text" hidden  class="id" value="{{ Auth::user()->id}}">
    <!-- banner-area start -->
    <div class="banner-area4">
            <div class="banner-area-inner">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-xl-6">
                            <div class="banner-info knowledge_title">
                                <h2> @lang('lang.refund') @lang('lang.view')</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- banner-area end -->
    
        <!-- upload_area _start -->
        <div class="upload_area section-padding account-area account-area2">
            <div class="container">
                    <div class="satements_area">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="refunds_area">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="refund_wrap gray-bg">
                                                    <div class="refunds_info d-flex align-items-center">
                                                        <div class="refunds_thumb">
                                                            <img src="{{ asset( @$data['refund']->Item->thumbnail ) }}" alt="" width="100" height="100">
                                                        </div>
                                                        <div class="refund_head">
                                                            <h3>
                                                                <a href="{{url('/item/').'/'.@$data['refund']->Item->title.'/'.@$data['refund']->Item->id}}">{{ @$data['refund']->Item->title }} </a>
                                                            </h3>
                                                            <a class="iteam_details" href="{{url('/item/').'/'.@$data['refund']->Item->title.'/'.@$data['refund']->Item->id}}">@lang('lang.see') @lang('lang.item')
                                                               @lang('lang.details')</a>
                                                        </div>
                                                    </div>
                                                        @if ($data['refund']->status == 1)
                                                            <div class="action_waiting re_bak">
                                                                <span>
                                                                    <i class="fa fa-check" aria-hidden="true"></i>  @lang('lang.you_have_appproved_this_refund')
                                                                </span>
                                                            </div>
                                                            
                                                        @else
                                                        <div class="action_waiting">
                                                            <i class="ti-alarm-clock"></i>
                                                            <span>@lang('lang.awating') @lang('lang.your') @lang('lang.action')</span>
                                                       </div>
                                                        @endif
                                                        
                                                        
                                                    <div class="request_area">
                                                        <div class="single_resq">
                                                            <h3>@lang('lang.request') @lang('lang.sent')</h3>
                                                            <p>{{date("F d, Y", strtotime( @$data['refund']->created_at))  }} ({{DateFormat(@$data['refund']->created_at)}})</p>
                                                        </div>
                                                        <div class="single_resq">
                                                            <h3>@lang('lang.main') @lang('lang.Refund') @lang('lang.Reason')</h3>
                                                        <p>{{ @$data['refund']->RefundReason->name }}</p>
                                                        </div>
                                                        <div class="single_resq">
                                                            <h3>@lang('lang.Refund') @lang('lang.purchase') @lang('lang.date')</h3>
                                                            <p>{{date("F d, Y", strtotime( @$data['refund']->itemOrder->created_at))  }} ({{DateFormat(@$data['refund']->itemOrder->created_at)}})</p>
                                                        </div>
                                                        <div class="single_resq">
                                                            <h3>@lang('lang.download') @lang('lang.status')</h3>
                                                            <p> 
                                                                @if (@$data['refund']->itemOrder->download_status==1)
                                                                     @lang('lang.downloaded') 
                                                                @else
                                                                     @lang('lang.not') @lang('lang.downloaded')
                                                                
                                                                @endif
                                                                </p>
                                                        </div>
                                                        <div class="single_resq">
                                                            <h3>@lang('lang.Refund') @lang('lang.request') @lang('lang.number')</h3>
                                                        <p>1000{{ @$data['refund']->id}}</p>
                                                        </div>
                                                        <div class="single_resq">
                                                            <h3>@lang('lang.Price')</h3>
                                                            <p>{{@$infix_general_settings->currency_symbol}}{{@$data['refund']->itemOrder->subtotal}} (incl. author fee)</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="options_area">
                                                    <div class="otipn_top">
                                                        <h3>@lang('lang.What_are_my_Options')</h3>
                                                        <p>
                                                            @lang('lang.talk_to_the_buyer')
                                                            @lang('lang.if_not_make')
                                                        </p>
                                                    </div>
                                                    <div class="buyer_req">

                                                            <div class="otipn_top">
                                                                    <h3>@lang('lang.buyer') @lang('lang.request')</h3>
                                                                    <p>{{ @$data['refund']->RefundReason->name }}</p>   
                                                                    <p>{!! @$data['refund']->refund_details !!} <small  class="refund_view_option">{{ @$data['refund']->user->username }}</small></p>   
                                                                </div>
                                                        @if (isset($data['refund_comment']))
                                                          @foreach ($data['refund_comment'] as $item)

                                                            <div class="otipn_top">
                                                                    <h3>@lang('lang.your_comment')</h3>
                                                                    <p>{!! @$item->refund_comment !!} <small class="refund_view_option">{{ @$item->user->username }}</small></p>   
                                                                </div>

                                                          @endforeach  
                                                        @endif
                                                        <form action="{{ route('author.refundComment') }}" class="comnts" method="POST">
                                                           @csrf
                                                            <input type="text" hidden name="item_id" value="{{ @$data['refund']->item_id }}">
                                                            <input type="text" hidden name="to_name" value="{{ @$data['refund']->user->username}}">
                                                            <input type="text" hidden name="to_email" value="{{ @$data['refund']->user->email}}">
                                                            <span class="label">@lang('lang.comment')</span>
{{--                                                        <textarea name="refund_comment" id="summernote" cols="30" rows="10" placeholder="Write your comment here"></textarea>--}}
                                                            <textarea name="refund_comment" id="ticket_summernote"></textarea>
                                                            <button class="boxed-btn mt-3">@lang('lang.Reply_to_Comment')</button>
                                                        </form>
                                                        @if (@$data['refund']->status == 0)
                                                        <p class="or">@lang('lang.or')</p>                                                        
                                                        <div class="comnts-bt">
                                                                <div class="row">
                                                                    <div class="col-xl-6"><a href="javascript:void(0)"
                                                                            class="boxed-btn-red" onclick="decLine({{@$data['refund']->id}})">@lang('lang.decline') @lang('lang.Refund')</a>
                                                                    <a href="{{ route('author.refundDecline',$data['refund']->id) }}" id="decline-{{ @$data['refund']->id }}" hidden></a>
                                                                    </div>
                                                                    <div class="col-xl-6"><a href="javascript:void(0)"
                                                                            class="boxed-btn-gray text-black" onclick="Approve({{@$data['refund']->id}})">@lang('lang.give') @lang('lang.Refund')</a>
                                                                            <a href="{{ route('author.refundApprove',@$data['refund']->id) }}" id="Approve-{{ @$data['refund']->id }}" hidden></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
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
@endsection
@push('js')
<script src="{{ asset('public/frontend/js/') }}/refund.js"></script>
<script src="{{ asset('public/frontend/js/') }}/frontend_editor.js"></script>
@endpush