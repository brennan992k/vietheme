@extends('frontend.master')
@push('css')
<link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/item.css">
<link rel="stylesheet" href="{{ asset('public/frontend/') }}/single_item.css">
@endpush
@php
$infix_general_settings = GeneralSetting();
@endphp

@section('content')
@include('frontend.partials.itemHeader')
<!-- details-tablist-start -->
@php
use Carbon\Carbon;
$dt     = Carbon::now();
$img = explode(",",@$data['item']->item_image->image);
if (Str::contains($_SERVER['REQUEST_URI'], 'mail-sent')) {
$overview='';
$overview_content='';
$support='active';
$support_content='active show';
$comment='';
$comment_content='';
} else if(Str::contains($_SERVER['REQUEST_URI'], 'comment')) {
$overview='';
$overview_content='';
$support='';
$support_content='';
$comment='active';
$comment_content='active show';
}else{
$overview='active';
$overview_content='active show';
$support='';
$support_content='';
$comment='';
$comment_content='';
}
@endphp
<div class="details-tablist-area">
   <div class="container">
      <div class="row">
         <div class="col-xl-10 offset-xl-1">
            <div class="details-tablist">
               <nav>
                  <ul class="nav" id="myTab" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link {{ $overview}}" id="home-tab" data-toggle="tab" href="#home" role="tab"
                           aria-controls="home" aria-selected="true">@lang('lang.overview')</a>
                     </li>
                     <li class="nav-item ">
                        <a class="nav-link {{ $comment}}" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                           aria-controls="profile" aria-selected="false">@lang('lang.comments')</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                           aria-controls="contact" aria-selected="false">@lang('lang.reviews')</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link {{ $support}}" id="Support-tab" data-toggle="tab" href="#Support" role="tab"
                           aria-controls="contact" aria-selected="false">@lang('lang.Support')</a>
                     </li>
                     @if (Auth::user())
                     @if ( @$data['item']->user->id == Auth::id() || @Auth::user()->role_id == 1 || @$item->feedback_user->id == Auth::id())                                           
                     {{-- <li class="nav-item">
                        <a class="nav-link" id="Support-tab" data-toggle="tab" href="#History" role="tab"
                           aria-controls="contact" aria-selected="false">@lang('lang.history')</a>
                     </li> --}}
                     @endif
                     @endif
                  </ul>
               </nav>
            </div>
         </div>
      </div>
   </div>
</div>
<style>
   .over_view_thumb{
      background-image: url({{ file_exists(@$data['item']->thumbnail) ? asset(@$data['item']->thumbnail) : asset('public/uploads/product/thumbnail/thumbnail-demo.png') }} );
   }
</style>
<!-- details-tablist-end -->
<!-- main-details-area-start -->
<div class="main-details-area section-padding">
   <div class="container">
      <div class="row">
         <div class="col-xl-10 offset-xl-1 col-lg-12">
            <div class="row">
               <div class="col-xl-8 col-lg-7">
                  <div class="main-tab-content">
                     <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade {{$overview_content}}" id="home" role="tabpanel"
                           aria-labelledby="home-tab">
                           <div class="overview">
                              <div class="over_view_thumb">
                                 {{-- <img height="400"  src="{{ file_exists(@$data['item']->thumbnail) ? asset(@$data['item']->thumbnail) : asset('public/uploads/product/thumbnail/thumbnail-demo.png') }} " alt=""> --}}
                                 <div class="overlay_with_btn">
                                    <div class="overlay_inner">
                                       <a class="boxed-btn" target="_blank" href="{{ @$data['item']->demo_url }}">@lang('lang.live_review')</a>
                                       <button class="boxed-btn-white"  onclick="ImgShow()">@lang('lang.screenshoot')</button>
                                       @foreach ($img as $key => $item)
                                       @if ($key != 0)
                                       <a class="popup-image hit" href="{{ asset(@$item)}}"></a>
                                       @endif
                                       @endforeach 
                                    </div>
                                 </div>
                              </div>
                              <div class="over_view_info">
                                 {{-- 
                                 <h4>@lang('lang.overview')</h4>
                                 --}}
                                 <p>{!! @$data['item']->description !!}</p>
                              </div>
                              {{-- 
                              <div class="features_info">
                                 <h4>@lang('lang.Features')</h4>
                                 <ul>
                                    <li>
                                       <p>{{ @$data['item']->feature1}}</p>
                                    </li>
                                    <li>
                                       <p>{{ @$data['item']->feature2}} </p>
                                    </li>
                                 </ul>
                              </div>
                              --}}
                              {{--    @foreach ($img as $key => $item)
                              @if ($key != 0)
                              <div class="over_view_thumb mt_40">
                                 <img src="{{ asset(@$item)}}" alt="">
                              </div>
                              @endif
                              @endforeach --}}
                           </div>
                        </div>
                        <div class="tab-pane fade {{$comment_content}}" id="profile" role="tabpanel"
                           aria-labelledby="profile-tab">
                           <div class="comments_wrap">
                              @if(session()->has('success'))
                              <div class="alert alert-success">
                                 {{ session()->get('success') }}
                              </div>
                              @endif
                              
                              @if (isset($data['item']->comments))
                                @if ( $data['item']->comments->count()==0)
                                    <h3>@lang('lang.there_are_no_comments_for_this_item_yet').</h3>
                                @else
                                    @foreach ($data['item']->comments as $item)
                                        <div class="single_comment  d-flex justify-content-between gray-bg">
                                            <div
                                                class="comment_author d-flex align-items-center justify-content-center">
                                                <div class="comments_thumb">
                                                <img src="{{ @$item->user->profile->image? asset(@$item->user->profile->image): asset('public/uploads/img/theme-details/comments/1.png')}}" alt="" width="80" height="auto">
                                                </div>
                                                <div class="author_name">
                                                <h4> {{ @$item->user->username}} {!! GetPurchaseStatus(@$item->user->id,$data['item']->id ) !!}
                                                 </h4>
                                                <p>{{ @$item->body }}</p>
                                                </div>
                                            </div>
                                            <div class="date_ago">
                                                {{ DateFormat(@$item->created_at) }}
                                            </div>
                                        </div>
                                        @if (@$item->replies)
                                                @foreach ($item->replies as $val)
                                                <div class="single_comment  d-flex justify-content-between gray-bg ml-40">
                                                    <div
                                                        class="comment_author d-flex align-items-center justify-content-center">
                                                        <div class="comments_thumb">
                                                        <img src="{{ @$val->user->profile->image? asset(@$val->user->profile->image): asset('public/uploads/img/theme-details/comments/1.png')}}" alt=""  width="80" height="auto">
                                                        </div>
                                                        <div class="author_name">
                                                        <h4><a href="{{ route('user.portfolio',@$val->user->username)}}">{{ @$val->user->username}}</a> <span class="author-tag">@lang('lang.author')</span></h4> 
                                                        <p>{{ @$val->body }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="date_ago">
                                                        {{ DateFormat(@$val->created_at)}}
                                                    </div>
                                                </div>
                                                @endforeach
                                        @endif
                                        @if (@Auth::user()->role_id  == 4 && @$data['item']->user_id == @Auth::user()->id)
                                        <div class="single_comment  gray-bg ml-40">
                                            <div class="comment_author d-flex">
                                                <div class="comments_thumb">
                                                <img src="{{ @Auth::user()->profile->image? asset(Auth::user()->profile->image): asset('public/uploads/img/theme-details/comments/1.png')}}" alt="" width="80" height="auto">
                                                </div>
                                                <div class="replay_boxs">
                                                <form action="{{ route('user.reply') }}" method="POST" id="ReplyID">
                                                    @csrf
                                                    <input type="text" hidden name="item_id" value="{{@$data['item']->id }}">
                                                    <input type="text" hidden name="user_id" value="{{@$data['item']->user_id }}">
                                                    <input type="text" hidden name="parent_id" value="{{@$item->id }}">
                                                    <textarea name="body" id="body" cols="30" rows="10"></textarea>
                                                    <button class="boxed-btn mt-10" type="submit">@lang('lang.Replay')</button>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endif 
                                    @endforeach
                                @endif
                                
                              @endif
                              <div class="comments_form">
                                 <p>@lang('lang.Leave_a_comment')</p>
                                 <form action="{{ route('user.comment') }}" method="POST" id="commentID">
                                    @csrf
                                    <input type="text" hidden name="item_id" value="{{@$data['item']->id }}">
                                    <textarea name="body" id="body" cols="30" rows="10"></textarea>
                                    <button class="boxed-btn" type="submit">@lang('lang.Post') @lang('lang.comment')</button>
                                 </form>
                              </div>
                           </div>
                        </div>
                        
                        <div class="tab-pane fade" id="contact" role="tabpanel"
                           aria-labelledby="contact-tab">

                           @if (@$data['item']->reviews)   
                           
                        @if (@$data['item']->reviews->count() != 0)
                            @foreach ($data['review'] as $review) 
                              
                           <div class="review_area">
                              <div class="review_header d-flex justify-content-between">
                                 <div class="review_author d-flex align-items-center">
                                    <div class="review_thumb">
                                       <img src="{{ @$review->user->profile->image? asset(@$review->user->profile->image): asset('public/uploads/img/theme-details/comments/1.png')}}" alt="" width="80" height="auto">
                                    </div>
                                    <div class="author_name">
                                       <h4>{{ @$review->user->username}}</h4>
                                       <p>{{ DateFormat(@$review->created_at)}}</p>
                                    </div>
                                 </div>
                                 <div class="review_rating">
                                    <h4>{{@$review->reviewType->name}} ({{ @$review->rating}})</h4>
                                    @if(@$review->rating == .5)
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    @elseif(@$review->rating == 1)
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    @elseif(@$review->rating == 1.5)
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    @elseif(@$review->rating == 2)
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    @elseif(@$review->rating == 2.5)
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    @elseif(@$review->rating == 3)
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    @elseif(@$review->rating == 3.5)
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    @elseif(@$review->rating == 4)
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    @elseif(@$review->rating == 4.5)
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                    @elseif(@$review->rating == 5)
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    @endif
                                 </div>
                              </div>
                              <div class="review-text">
                                 <p>{{ @$review->body}}</p>
                              </div>
                           </div>
                           @endforeach
                        @else
                            <h3>@lang('lang.no_review_available')</h3>
                        @endif

                           @endif
                        </div>
                        
                        <div class="tab-pane fade {{$support_content}}" id="Support" role="tabpanel"
                           aria-labelledby="Support-tab">
                           @if(session()->has('success'))
                           <div class="alert alert-success">
                              {{ session()->get('success') }}
                           </div>
                           @endif
                           <div class="support_info_area">
                              <div
                                 class="support_info d-flex justify-content-between align-items-center gray-bg">
                                 <div class="support_info_inner d-flex align-items-center">
                                    <div class="logo-img">
                                       <img src="{{ @$data['item']->user->profile->image? asset(@$data['item']->user->profile->image): asset('public/uploads/img/theme-details/comments/1.png')}}" alt="" width="80" height="auto">
                                    </div>
                                    <div class="support_text">
                                       <h4>{{ @$data['item']->user->username}} @lang('lang.Supports_this_item') </h4>
                                       <p>@lang('lang.author_response_time_message') </p>
                                    </div>
                                 </div>
                                 @if (@Auth::check())                                                                                                                                         
                                    <a href="{{ url('user.UserSupport') }}" class="boxed-btn" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">@lang('lang.go_to_item_Support')</a>
                                 @else
                                    <a href="{{ url('customer/login') }}" class="boxed-btn">@lang('lang.go_to_item_Support')</a>
                                 @endif
                              </div>
                              {{-- 
                              <div class="support_Question">
                                 <h3>@lang('lang.pqfthi')</h3>
                                 <h4>Missing style sheet error when installing the theme</h4>
                                 <p>A common issue that can occur with users new to installing WordPress
                                    themes is a "Broken theme and/or stylesheets missing” error message
                                    being displayed when trying to upload or activate the theme. This
                                    error message does not mean that the theme you have purchased is
                                    broken, it simply means it has been uploaded incorrectly. <a
                                       href="#"> Luckily, there is a very easy fix.</a> 
                                 </p>
                              </div>
                              --}}
                              <div class="support_contact gray-bg">
                                 <div class="support_contact-heading">
                                    <h4>@lang('lang.Contact_the_author')</h4>
                                    <p>@lang('lang.this_author_will_respond')</p>
                                 </div>
                                 <div class="support_single_contact boder-top-bottom">
                                    @php
                                    // $item_support=DB::table('item_supports')->first();
                                    @endphp
                                    {!! $item_support->description !!}
                                 </div>
                                 <div class="support_single_contact">
                                    {!! $item_support->sort_description !!}
                                 </div>
                                 <div
                                    class="support_view d-flex justify-content-between align-items-center mt-10 d-sm-block">
                                    {{-- <p>@lang('lang.view_the') <a class="underline_link" href="#">@lang('lang.item_support_policy')</a></p> --}}
                                    @if (@Auth::check())                                                                                                                                         
                                    <a href="{{ route('user.UserSupport') }}" class="boxed-btn" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">@lang('lang.go_to_item_Support')</a>
                                    @else
                                    <a href="{{ url('customer/login') }}" class="boxed-btn">@lang('lang.go_to_item_Support')</a>
                                    @endif
                                 </div>
                                 @if (@Auth::check())    
                                 <div  class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalLabel">@lang('lang.send_an_email_to_the_author') </h5>
                                          </div>
                                          <form action="{{ route('user.UserSupport') }}" method="POST" id="Text_support">
                                             <div class="modal-body">
                                                @csrf
                                                <div class="_form">
                                                   <span for="recipient-name" class="col-form-label">@lang('lang.from'):</span>
                                                   <p  class="from_mail" id="recipient-name">{{Auth::user()->email}}</p>
                                                   <p class="email_alert">@lang('lang.your_email address_recipeint')</p>
                                                </div>
                                                <div class="_form text_area" >
                                                   <span for="message-text" class="col-form-label">@lang('lang.message'):</span>
                                                   <input type="text" hidden value="{{ @$data['item']->id }}" name="item_id">
                                                   <textarea class="" id="message-text" name="message"></textarea>
                                                </div>
                                                <p class="messsege_ward_lemit">
                                                   @lang('lang.all_messege_are_recorded') <strong>5000</strong>
                                                </p>
                                             </div>
                                             <div class="modal-footer d-flex justify-content-between">
                                                <button type="button" class="boxed-btn-white " data-dismiss="modal">@lang('lang.cancel')</button>
                                                <button type="submit" class="boxed-btn">@lang('lang.send') @lang('lang.message')</button>
                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                 </div>
                                 @endif
                              </div>
                           </div>
                        </div>
                        @if ( @$data['item']->user->id == Auth::id() || @Auth::user()->role_id == 1 || @$item->feedback_user->id == Auth::id())   
                        <div class="tab-pane fade" id="History" role="tabpanel"
                           aria-labelledby="profile-tab">
                           <div class="comments_wrap">
                              @if (@$data['item']->feedback)
                              @foreach (@$data['item']->feedback as $item)   
                              <div class="single_comment  d-flex justify-content-between gray-bg">
                                 <div class="comment_author d-flex align-items-center justify-content-center">
                                    <div class="comments_thumb">
                                       <img src="{{ @$item->feedback_user->profile->image? asset(@$item->feedback_user->profile->image): asset('public/uploads/img/theme-details/comments/1.png')}}" alt="" width="80" height="auto">
                                    </div>
                                    <div class="author_name">
                                       <h4>{{ @$item->subject}}</h4>
                                       <p>{!! @$item->feedback !!}</p>
                                       <div class="date_ago">{{DateFormat(@$item->created_at)}}</div>
                                    </div>
                                 </div>
                              </div>
                              @endforeach
                              @endif
                           </div>
                        </div>
                        @endif
                     </div>
                  </div>
               </div>
               
               <div class="col-xl-4 col-lg-5">
                  <div class="theme-side-bar-wrap">
                     @if (@$data['item']->free == 1)
                     <div class="theme-side-bar gray-bg mb-5">
                        <div class="single-side-bar">
                           @if (Auth::check())
                           <div >
                              <a class="boxed-btn w-100" href="{{ route('user.FreeItemDownloadAll',@$data['item']->id) }}" >@lang('lang.download') </a>
                              {{--  
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                 <a class="dropdown-item" href="{{ route('user.FreeItemDownloadAll',@$data['item']->id) }}">All files & documentation</a>
                                 <a class="dropdown-item" href="{{ route('user.FreeProductDownload',@$data['item']->id) }}">Installable file only</a>
                                 <a class="dropdown-item" href="{{ route('user.FreeLicenceDownload',@$data['item']->id) }}">License certificate & purchase code (pdf)</a>
                              </div>
                              --}}
                           </div>
                           @else                                                        
                           <a href="{{ url('customer/login') }}"  class="boxed-btn w-100" id="BuyCart">@lang('lang.sign_in_to_download_it_for_free')</a>
                           @endif                                                    
                           <div class="light-lisence-wrap pt-3">
                              <div class="light-pakage-list">
                                 <ul>
                                    <li>
                                       <p>@lang('lang.this_is_free_item_file_of_the_month') {{date('M')}} !
                                          @lang('lang.by_downloading_this_item')
                                       </p>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                     @endif
                     <div class="theme-side-bar gray-bg">
                        <div class="single-side-bar">
                           <div
                              class="side-bar-heading d-flex justify-content-between align-items-center mt-2">
                              {{-- <h4> <span id="license_type">@lang('lang.Regular') @lang('lang.License')</span>  <i class="ti-angle-down licenseShow" ></i> </h4>
                              <span class="Reg_total" id="Reg_total">{{@$infix_general_settings->currency_symbol}}{{ @$data['item']->Reg_total}}</span>
                              <input type="text" class="_total" id="_total" value="{{ @$data['item']->Reg_total}}" hidden>
                              <input type="hidden" value="{{@$infix_general_settings->currency_symbol}}" id="currency_symbol"> --}}
                              <h4> @lang('lang.License') @lang('lang.type') <small><a href="{{url('/license')}}">What are these?</a></small> </h4> 
                           </div>
                           <form action="{{ route('AddBuy') }}" method="POST">
                              @csrf
                              <div class="light-lisence-wrap">
                                 <div class="light-pakage-list">
                                    {{-- {!! $item_support->long_description !!} --}}
                                    <input type="hidden" id="support_fees" value="{{$data['fees']->support_fee}}">
                                    <ul id="license_list">
                                       <li>
                                          <div class="row">
                                             <div class="col-lg-2">
                                                <input type="hidden" id="normal_regular_price" value="{{ @$data['item']->Reg_total}}">
                                                <input type="radio" data-type="regular_license_price" data-normal="normal_regular_price" checked name="list_item_price" value="{{ @$data['item']->Reg_total}}">
                                             </div>
                                             <div class="col-lg-6"> <strong>@lang('lang.Regular')</strong> </div>
                                             <div class="col-lg-4"> <strong class="float-right">{{@$infix_general_settings->currency_symbol}} <span id="regular_license_price">{{ @$data['item']->Reg_total}}</span></strong> </div>
                                          </div>
                                       </li>
                                       <li>
                                          <div class="row">
                                             <div class="col-lg-2">
                                                <input type="hidden" id="normal_commercial_price" value="{{ @$data['item']->C_total}}">
                                                <input type="radio" data-type="commercial_license_price" data-normal="normal_commercial_price"  name="list_item_price" value="{{ @$data['item']->C_total}}">
                                             </div>
                                             <div class="col-lg-6"> <strong>@lang('lang.commercial')</strong></div>
                                             <div class="col-lg-4" > <strong class="float-right"> {{@$infix_general_settings->currency_symbol}}<span id="commercial_license_price">{{ @$data['item']->C_total}}</span></strong></div>
                                          </div>
                                       </li>
                                       <li>
                                          <div class="row">
                                             <div class="col-lg-2">
                                                <input type="hidden" id="normal_extended_price" value="{{ @$data['item']->Ex_total}}">
                                                <input type="radio" data-type="extended_license_price" data-normal="normal_extended_price"  name="list_item_price" value="{{@$data['item']->Ex_total}}">
                                             </div>
                                             <div class="col-lg-6"> <strong>@lang('lang.extended')</strong> </div>
                                             <div class="col-lg-4" ><strong class="float-right">{{@$infix_general_settings->currency_symbol}} <span id="extended_license_price">{{ @$data['item']->Ex_total}}</span></strong> </div>
                                          </div>
                                       </li>
                                    </ul>
                                  
                                 </div>
                               @php
                                                            // $support_fee=floor($data['item']->Reg_total/100*$data['fees']->support_fee);
                                    $support_fee=$data['fees']->support_fee;
                                 @endphp
                                 <input type="text" hidden  name="_item_id" value="{{ @$data['item']->id}}">
                                 <input type="text" hidden  name="_item_percent" value="{{ @$data['BuyerFee']->fee/100}}">
                                 <input type="text" hidden  id="totalVal" name="totalVal" value="{{ @$data['item']->Reg_total}}">
                                 <input type="text" hidden id="extra_price"  value="0">
                                 <div class="lisence-extend d-flex justify-content-between align-items-center">
                                    <div class="lisence-extend-prise d-flex">
                                       <input type="checkbox" id="SupportAdd" name="support_Fee" value="{{@$support_fee}}">
                                       <label for="Remember1">@lang('lang.Extend_support_to') 12 @lang('lang.months') <br> <span>@lang('lang.get_it_now') {{@$infix_general_settings->currency_symbol}}8</span> </label>
                                    </div>
                                    <div class="prise">
                                       <strong>{{@$infix_general_settings->currency_symbol}}<span id="show_support_price">{{@$data['fees']->support_fee/100*@$data['item']->Reg_total }}</span></strong> 
                                       {{-- {{@$infix_general_settings->currency_symbol}}{{@$support_fee }} --}}
                                    </div>
                                 </div>
                                 <div class="add-cart">
                                    @if (@$data['item']->is_upload==1)
                                       <a  href="#test-form" class="boxed-btn add-cart-active popup-with-form" id="AddToCart">@lang('lang.Add_To_Cart')</a>
                                       <button  type="submit" class="boxed-btn-white" >@lang('lang.Buy') @lang('lang.Now') </button>
                                    @else
                                    <a  href="{{@$data['item']->purchase_link}}" target="_blank" class="boxed-btn add-cart-active">@lang('lang.Buy') @lang('lang.Now')</a>
                                   
                                    @endif
                                 
                                 </div>
                              </div>
                           </form>
                           
                           <div class="lisence-wrap" id="isence-wrap">
                              <a href="javascript:void(0)"  id="regularLi" onclick="regularLicence();">
                                 <div class="lisence-inner">
                                    <div
                                       class="lisence-heading d-flex justify-content-between align-items-center">
                                       <h5>@lang('lang.Regular') @lang('lang.License')</h5>
                                       <span id="reguler_price">{{@$infix_general_settings->currency_symbol}}{{ @$data['item']->Reg_total}}</span>
                                    </div>
                                    <p>@lang('lang.regular_license_description').</p>
                                 </div>
                              </a>
                              <div class="separator-1"></div>
                              <a href="javascript:void(0)"  id="extendedLi" onclick="extendedLicence();">
                                 <div class="lisence-inner">
                                    <div
                                       class="lisence-heading d-flex justify-content-between align-items-center">
                                       <h5>@lang('lang.extended') @lang('lang.License')</h5>
                                       <span id="extended_price">{{@$infix_general_settings->currency_symbol}}{{ @$data['item']->Ex_total}}</span>
                                    </div>
                                    <p>@lang('lang.extended_license_description').</p>
                                 </div>
                              </a>
                              <a href="{{url('license')}}">  <button class="boxed-btn d-block w-100 mt-3">@lang('lang.view_license_details')</button></a>
                           </div>
                        </div>
                     </div>
                     @if (@$data['item']->user->balance->amount)                                           
                     <div class="theme-side-bar gray-bg mt-20">
                        <div class="profile-linking">
                           <div class="profile-name">
                              <div class="theme-logo">
                                 <img src="{{ @$data['item']->user->profile->image? asset(@$data['item']->user->profile->image):asset('public/frontend/img/profile/1.png') }}" alt="">
                              </div>
                              <div class="theme-info">
                                 <h4>{{ @$data['item']->user->username}}</h4>
                               
                                 <div class="icons">
                                    <img height="auto" width="40"  src="{{asset(@$level->icon)}}" data-toggle="tooltip" data-placement="bottom" title="Author level  {{ @$level->id}} : sold {{@GeneralSetting()->currency_symbol}}  {{round(@$data['item']->user->balance->amount > 50 ? @$data['item']->user->balance->amount: 0) }}+ on {{ @GeneralSetting()->system_name }} " alt="">
                                    <img height="auto" width="40" src="{{asset(@$badge->icon)}}" data-toggle="tooltip" data-placement="bottom" title="{{ @$level->id-1}} {{@$badge->id == 1? 'Year' :'Years' }} of membarship on {{ @GeneralSetting()->system_name }} " alt="">
                                 </div>
                              </div>
                           </div>
                           <a href="{{ route('user.portfolio',@$data['item']->user->username)}}" class="boxed-btn d-block">@lang('lang.view') @lang('lang.portfolio')</a>
                        </div>
                     </div>
                     @endif
                     <div class="theme-side-bar1 gray-bg mt-20">
                        <div class="download-comments d-flex justify-content-between align-items-center">
                           <h3 class="d-flex align-items-center"> <i class="ti-shopping-cart"></i> @lang('lang.sales')</h3>
                           <span>{{ @$data['item']->sell }}</span>
                        </div>
                     </div>
                     <div class="theme-side-bar1 gray-bg mt-20">
                      
                        <div class="download-comments d-flex justify-content-between align-items-center">
                         
                           <nav>
                              <ul class="nav" id="myTab" role="tablist">
                                 <li class="nav-item">
                                    <h3 class="d-flex align-items-center"> <i class="ti-comments"></i>
                                       <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                          aria-controls="profile" aria-selected="false">@lang('lang.comments')</a>
                                    </h3>
                                 </li>
                              </ul>
                           </nav>
                           <span>{{ @$comment}}</span>
                        </div>
                     </div>
                     
                     @php
                     // @$totalRate =DB::table('reviews')->where('item_id', @$data['item']->id)->get();
                     // @$rate5 =DB::table('reviews')->where('item_id', @$data['item']->id)->whereBetween('rating',[4.5,5])->get();
                     if (@$rate5->count() > 0 ) {
                     @$rateparcent5= number_format((float)count(@$rate5)/count(@$totalRate)*100, 2, '.', '');
                     } else {
                     @$rateparcent5=0;
                     }                                                
                     @endphp
                    
                     <div class="theme-side-bar1 theme-side-bar2 gray-bg mt-20">
                        <div class="download-comments d-flex justify-content-between align-items-center">
                           <div class="rating">
                              <h3 class="d-flex align-items-center"> <i class="ti-star"></i> @lang('lang.Total')
                                 @lang('lang.Ratings')
                              </h3>
                              <p>{{ @$data['item']->rate }} @lang('lang.average_based_on') 5 @lang('lang.Ratings').</p>
                           </div>
                           <span>{{ count(@$totalRate) }}</span>
                        </div>
                     </div>
                     <div class="theme-side-bar1 gray-bg mt-1px">
                        <div class="progressBar-area">
                           <div class="single-progress-bar">
                              <span class="star-count">
                              5 @lang('lang.star')
                              </span>
                              <div class="ProgressWrap">
                                 <span class="progress">
                                    <div class="progress-bar wow slideInLeft singleitem_progress_bar"
                                       style="width: {{ @$rateparcent5  }}%;"
                                       data-wow-duration="2s" data-wow-delay=".1s">
                                    </div>
                                 </span>
                              </div>
                              <span class="number-value">
                              {{ @$rateparcent5 }}%
                              </span>
                           </div>
                           @php
                           // @$rate4 =DB::table('reviews')->where('item_id', $data['item']->id)->whereBetween('rating',[3.5,4])->get();
                           if (@$rate4->count() > 0 ) {
                             @$rateparcent4=  number_format((float)count(@$rate4)/count(@$totalRate)*100, 2, '.', '');
                           // @$rateparcent4= count(@$rate4)/count(@$totalRate)*100;
                           } else {
                           @$rateparcent4=0;
                           } 
                           @endphp
                           <div class="single-progress-bar">
                              <span class="star-count">
                              4 @lang('lang.star')
                              </span>
                              <div class="ProgressWrap">
                                 <span class="progress">
                                    <div class="progress-bar wow slideInLeft singleitem_progress_bar"
                                       style="width: {{ @$rateparcent4 }}%;"
                                       data-wow-duration="2s" data-wow-delay=".2s">
                                    </div>
                                 </span>
                              </div>
                              <span class="number-value">
                              {{ @$rateparcent4 }}%
                              </span>
                           </div>
                           @php
                           // @$rate3 =DB::table('reviews')->where('item_id', $data['item']->id)->whereBetween('rating',[2.5,3])->get();
                           if (@$rate3->count() > 0 ) {
                           @$rateparcent3= number_format((float)count(@$rate3)/count(@$totalRate)*100, 2, '.', '');
                           } else {
                           @$rateparcent3=0;
                           } 
                           @endphp
                           <div class="single-progress-bar">
                              <span class="star-count">
                              3 star
                              </span>
                              <div class="ProgressWrap">
                                 <span class="progress">
                                    <div class="progress-bar wow slideInLeft singleitem_progress_bar"
                                       style="width: {{ $rateparcent3 }}%; "
                                       data-wow-duration="2s" data-wow-delay=".3s">
                                    </div>
                                 </span>
                              </div>
                              <span class="number-value">
                              {{ @$rateparcent3 }}%
                              </span>
                           </div>
                           @php
                           // @$rate2 =DB::table('reviews')->where('item_id', @$data['item']->id)->whereBetween('rating',[1.5,2])->get();
                           if (@$rate2->count() > 0 ) {
                           @$rateparcent2= number_format((float)count(@$rate2)/count(@$totalRate)*100, 2, '.', '');
                           } else {
                           @$rateparcent2=0;
                           } 
                           @endphp
                           <div class="single-progress-bar">
                              <span class="star-count">
                              2 @lang('lang.star')
                              </span>
                              <div class="ProgressWrap">
                                 <span class="progress">
                                    <div class="progress-bar wow slideInLeft singleitem_progress_bar"
                                       style="width:{{ @$rateparcent2 }}%; "
                                       data-wow-duration="2s" data-wow-delay=".4s">
                                    </div>
                                 </span>
                              </div>
                              <span class="number-value">
                              {{ @$rateparcent2 }}%
                              </span>
                           </div>
                           @php
                           // @$rate1 =DB::table('reviews')->where('item_id', $data['item']->id)->whereBetween('rating',[.5,1])->get();
                           if (@$rate1->count() > 0 ) {
                           @$rateparcent1= number_format((float)count(@$rate1)/count(@$totalRate)*100, 2, '.', '');
                           } else {
                           $rateparcent1=0;
                           } 
                           @endphp
                           <div class="single-progress-bar">
                              <span class="star-count">
                              1 @lang('lang.star')
                              </span>
                              <div class="ProgressWrap">
                                 <span class="progress">
                                    <div class="progress-bar wow slideInLeft singleitem_progress_bar"
                                       style="width: {{@$rateparcent1}}%; "
                                       data-wow-duration="2s" data-wow-delay=".5s">
                                    </div>
                                 </span>
                              </div>
                              <span class="number-value">
                              {{@$rateparcent1}}%
                              </span>
                           </div>
                        </div>
                     </div>
                     <div class="theme-side-bar1 theme-side-bar3 gray-bg mt-20">
                        <div class="theme-detils-info">
                           <div class="single-info">
                              <h4 class="mb-3"> <span>@lang('lang.product_features')</span></h4>
                              <div class="single-info-inner">
                                 <div class="single-info-title  single-info-column">
                                    <p>@lang('lang.Last') @lang('lang.update')</p>
                                 </div>
                                 <div class="single-info-content single-info-column">
                                    <p> {{ DateFormat(@$data['item']->updated_at)}}</p>
                                 </div>
                              </div>
                              <div class="single-info-inner">
                                 <div class="single-info-title  single-info-column">
                                    <p>@lang('lang.Created')</p>
                                 </div>
                                 <div class="single-info-content single-info-column">
                                    <p> {{ DateFormat(@$data['item']->created_at)}}</p>
                                 </div>
                              </div>
                             
                              {{-- DYNAMIC ATTRIBUTE PRINTS  --}}
                              @if(@$data['attributes'])
                                 @foreach($data['attributes'] as $key=>$value)
                                    <div class="single-info-inner ">
                                       <div class="single-info-title single-info-column">
                                          <p>{{getAttributeName($value->field_name)}}</p>
                                       </div>
                                       <div class="single-info-content single-info-column">
                                          <p>{{getAttributeValues($value->values)}}</p> 
                                       </div>
                                    </div>
                                 @endforeach
                              @endif
                              {{--END DYNAMIC ATTRIBUTE PRINTS  --}}
 
                              {{-- <div class="single-info-inner ">
                                 <div class="single-info-title single-info-column">
                                    <p>@lang('lang.Documentation')</p>
                                 </div>
                                 <div class="single-info-content single-info-column">
                                    <p>@lang('lang.Well') @lang('lang.Documented')</p>
                                 </div>
                              </div>
                              <div class="single-info-inner ">
                                 <div class="single-info-title single-info-column">
                                    <p>@lang('lang.Layout')</p>
                                 </div>
                                 <div class="single-info-content single-info-column">
                                    <p>{{  @$data['item']->layout }}</p>
                                 </div>
                              </div> --}}

                              <div class="single-info-inner ">
                                 <div class="single-info-title single-info-column">
                                    <p>@lang('lang.Tags')</p>
                                 </div>
                                 <div class="single-info-content single-info-column">
                                    <p>{{  @$data['item']->tags }}</p>
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
   </div>
</div>
{{-- {{@$infix_general_settings->currency_symbol}} --}}
<form id="test-form" class="white-popup-block mfp-hide add_lisence_popup" action="{{ route('AddCartItem')}}" method="POST">
   @csrf
   <div class="form_header">
      @foreach (Cart::content()->unique('item_id') as $item)
      @if (@$data['item']->id == @$item->options['item_id'])
      <div class="alert alert-info" role="alert"> 
         <i class="ti-check"></i> @lang('lang.Already_Added_This_Item')
      </div>
      @endif
      @endforeach
      <h1>@lang('lang.Customize_your_selection')</h1>
      <input type="number" hidden id="item_id" name="id" value="{{  $data['item']->id }}">
      <input type="text" hidden  id="item_price" name="item_price" value="{{  $data['item']->Reg_total }}">
      <input type="text" hidden  name="item_name" value="{{  $data['item']->title }}">
      <input type="text" hidden  name="description" value="{{  $data['item']->description }}">
      <input type="text" hidden  name="user_id" value="{{  $data['item']->user_id }}">
      <input type="text" hidden  name="username" value="{{  $data['item']->user->username }}">
      <input type="text" hidden  name="image" value="{{  $data['item']->thumbnail }}">
      <input type="text" hidden  name="icon" value="{{  $data['item']->icon }}">
      <input type="text" hidden id="BuyerFee" name="BuyerFee" value="0">
      {{-- <input type="number" hidden id="_mod_total"  value="{{  $data['item']->Reg_total }}"> --}}
      <input type="text" hidden id="Extd_total" value="{{  $data['item']->Ex_total }}">
      <input type="text" hidden id="Extd_percent" name="Extd_percent"  value="{{ $data['item']->support_fee/100 }}">
   </div>
   <input type="text" hidden  id="pop_license_type" value="1" name="license_type">
   <input type="text" hidden  id="pop_support_time" value="1" name="support_time">
   <div class="row d-none">
      <div class="col-xl-6">
         <div class="single_select">
            <h4>@lang('lang.Select_a_License')</h4>
            <div class="select_box">
               <select class="wide SelectLicense" id="SelectLicense" >
                  <option id="reg_val" value="1" data-display="Regular">@lang('lang.Regular')</option>
                  <option id="Ex_val" value="2">@lang('lang.Extended')</option>
               </select>
            </div>
         </div>
      </div>
      <div class="col-xl-6">
         <div class="single_select">
            <h4>@lang('lang.select') @lang('lang.Support') @lang('lang.duration')</h4>
            <div class="select_box">
               <select class="wide Selectsupport" id="Selectsupport" >
                  <option value="1" id="six" data-display="6 months support">6 @lang('lang.months') @lang('lang.support')</option>
                  <option value="2" id="twelve">12 @lang('lang.months') @lang('lang.support')</option>
               </select>
            </div>
         </div>
      </div>
   </div>
   <div class="main_content">
      <div class="row gray-bg-2 no-gutters">
         <div class="col-xl-6 col-md-6">
            <div class="content_left">
               <a  class="profile_mini_thumb">
               <img src="{{ @$data['item']->thumbnail? asset(@$data['item']->thumbnail):'' }}" alt="">
               </a>
               <div class="content_title">
                  <p>{{@$data['item']->title}}
                     <br>
                     <span class="user_author">by {{@$data['item']->user->username}}</span>
                     <input type="number" id="totalCartItem" value="0" hidden>
                  </p>
               </div>
            </div>
         </div>
         <div class="col-xl-6 col-md-6">
            <div class="content_left">
               <h3> {{@$infix_general_settings->currency_symbol}}<span class="_mod_total">{{@$data['item']->Reg_total}}</span> </h3>
               <div class="content_title">
                  <p class="support_text">
                     <span>@lang('lang.License') :</span>
                     <a href="#" id="support_text">@lang('lang.Regular')</a>
                  </p>
                  <p class="support_text">
                     <span>@lang('lang.Support') :</span> 
                     <small id="support_tym">6 @lang('lang.months') @lang('lang.support')</small>
                  </p>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-xl-12">
            <div class="currency_text">
               <p>@lang('lang.All_prices_are')</p>
            </div>
         </div>
         <div class="col-xl-12">
            <div class="cancel_add_btn d-flex justify-content-between">
               <a class="boxed-btn-white mfp-close"  type="button" >@lang('lang.cancel')</a>
               <button id="AddCart" class="boxed-btn" type="submit">@lang('lang.Add_To_Cart')</button>
            </div>
         </div>
      </div>
   </div>
</form>
@endsection
@push('js')
<script src="{{ asset('public/frontend/js/') }}/item_preview.js"></script>
<script src="{{ asset('public/frontend/js/') }}/dm_price_cal.js"></script>
@endpush