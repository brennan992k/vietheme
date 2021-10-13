<div class="banner-area3">
        <div class="banner-area-inner">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 offset-xl-1">
                        <div class="banner-info mb-30 d-flex justify-content-between align-items-center">
                            <div class="profile_author d-flex align-items-center">
                                <div class="thumb">
                                @php
                                    $profile=$data['user']->profile->image;
                                @endphp
                                <img src="{{ file_exists(@$profile) ? asset($profile) : asset('public/uploads/user/user.png') }} " width="100" alt="">
                                </div>
                                <div class="profile_name">
                                   <h5>{{  @$data['user']->username }}</h5>
                                    <p>{{ @$data['user']->profile->country->name,','}} @lang('lang.member_since') {{DateFormat(@$data['user']->created_at)}} </p>
                                    @if (@Auth::user()->id != @$data['user']->id)
                                    <div class="view-follow">
                                        <a href="#" class="boxed-btn">@lang('lang.view_portfolio')</a>
                                        <a href="#" class="boxed-btn">@lang('lang.follow')</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                             @if (@Auth::user()->role_id == 4)
                            @php
                                $item = App\Models\ManageQuery::CountItemSell($data['user']->id);
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
                                       
                                        @else
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        @endif
                                    </div>
                                    <div class="sate-total">
                                        <p>@lang('lang.total_sales')</p>
                                        <h3>{{ @$item}}</h3>
                                    </div>
                                </div>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
