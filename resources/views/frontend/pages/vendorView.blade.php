@extends('frontend.master')
@push('css')
<link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/dashboard.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}public/backend/css/croppie.css">
<link rel="stylesheet" href="{{ asset('public/frontend/') }}/vendor_view.css">
@endpush
@section('content')
@php
   $infix_general_settings = app('infix_general_settings');
@endphp
<input type="text" hidden value="{{ @$data['user']->username }}" name="user_id" class="user_id">

<div class="banner-area3">
    <div class="banner-area-inner">
        <div class="container">
            <div class="row">
                <div class="col-xl-10 offset-xl-1">
                    <div class="banner-info mb-30 d-flex justify-content-between align-items-center">
                        <div class="profile_author d-flex align-items-center">
                            <div class="thumb">
                                <img src="{{ @$data['user']->profile->image? asset(@$data['user']->profile->image):asset('public/frontend/img/profile/1.png') }}" width="100" alt="">
                            </div>
                                    <div class="profile_name">
                                    <h5>{{  @$data['user']->username }}</h5>
                                        <p>{{ @$data['user']->profile->country->name , ','}} @lang('lang.member_since') {{ DateFormat(@$data['user']->created_at)}} </p>
                                        <div class="view-follow">
                                             
                                            <a href="{{ route('user.portfolio',@$data['user']->username) }}" class="boxed-btn">@lang('lang.view') @lang('lang.portfolio')</a>
                                            @if (@$data['user']->id != Auth::id())
                                                @if (@Auth::check())
                                                    @if (CheckFollow(Auth::user()->id,$data['user']->id))
                                                        <a href="#" class="boxed-btn" id="UnfollowUser">@lang('lang.unfollow')</a>
                                                    @else
                                                        <a href="#" class="boxed-btn" id="FollowUser">@lang('lang.follow')</a>
                                                    @endif
                                                @else
                                                <a href="{{ url('customer/login') }}" class="boxed-btn">@lang('lang.follow')</a>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $item =App\Models\ManageQuery::CountItemSell($data['user']->id); 
                                @endphp
                                <div class="rating d-flex">
                                    <div class="rating-star">
                                        
                                     @php
                                        $review_total=count(@$data['item_review']);
                                        $total_star=0;
                                    @endphp
                                    @if (@$review_total > 0)
                                     
                                    @foreach ( @$data['item_review'] as $review)
                                    @php
                                        $total_star = @$total_star+@$review->rating;
                                    @endphp
                                    @php
                                        $countable_star=$total_star/$review_total;
                                        $row_countable_star= floor($countable_star * 100) / 100;
                                        if ($row_countable_star>0 && $row_countable_star<=.5) {
                                            $countable_star=.5;
                                        }  
                                        if ($row_countable_star>.5 && $row_countable_star<=1) {
                                            $countable_star=1;
                                        } 
                                         if ($row_countable_star>1 && $row_countable_star<=1.5) {
                                            $countable_star=1.5;
                                            
                                        }  
                                        if ($row_countable_star>1.5 && $row_countable_star<=2) {
                                            $countable_star=2;
                                            
                                        } 
                                        if ($row_countable_star>2 && $row_countable_star<=2.5) {
                                            $countable_star=2.5;
                                            
                                        } 
                                        if ($row_countable_star>2.5 && $row_countable_star<=3) {
                                            $countable_star=3;
                                            
                                        }
                                         if ($row_countable_star>3 && $row_countable_star<=3.5) {
                                            $countable_star=3.5;
                                            
                                        } 
                                        if ($row_countable_star>3.5 && $row_countable_star<=4) {
                                            $countable_star=4;
                                            
                                        } 
                                        if($row_countable_star>4 && $row_countable_star<=4.5) {
                                            $countable_star=4.5;
                                            
                                        }
                                        if($row_countable_star>4.5 && $row_countable_star<=5) {
                                            $countable_star=5;
                                            
                                        }
                                    @endphp
                                   
                                    
                                         @endforeach
                                         <p>{{@$countable_star}} @lang('lang.Ratings')</p>
                                        @if(@$countable_star == .5)
                                        <i class="fa fa-star-half-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        @elseif(@$countable_star == 1)
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        @elseif(@$countable_star == 1.5)
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        @elseif(@$countable_star == 2)
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        @elseif(@$countable_star == 2.5)
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        @elseif(@$countable_star == 3)
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        @elseif(@$countable_star == 3.5)
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        @elseif(@$countable_star == 4)
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                        @elseif(@$countable_star == 4.5)
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                        @elseif(@$countable_star == 5)
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        @endif
                                        @if (@$review_total > 0)
                                            @else
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="sate-total">
                                        <p>@lang('lang.total') @lang('lang.sales')</p>
                                        <h3>{{ @$item}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     <!-- details-tablist-start -->
     <div class="details-tablist-area details-tablist-area-two">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 offset-xl-1">
                        <div class="details-tablist ">
                            <nav>
                                <ul class="nav" id="myTab" role="tablist">
                                    
                                    <li class="nav-item">
                                        <a class="nav-link {{ @$data['profile'] == url()->current() ?'active':'' }}" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                            aria-controls="home" aria-selected="true">@lang('lang.profile')</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link {{ @$data['portfolio'] == url()->current() ?'active':'' }}" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                            aria-controls="profile" aria-selected="false">@lang('lang.portfolio')</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ @$data['followers'] == url()->current() ?'active':'' }}" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                                            aria-controls="contact" aria-selected="false">@lang('lang.followers')</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ @$data['followings'] == url()->current() ?'active':'' }}" id="Followings-tab" data-toggle="tab" href="#Followings"
                                            role="tab" aria-controls="contact" aria-selected="false">@lang('lang.followings')</a>
                                    </li>
                                    
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
     </div>
        <!-- details-tablist-end -->
        <!-- main-details-area-start -->
    <div class="account-area account-area2 section-padding user_profile">
        <div class="container">
            <div class="row">
                <div class="container">
                    <div class="col-xl-10 offset-xl-1 col-lg-12">
                        <div class="row">
                            <div class="col-xl-12 p-sm-0">
                                <div class="main-tab-content">
                                    <div class="tab-content" id="myTabContent">
                                        
                                        <div class="tab-pane fade {{ @$data['profile'] == url()->current() ?'show active':'' }}  " id="home" role="tabpanel"
                                            aria-labelledby="home-tab">
                                            <div class="profile_profile">
                                                <div class="row">
                                                    <div class="col-xl-8 col-md-6">
                                                        <div class="big_logo gray-bg">
                                                            <div class="logo_thumb">
                                                                <img src="{{ @$data['user']->profile->logo_pic? asset(@$data['user']->profile->logo_pic):asset('public/frontend/img/banner/banner.png') }}" alt="">
                                                            </div>
                                                            <p>{{ @$data['user']->profile->about }} </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-md-6">

                                                            @php
                                                            $level=App\Models\ManageQuery::UserLabel($data['user']->balance->amount); 
                                                            // DB::table('labels')->where('amount','<=',@$data['user']->balance->amount)->orderBy('id','desc')->first();
                                                            $date=Carbon\Carbon::parse(Carbon\Carbon::now())->diffInDays(@$data['user']->created_at);
                                                            $badge=App\Models\ManageQuery::UserBadge($date); 
                                                        @endphp
                                                        <div class="badge_mark">
                                                                <div class="first_badge gray-bg">
                                                                    <img width="40" height="auto" src="{{asset(@$level->icon)}}" data-toggle="tooltip" data-placement="bottom" title="Author level  {{ @$level->id}} : sold {{@GeneralSetting()->currency_symbol}} {{round(@$data['user']->balance->amount > 50 ? @$data['user']->balance->amount: 0) }}+ on {{@GeneralSetting()->system_name}} " alt="">
                                                                    <img width="40" height="auto" src="{{asset(@$badge->icon)}}" data-toggle="tooltip" data-placement="bottom" title="{{ @$level->id-1}} {{@$badge->id == 1? 'Year' :'Years' }} of membarship on {{@GeneralSetting()->system_name}} " alt="">
                                                     
                                                            </div>
                                                            <div class="social_profile gray-bg">
                                                                <h5>@lang('lang.social') @lang('lang.profiles')</h5>
                                                                @if (@$data['socila_icons']->behance != "")
                                                                <a href="{{$data['socila_icons']->behance}}"><i class="fa fa-behance"></i></a>
                                                            @endif
                                                            @if (@$data['socila_icons']->deviantart != "")
                                                                <a href="{{$data['socila_icons']->deviantart}}"><i class="fa fa-deviantart"></i></a>
                                                            @endif
                                                            @if (@$data['socila_icons']->digg != "")
                                                                <a href="{{$data['socila_icons']->digg}}"><i class="fa fa-digg"></i></a>
                                                            @endif
                                                            @if (@$data['socila_icons']->dribbble != "")
                                                                <a href="{{$data['socila_icons']->dribbble}}"><i class="fa fa-dribbble"></i></a>
                                                            @endif
                                                            @if (@$data['socila_icons']->facebook != "")
                                                                <a href="{{$data['socila_icons']->facebook}}"><i class="fa fa-facebook"></i></a>
                                                            @endif
                                                            @if (@$data['socila_icons']->flickr != "")
                                                                <a href="{{$data['socila_icons']->flickr}}"><i class="fa fa-flickr"></i></a>
                                                            @endif
                                                            @if (@$data['socila_icons']->github != "")
                                                                <a href="{{$data['socila_icons']->github}}"><i class="fa fa-github"></i></a>
                                                            @endif
                                                            @if (@$data['socila_icons']->google_plus != "")
                                                                <a href="{{$data['socila_icons']->google_plus}}"><i class="fa fa-google-plus"></i></a>
                                                            @endif
                                                            @if (@$data['socila_icons']->lastfm != "")
                                                                <a href="{{$data['socila_icons']->lastfm}}"><i class="fa fa-lastfm"></i></a>
                                                            @endif
                                                            @if (@$data['socila_icons']->linkedin != "")
                                                                <a href="{{$data['socila_icons']->linkedin}}"><i class="fa fa-linkedin"></i></a>
                                                            @endif
                                                            @if (@$data['socila_icons']->reddit != "")
                                                                <a href="{{$data['socila_icons']->reddit}}"><i class="fa fa-reddit"></i></a>
                                                            @endif
                                                            @if (@$data['socila_icons']->soundcloud != "")
                                                                <a href="{{$data['socila_icons']->soundcloud}}"><i class="fa fa-soundcloud"></i></a>
                                                            @endif
                                                            @if (@$data['socila_icons']->thumblr != "")
                                                                <a href="{{$data['socila_icons']->thumblr}}"><i class="fa fa-thumblr"></i></a>
                                                            @endif
                                                            @if (@$data['socila_icons']->twitter != "")
                                                                <a href="{{$data['socila_icons']->twitter}}"><i class="fa fa-twitter"></i></a>
                                                            @endif
                                                            @if (@$data['socila_icons']->vimeo != "")
                                                                <a href="{{$data['socila_icons']->vimeo}}"><i class="fa fa-vimeo"></i></a>
                                                            @endif
                                                            @if (@$data['socila_icons']->youtube != "")
                                                                <a href="{{$data['socila_icons']->youtube}}"><i class="fa fa-youtube"></i></a>
                                                            @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade {{ @$data['portfolio'] == url()->current() ?'show active':'' }} " id="profile" role="tabpanel"
                                            aria-labelledby="profile-tab">
                                            <div class="portfolio_list gray-bg">
                                                @foreach ($data['item'] as $item)
                                                <div
                                                    class="single_portfolio_list  d-flex align-items-center justify-content-between">

                                                    <div class="portflio_thumb d-flex align-items-center col-lg-4">
                                                        <img src="{{ asset(@$item->icon) }}" alt="" width="100">
                                                        <div class="thumb_heading">
                                                        <h5><a href="{{ route('singleProduct',[str_replace(' ', '-',@$item->title),@$item->id])}}">{{ @$item->title}}</a></h5>
                                                            <p>@lang('lang.item_by') <a href="{{ route('user.portfolio',@$item->user->username)}}">{{ @$item->user->username}}</a> </p>
                                                        </div>
                                                    </div>

                                                    <div class="portfolio_details col-lg-4">
                                                        <p>@lang('lang.in'): {{ @$item->category->title}} / {{ @$item->subCategory->title}} <br>
                                                            @lang('lang.high_resolution'): {{ @$item->resolution}}, @lang('lang.compatible_browsers'): {{ @$item->compatible_browsers }}, @lang('lang.compatible_with'): <br>
                                                            {{ @$item->compatible_with }}, @lang('lang.Columns'): {{ @$item->columns }}</p>
                                                    </div>

                                                    @if (@Auth::user()->id==$item->user_id)
                                                    <div class="cart_heart d-flex col-lg-2">
                                                        {{-- <a href="#" class="heart heart2"><i class=" ti-heart "></i></a> --}}
                                                       {{-- <form action="{{ route('AddBuy') }}" method="POST" id="AddtoBuy{{ @$item->id}}">
                                                            @csrf
                                                        <input type="text" hidden  name="_item_id" value="{{ @$item->id}}">
                                                        <input type="text" hidden  name="_item_percent" value="{{ @$data['BuyerFee']->fee/100}}">
                                                        <input type="text" hidden id="totalVal" name="totalVal" value="{{ @$item->Reg_total}}">
                                                        <a href="#" onclick="BuyNow({{ @$item->id}})" class="heart heart2"><i class="ti-shopping-cart"></i></a>
                                                        </form> --}}
                                                       

                                                       <a href="{{ route('author.itemEdit',$item->id)}}" class="heart"><i class=" ti-pencil-alt "></i></a>
                                                       <a  onclick="deleItem({{$item->id}})" class="heart heart2 trash"><i class="ti-trash"></i></a>
                                                       <a id="delete-form-{{ $item->id }}" href="{{ route('author.itemDelete',$item->id)}}" class="dm_display_none"></a>

                                                    <a href="{{route('author.ProductDownload',$item->id)}}"  class="heart heart2"><i class=" ti-import" ></i></a>
                                                    
                                                    </div>
                                                    @else
                                                    <div class="cart_heart d-flex col-lg-2">
                                                        {{-- <a href="#" class="heart heart2"><i class=" ti-heart "></i></a> --}}
                                                       <form action="{{ route('AddBuy') }}" method="POST" id="AddtoBuy{{ @$item->id}}">
                                                            @csrf
                                                        <input type="text" hidden  name="_item_id" value="{{ @$item->id}}">
                                                        <input type="text" hidden  name="_item_percent" value="{{ @$data['BuyerFee']->fee/100}}">
                                                        <input type="text" hidden id="totalVal" name="totalVal" value="{{ @$item->Reg_total}}">
                                                        <a href="#" onclick="BuyNow({{ @$item->id}})" class="heart heart2"><i class="ti-shopping-cart"></i></a>
                                                        </form>
                                                       {{-- <a href="#"  class="heart heart2"><i class=" ti-import" ></i></a> --}}
                                                        
                                                    
                                                    </div>
                                                    @endif

                                                    {{-- <div class="cart_heart d-flex col-lg-2">
                                                        <a href="#" class="heart heart2"><i class=" ti-heart "></i></a>
                                                       <form action="{{ route('AddBuy') }}" method="POST" id="AddtoBuy{{ @$item->id}}">
                                                            @csrf
                                                        <input type="text" hidden  name="_item_id" value="{{ @$item->id}}">
                                                        <input type="text" hidden  name="_item_percent" value="{{ @$data['BuyerFee']->fee/100}}">
                                                        <input type="text" hidden id="totalVal" name="totalVal" value="{{ @$item->Reg_total}}">
                                                        <a href="#" onclick="BuyNow({{ @$item->id}})" class="heart heart2"><i class="ti-shopping-cart"></i></a>
                                                        </form>
                                                       <a href="#"  class="heart heart2"><i class=" ti-import" ></i></a>
                                                        
                                                    
                                                    </div> --}}

                                                    <div class="total-prise text-center col-lg-2">
                                                      <h2>{{@$infix_general_settings->currency_symbol}}{{ @$item->Reg_total}}</h2>
                                                        <p>@lang('lang.total') {{ @$item->sell }} @lang('lang.purchases')</p>
                                                    </div>

                                                </div>
                                                @endforeach
                                                <div class="Pagination">
                                                    {{ @$data['item']->onEachSide(1)->links('frontend.paginate.frontentPaginate') }}
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane fade {{ @$data['followers'] == url()->current() ?'show active':'' }} " id="contact" role="tabpanel"
                                            aria-labelledby="contact-tab">
                                            @if (@$data['follower'])
                                            @foreach ($data['follower'] as $key=> $item)
                                            <div class="follower gray-bg">
                                                    @if (isset($item->balance))
                                                    <div class="single_followers d-flex justify-content-between align-items-center ">
                                                        <div class="followers d-flex align-items-center">
                                                            <img width="80" height="auto" src="{{ @$item->profile->image? asset(@$item->profile->image):asset('public/frontend/img/profile/1.png') }}" alt="">
                                                            <div class="thumb_heading">
                                                                <h5><a href="{{ route('user.profile',@$item->username)}}">{{ @$item->username }}</a></h5>
                                                                <p>@lang('lang.member_since'): {{  DateFormat(@$item->created_at)  }}</p>
                                                            </div>
                                                        </div>
                                                        @php
                                                             $level=App\Models\ManageQuery::UserLabel($item->balance->amount); 
                                                            // DB::table('labels')->where('amount','<=',@$item->balance->amount)->orderBy('id','desc')->first();
                                                            $date=Carbon\Carbon::parse(Carbon\Carbon::now())->diffInDays(@$item->created_at);
                                                            $badge=App\Models\ManageQuery::UserBadge($date); 
                                                        @endphp
                                                        <div class="bandge">
                                                                <img src="{{asset(@$level->icon)}}" data-toggle="tooltip" data-placement="bottom" title="Author level  {{ @$level->id}} : sold {{@GeneralSetting()->currency_symbol}} {{round(@$item->balance->amount > 50 ? @$item->balance->amount: 0) }}+ on {{@GeneralSetting()->system_name}} " alt="">
                                                                <img src="{{asset(@$badge->icon)}}" data-toggle="tooltip" data-placement="bottom" title="{{ @$level->id-1}} {{@$badge->id == 1? 'Year' :'Years' }} of membarship on {{@GeneralSetting()->system_name}} " alt="">
                                                        </div>
                                                        <div class="rating">
                                                                <div class="rate">
                                                                        @php
                                                                               
                                                                                $review_total=count(@$item->reviews);
                                                                                $total_star=0;
                                                                            @endphp
                                                                            @if (@$review_total > 0)
                                                                            
                                                                                @foreach ( $item->reviews as $review)
                                                                                    @php
                                                                                        $total_star = $total_star+$review->rating;
                                                                                    @endphp
                                                                                @endforeach
                                                                                    @php
                                                                                        $total_star=$total_star/$review_total;
                                                                                    @endphp
                                                                                    @if($total_star == .5)
                                                                                    <i class="fa fa-star-half-o"></i>
                                                                                    <i class="fa fa-star-o"></i>
                                                                                    <i class="fa fa-star-o"></i>
                                                                                    <i class="fa fa-star-o"></i>
                                                                                    <i class="fa fa-star-o"></i>
                                                                                    @elseif($total_star == 1)
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                    @elseif($total_star == 1.5)
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star-half-o-o"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                    @elseif($total_star == 2)
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                    @elseif($total_star == 2.5)
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star-half-o"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                    @elseif($total_star == 3)
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                    @elseif($total_star == 3.5)
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star-half-o"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                    @elseif($total_star == 4)
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                    @elseif($total_star == 4.5)
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star-half-o"></i>
                                                                                    @elseif($total_star == 5)
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                    @endif
                                                                                    
                                                                                    @else
                                                                                    <i class="fa fa-star-o"></i>
                                                                                    <i class="fa fa-star-o"></i>
                                                                                    <i class="fa fa-star-o"></i>
                                                                                    <i class="fa fa-star-o"></i>
                                                                                    <i class="fa fa-star-o"></i>
                                                                                    @endif
                                                                </div>
                                                                <p>{{ $review_total }} @lang('lang.Ratings')</p>
                                                        </div>
                                                                <div class="total-prise text-center">
                                                                   <h2> {{ $item->item->sum('sell') }}</h2>
                                                                    <p>@lang('lang.sales')</p>
                                                                </div>
                                                    </div> 
                                                @endif                                                      
                                            </div>
                                                    @endforeach
                                                        <div class="Pagination">
                                                            {{ @$data['follower']->onEachSide(1)->links('frontend.paginate.frontentPaginate') }}
                                                        </div>
                                                    @else
                                                     <h2>@lang('lang.no') @lang('lang.followers')</h2>
                                                   @endif
                                                
                                            </div>
                                            </div>
                                        </div>
                                        <!-- Followings start here  -->
                                        <div class="tab-pane fade {{ @$data['followings'] == url()->current() ?'show active':'' }} " id="Followings" role="tabpanel"
                                            aria-labelledby="Followings-tab">
                                           
                                            <div class="follower gray-bg">
                                                    @if (@$data['following'])
                                                        @foreach ($data['following'] as $item)
                                                        @if (isset($item->balance))
                                                            <div
                                                                class="single_followers d-flex justify-content-between align-items-center ">
                                                                <div class="followers d-flex align-items-center">
                                                                    <img width="80" height="auto" src="{{ @$item->profile->image? asset(@$item->profile->image):asset('public/frontend/img/profile/1.png') }}" alt="" width="80" height="auto">
                                                                    <div class="thumb_heading">
                                                                        <h5><a href="{{ route('user.profile',@$item->username)}}">{{ @$item->username }}</a></h5>
                                                                        <p>@lang('lang.member_since'): {{  DateFormat(@$item->created_at)  }}</p>
                                                                    </div>
                                                                </div>

                                                                @php
                                                                 $level=App\Models\ManageQuery::UserLabel($item->balance->amount); 
                                                                // DB::table('labels')->where('amount','<=',@$item->balance->amount)->orderBy('id','desc')->first();
                                                                $date=Carbon\Carbon::parse(Carbon\Carbon::now())->diffInDays(@$item->created_at);
                                                                $badge=App\Models\ManageQuery::UserBadge($date); 
                                                                    // $level=DB::table('labels')->where('amount','<=',@$item->balance->amount)->orderBy('id','desc')->first();
                                                                    // $date=Carbon\Carbon::parse(Carbon\Carbon::now())->diffInDays($item->created_at);
                                                                    // $badge=DB::table('badges')->where('day','<=',@$date)->orderBy('id','desc')->first();
                                                                @endphp
                                                                <div class="bandge">
                                                                        <img src="{{asset(@$level->icon)}}" data-toggle="tooltip" data-placement="bottom" title="Author level  {{ @$level->id}} : sold {{@GeneralSetting()->currency_symbol}} {{round(@$item->balance->amount > 50 ? @$item->balance->amount: 0) }}+ on {{@GeneralSetting()->system_name}} " alt="">
                                                                        <img src="{{asset(@$badge->icon)}}" data-toggle="tooltip" data-placement="bottom" title="{{ @$level->id-1}} {{@$badge->id == 1? 'Year' :'Years' }} of membarship on {{@GeneralSetting()->system_name}} " alt="">
                                                             
                                                                    </div>
                                                                    <div class="rating">
                                                                            <div class="rate">
                                                                                @php
                                                                               
                                                                                $review_total=count(@$item->reviews);
                                                                                $total_star=0;
                                                                            @endphp
                                                                            @if (@$review_total > 0)
                                                                            
                                                                                @foreach ( $item->reviews as $review)
                                                                                    @php
                                                                                        $total_star = $total_star+$review->rating;
                                                                                    @endphp
                                                                                @endforeach
                                                                                    @php
                                                                                        $total_star=$total_star/$review_total;
                                                                                    @endphp
                                                                                    @if($total_star == .5)
                                                                                    <i class="fa fa-star-half-o"></i>
                                                                                    <i class="fa fa-star-o"></i>
                                                                                    <i class="fa fa-star-o"></i>
                                                                                    <i class="fa fa-star-o"></i>
                                                                                    <i class="fa fa-star-o"></i>
                                                                                    @elseif($total_star == 1)
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                    @elseif($total_star == 1.5)
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star-half-o-o"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                    @elseif($total_star == 2)
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                    @elseif($total_star == 2.5)
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star-half-o"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                    @elseif($total_star == 3)
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                    @elseif($total_star == 3.5)
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star-half-o"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                    @elseif($total_star == 4)
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star-o"></i>
                                                                                    @elseif($total_star == 4.5)
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star-half-o"></i>
                                                                                    @elseif($total_star == 5)
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                        <i class="fa fa-star"></i>
                                                                                    @endif
                                                                                    
                                                                                    @else
                                                                                    <i class="fa fa-star-o"></i>
                                                                                    <i class="fa fa-star-o"></i>
                                                                                    <i class="fa fa-star-o"></i>
                                                                                    <i class="fa fa-star-o"></i>
                                                                                    <i class="fa fa-star-o"></i>
                                                                                    @endif
                                                                            </div>
                                                                            <p>{{ @$review_total }} @lang('lang.Ratings')</p>
                                                                            </div>
                                                                            <div class="total-prise text-center">
                                                                               <h2> {{ $item->item->sum('sell') }}</h2>
                                                                                <p>@lang('lang.sales')</p>
                                                                            </div>
                                                                        </div> 
                                                                {{-- <div class="total-prise text-center">
                                                                    <h2>12</h2>
                                                                    <p>@lang('lang.sales')</p>
                                                                </div> --}}
                                                            </div>   
                                                            @endif                                                   
                                                        @endforeach
                                                        <div class="Pagination">
                                                                {{ @$data['following']->onEachSide(1)->links('frontend.paginate.frontentPaginate') }}
                                                        </div>
                                                    @else
                                                    <h2>@lang('lang.no') @lang('lang.following')</h2>
                                                    @endif
                                                   
                                                </div>
                                        </div>
                                        <!-- Followings end  -->
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- main-details-area-end -->
@endsection
@push('js')
<!-- Croppie js -->
<script src="{{ asset('/public/backend/js/')}}/croppie.js"></script>

<script src="{{asset('public/frontend/js/vendorView.js')}}"></script>
<script src="{{ asset('public/frontend/js/') }}/delete.js"></script>

    
@endpush