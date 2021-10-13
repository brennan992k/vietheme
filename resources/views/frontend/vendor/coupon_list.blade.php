@extends('frontend.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('public/frontend/') }}/coupon.css">
@endpush
@php
    @$frontCoupon = Modules\Pages\Entities\FrontCoupon::where('active_status', 1)->first();
@endphp
@section('content')

<input type="text" hidden  class="id" value="{{ Auth::user()->username}}">
<input type="text" hidden  class="coupon_id" value="{{ @$data['edit']->id}}">
       <!-- banner-area start -->
    <div class="banner-area4">
        <div class="banner-area-inner">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="banner-info">
                            <h2>@lang('lang.coupon')</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner-area end -->

    <!-- details-tablist-start -->
    <div class="details-tablist-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-10 offset-xl-1">
                    <div class="details-tablist">
                        <nav>
                            <ul class="nav" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link {{ @$data['all'] == url()->current() ?'active':'' }}" id="home-tab" data-toggle="tab" href="#{{ @$data['all'] == url()->current() ?'home':'' }}" role="tab"
                                        aria-controls="home" aria-selected="true">@lang('lang.all_active_coupons')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ @$data['add'] == url()->current() ?'active':'' }} " id="profile-tab" data-toggle="tab" 
                                        href="#{{ @$data['add'] == url()->current() ?'profile':'' }}" role="tab"
                                    aria-controls="profile" aria-selected="false"> @if (@$data['edit']) @lang('lang.edit') @else @lang('lang.add') @endif @lang('lang.coupon')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ @$data['delete'] == url()->current() ?'active':'' }}" href="{{route('author.Coupon_Delete_view')}}">@lang('lang.deleted_coupons')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ @$data['expire'] == url()->current() ?'active':'' }}" href="{{route('author.CouponExpire')}}">@lang('lang.expired_coupons')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ @$data['inactive'] == url()->current() ?'active':'' }}" href="{{route('author.CouponInactive')}}">@lang('lang.inactive_coupons')</a>
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
    <div class="main-details-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-xl-10 offset-xl-1 col-lg-12">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="main-tab-content">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade {{ @$data['all'] == url()->current() ?'show active':'' }}" id="home" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <div class="my_coupon">
                                            <div class="my_coupens_headeing mb-30">
                                                <h3>@lang('lang.all_coupons')</h3>
                                                <p>{{@$frontCoupon->coupon}}
                                                </p>
                                            </div>
                                            <table class="table">
                                                <tr>
                                                   {{--  <th>Coupon ID</th> --}}
                                                    <th style ="width:20%">@lang('lang.coupon_code')</th>
                                                    <th style ="width:15%">@lang('lang.coupon_type')</th>
                                                    <th style ="width:15%">@lang('lang.discounted_amount')</th>
                                                    {{-- <th style ="width:15%">@lang('lang.min_valid_rice')</th> --}}
                                                    <th style ="width:15%">@lang('lang.valid_date')</th>
                                                    <th style ="width:30%">@lang('lang.action')</th>
                                                </tr>
                                                @foreach (@$data['coupon'] as $key => $item)
                                                <tr>
                                                    
                                                    {{-- <td>#00{{ $item->id}}</td> --}}
                                                    <td style ="width:20%">{{ @$item->coupon_code}}</td>
                                                    <td style ="width:15%">{{ @$item->coupon_type == 1? 'Multiple':'Once'}} </td>
                                                    <td style ="width:15%">{{ @$item->discount_type == 1? '': @GeneralSetting()->currency_symbol}} {{ @$item->discount }} {{ @$item->discount_type == 1? '%':''}}</td>
                                                    {{-- <td style ="width:15%">{{ @$item->Min_Price->fee}}</td> --}}
                                                    <td style ="width:15%" data-label="Period2">{{DateFormat(@$item->to)}}</td>
                                                    <td style ="width:20%" class="edit-buttons"><button
                                                            class="delete" onclick="deleItem({{@$key}})">@lang('lang.delete')</button><button class="edit"><a href="{{ route('author.couponEdit',@$item->id)}}"
                                                            class="edit text-white">@lang('lang.edit')</a></button></td>
                                                            <a id="delete-form-{{ @$key }}" href="{{ route('author.couponDelete',@$item->id)}}" class="dm_display_none"></a>
                                                </tr>
                                                @endforeach
                                            </table>
                                            <div class="Pagination">
                                                {{ @$data['coupon']->onEachSide(1)->links('frontend.paginate.frontentPaginate') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade {{ @$data['add'] == url()->current() ?'show active':'' }}" id="profile" role="tabpanel"
                                        aria-labelledby="profile-tab">
                                        <div class="my_coupon">
                                                <div class="my_coupens_headeing mb-15">
                                                    <h3>@lang('lang.add_coupon')</h3>
                                                    <p>{{@$frontCoupon->add_coupon}}
                                                    </p>
                                                </div>
                                                @if (@$data['edit'])
                                                 <form action="{{ route('author.couponUpdate',@$data['edit']->id)}}" method="POST" id="couponStore" enctype="multipart/form-data">
                                                @else   
                                                    <form action="{{ route('author.couponStore')}}" method="POST" id="couponStore" enctype="multipart/form-data">
                                                @endif
                                                   @csrf
                                                        <div class="row">
                                                            <div class="col-xl-6">
                                                                <div class="row">
                                                                            <div class="col-xl-12 col-md-12">
                                                                                <label for="name">@lang('lang.coupon_code') <span>*</span></label>
                                                                                <input type="text" placeholder="@lang('lang.enter_coupon_code')" name="coupon_code" value="{{isset($data['edit'])? $data['edit']->coupon_code :old('coupon_code')}}">
                                                                                <input type="text" name="id" hidden value="{{ @$data['edit']->id }}">
                                                                                @if ($errors->has('coupon_code'))
                                                                                <span class="invalid-feedback invalid-select error"
                                                                                        role="alert">
                                                                                    <strong>{{ $errors->first('coupon_code') }}</strong>
                                                                                </span>
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-xl-12 col-md-12 ">
                                                                                    <label for="">@lang('lang.coupon_type') <span>*</span></label>
                                                                                    <div class="row ml-5">
                                                                                                                                                                           
                                                                                        <div class="col-lg-1"><input type="radio" id="once" value="0" {{isset($data['edit'])? $data['edit']->coupon_type == 0 ? 'checked' : '' :'checked'}} name="coupon_type"></div>
                                                                                        <div class="col-lg-3 mt-2"><label for="once">@lang('lang.once')</label></div>  
                                                                                                                                                                          
                                                                                        <div class="col-lg-1"><input type="radio" id="multiple" value="1" {{isset($data['edit'])? $data['edit']->coupon_type == 1 ? 'checked' : '' :''}} name="coupon_type"></div>
                                                                                        <div class="col-lg-3 mt-2"><label for="multiple">@lang('lang.multiple')</label></div>   
                                                                                        @if ($errors->has('coupon_type'))
                                                                                        <span class="invalid-feedback invalid-select error"
                                                                                                role="alert">
                                                                                            <strong>{{ $errors->first('coupon_type') }}</strong>
                                                                                        </span>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-xl-12 col-md-12 ">
                                                                                    <label for="">@lang('lang.coupon_discount') <span>*</span></label>
                                                                                    <div class="row ml-5">
                                                                                                                                                                           
                                                                                        <div class="col-lg-1"><input type="radio" value="0" id="fixed" name="discount_type" {{isset($data['edit'])? $data['edit']->discount_type == 0 ? 'checked' : '' :'checked'}} ></div>
                                                                                        <div class="col-lg-3 mt-2"><label for="fixed">@lang('lang.fixed')</label></div> 
                                                                                                                                                                        
                                                                                        <div class="col-lg-1"><input type="radio" id="percent" value="1" name="discount_type" {{isset($data['edit'])? $data['edit']->discount_type == 0? '':'checked' :old('discount_type')}} ></div>
                                                                                        <div class="col-lg-3 mt-2"><label for="percent">@lang('lang.percent') (%)</label></div>    
                                                                                        @if ($errors->has('discount'))
                                                                                        <span class="invalid-feedback invalid-select error"
                                                                                                role="alert">
                                                                                            <strong>{{ $errors->first('discount') }}</strong>
                                                                                        </span>
                                                                                        @endif
                                                                                    </div>
                                                                                   <input type="text"  placeholder="@lang('lang.enter_fix_discount')" id="discountfixed" name="discount" value="{{isset($data['edit'])? $data['edit']->discount :old('discount')}}">
                                                                                </div>
                                                                            {{-- <div class="col-xl-12 col-md-12">
                                                                                <label for="name">@lang('lang.min_valid_rice')</label>
                                                                             
                                                                                <input  placeholder="@lang('lang.min_valid_rice')" name="min_price" value="{{isset($data['edit'])? date('y-m-d',strtotime($data['edit']->min_price)) :old('min_price')}}" >
                                                                                @if ($errors->has('min_price'))
                                                                                <span class="invalid-feedback invalid-select error"
                                                                                        role="alert">
                                                                                    <strong>{{ $errors->first('min_price') }}</strong>
                                                                                </span>
                                                                                @endif
                                                                            </div> --}}
                                                                            {{-- <div class="col-xl-12 col-md-12">
                                                                                <label for="name">@lang('lang.min_valid_rice')</label>
                                                                                <select class="wide"  name="min_price">
                                                                                    <option data-display="Select" value="">@lang('lang.min_valid_rice')</option>
                                                                                    @foreach ($data['coupon_fee'] as $item)                                                                                        
                                                                                         <option value={{@$item->id}} {{ @$item->id == @$data['edit']->min_price ?'selected':old('min_price') == (@$item->id ? 'selected':'')}}>{{@$infix_general_settings->currency_symbol}}{{ @$item->fee }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                                @if ($errors->has('min_price'))
                                                                                <span class="invalid-feedback invalid-select error"
                                                                                        role="alert">
                                                                                    <strong>{{ $errors->first('min_price') }}</strong>
                                                                                </span>
                                                                                @endif
                                                                            </div> --}}
                                                                            <div class="col-xl-12 col-md-12">
                                                                                <label for="name">@lang('lang.valid_date') <span>*</span></label>
                                                                                <input id="from" placeholder="@lang('lang.from_date')" name="from" value="{{isset($data['edit'])? date('y-m-d',strtotime($data['edit']->from)) :old('from')}}" >
                                                                                @if ($errors->has('from'))
                                                                                <span class="invalid-feedback invalid-select error"
                                                                                        role="alert">
                                                                                    <strong>{{ $errors->first('from') }}</strong>
                                                                                </span>
                                                                                @endif
                                                                                <input id="to"  name="to" placeholder="@lang('lang.to_date')" value="{{isset($data['edit'])? date('y-m-d',strtotime($data['edit']->to)) :old('to')}}" >
                                                                               
                                                                                @if ($errors->has('to'))
                                                                                <span class="invalid-feedback invalid-select error"
                                                                                        role="alert">
                                                                                    <strong>{{ $errors->first('to') }}</strong>
                                                                                </span>
                                                                                @endif
                                                                            </div>
                                                                                <div class="col-lg-12">
                                                                                    <div class="input-effect">
                                                                                        <select class="wide{{ $errors->has('active_status') ? ' is-invalid' : '' }}" name="active_status">
                                                                                            <option data-display="@lang('lang.status') *" value="">@lang('lang.status') *</option> 
                                                                                            <option value="1" {{isset($data['edit'])? $data['edit']->status == 1?'selected':'': 'selected'}} >@lang('lang.active')</option> 
                                                                                            <option value="2" {{isset($data['edit'])? $data['edit']->status == 2?'selected':'': ''}}>@lang('lang.inactive')</option> 
                                                                                        </select>
                                                                                        <span class="focus-border"></span>
                                                                                        @if ($errors->has('active_status'))
                                                                                        <span class="invalid-feedback invalid-select" role="alert">
                                                                                            <strong>{{ $errors->first('active_status') }}</strong>
                                                                                        </span>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="coupns-btn">
                                                            <button type="submit" class="boxed-btn">
                                                                 
                                                                @if (@$data['edit'])
                                                                @lang('lang.update')
                                                                @else
                                                                @lang('lang.add')
                                                                @endif
                                                                @lang('lang.coupon')
                                                            </button>
                                                        </div>
                                                    </form>
                                            </div>
                                    </div>
                                    <div class="tab-pane fade {{ @$data['delete'] == url()->current() ?'show active':'' }}" id="contact" role="tabpanel"
                                        aria-labelledby="contact-tab">
                                        @php
                                           
                                        @endphp
                                        <div class="my_coupon">
                                                <div class="my_coupens_headeing mb-30">
                                                    <h3>@lang('lang.deleted_coupons')</h3>
                                                    <p>{{@$frontCoupon->delete_coupon}}
                                                    </p>
                                                </div>
                                                <table class="table">
                                                    <tr>
                                                       {{--  <th>Coupon ID</th> --}}
                                                        <th>@lang('lang.coupon_code')</th>
                                                        <th>@lang('lang.coupon_type')</th>
                                                        <th>@lang('lang.discounted_amount')</th>
                                                        {{-- <th>@lang('lang.min_valid_rice')</th> --}}
                                                        <th>@lang('lang.valid_date')</th>
                                                        <th>@lang('lang.action')</th>
                                                    </tr>
                                                    @foreach (@$data['delete_coupon'] as $key => $item)
                                                    <tr>
                                                       {{--  <td>#00{{ $item->id}}</td> --}}
                                                        <td>{{ @$item->coupon_code}}</td>
                                                        <td>{{ @$item->coupon_type == 1? 'Multiple':'Once'}} </td>
                                                        <td>{{ @$item->discount_type == 1? '%': @GeneralSetting()->currency_symbol }} {{ @$item->discount }}</td>
                                                        {{-- <td>{{ Session::get('infix_currency_symbol') }}{{ @$item->min_price}}</td> --}}
                                                        <td data-label="Period2">{{DateFormat(@$item->to)}}</td>
                                                        <td class="edit-buttons"><button class="delete" onclick="RestoreItem({{@$key}})" >@lang('lang.restore')</button></td>
                                                                <a id="restore-form-{{ @$key }}" href="{{ route('author.couponRestore',@$item->id)}}" class="dm_display_none"></a>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                                <div class="Pagination">
                                                        {{ @$data['coupon']->onEachSide(1)->links('frontend.paginate.frontentPaginate') }}
                                                </div>
                                            </div>
                                    </div>
                                    <div class="tab-pane fade {{ @$data['expire'] == url()->current() ?'show active':'' }}" id="expire" role="tabpanel"
                                        aria-labelledby="expire-tab">
                                        @php
                                            
                                        @endphp
                                        <div class="my_coupon">
                                                <div class="my_coupens_headeing mb-30">
                                                    <h3>@lang('lang.expired_coupons')</h3>
                                                    <p>{{@$frontCoupon->expired_coupon}}
                                                    </p>
                                                </div>
                                                <table class="table">
                                                    <tr>
                                                       {{--  <th>Coupon ID</th> --}}
                                                        <th>@lang('lang.coupon_code')</th>
                                                        <th>@lang('lang.coupon_type')</th>
                                                        <th>@lang('lang.discounted_amount')</th>
                                                        {{-- <th>@lang('lang.min_valid_rice')</th> --}}
                                                        <th>@lang('lang.valid_date')</th>
                                                        <th>@lang('lang.action')</th>
                                                    </tr>
                                                    @foreach ($data['expired_coupon'] as $key => $item)
                                                    <tr>
                                                       {{--  <td>#00{{ $item->id}}</td> --}}
                                                        <td>{{ @$item->coupon_code}}</td>
                                                        <td>{{ @$item->coupon_type == 1? 'Multiple':'Once'}} </td>
                                                        <td>{{ @$item->discount_type == 1? '%':@GeneralSetting()->currency_symbol}} {{ @$item->discount }}</td>
                                                        {{-- <td>{{ Session::get('infix_currency_symbol') }}{{ @$item->min_price}}</td> --}}
                                                        <td data-label="Period2">{{DateFormat(@$item->to)}}</td>
                                                        <td class="edit-buttons"><button><a href="{{ route('author.couponEdit',@$item->id)}}"
                                                                class="edit text-white">@lang('lang.edit')</a></button></td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                                <div class="Pagination">
                                                        {{ @$data['coupon']->onEachSide(1)->links('frontend.paginate.frontentPaginate') }}
                                                </div>
                                            </div>
                                    </div>

                                    {{-- inactive coupon  --}}
                                    <div class="tab-pane fade {{ @$data['inactive'] == url()->current() ?'show active':'' }}" id="expire" role="tabpanel"
                                        aria-labelledby="expire-tab">
                                        @php
                                            
                                        @endphp
                                        <div class="my_coupon">
                                                <div class="my_coupens_headeing mb-30">
                                                    <h3>@lang('lang.inactive_coupons')</h3>
                                                    <p>{{@$frontCoupon->Inactive_coupon}}
                                                    </p>
                                                </div>
                                                <table class="table">
                                                    <tr>
                                                       {{--  <th>Coupon ID</th> --}}
                                                        <th>@lang('lang.coupon_code')</th>
                                                        <th>@lang('lang.coupon_type')</th>
                                                        <th>@lang('lang.discounted_amount')</th>
                                                        {{-- <th>@lang('lang.min_valid_rice')</th> --}}
                                                        <th>@lang('lang.valid_date')</th>
                                                        <th>@lang('lang.action')</th>
                                                    </tr>
                                                    @foreach ($data['inactive_coupon'] as $key => $item)
                                                    <tr>
                                                       {{--  <td>#00{{ $item->id}}</td> --}}
                                                        <td>{{ @$item->coupon_code}}</td>
                                                        <td>{{ @$item->coupon_type == 1? 'Multiple':'Once'}} </td>
                                                        <td>{{ @$item->discount_type == 1? '%':@GeneralSetting()->currency_symbol}} {{ @$item->discount }}</td>
                                                        {{-- <td>{{ Session::get('infix_currency_symbol') }}{{ @$item->min_price}}</td> --}}
                                                        <td data-label="Period2">{{DateFormat(@$item->to)}}</td>
                                                        <td class="edit-buttons"><button><a href="{{ route('author.couponEdit',@$item->id)}}"
                                                                class="edit text-white">@lang('lang.edit')</a></button></td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                                <div class="Pagination">
                                                        {{ @$data['coupon']->onEachSide(1)->links('frontend.paginate.frontentPaginate') }}
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
    <!-- main-details-area-end -->
@endsection
@push('js')
<script src="{{ asset('public/frontend/js/') }}/coupon.js"></script>
<script src="{{ asset('public/frontend/js/') }}/delete.js"></script>
@endpush