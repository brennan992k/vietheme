@extends('frontend.master')
@push('css')
  <link rel="stylesheet" href="{{ asset('public/frontend/') }}/affiliate_list.css">
  
@endpush
@section('content')

<input type="text" hidden  class="id" value="{{ Auth::user()->username}}">
       <!-- banner-area start -->
       <div class="banner-area4">
        <div class="banner-area-inner">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="banner-info">
                            <h2>@lang('lang.affiliate') @lang('lang.list')</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- details-tablist-end -->
    <div class="main-details-area mt-3">
        <div class="container">
            <div class="row mt-5">
                    <div class="col-xl-10 offset-xl-1 affiliate_item">
                        <h3>@lang('lang.affiliate') @lang('lang.link') <button id="aff_generate" class="boxed-btn">@lang('lang.click')</button></h3> 
                        <input  class="list-group-item" id="aff_link" value="{{ Auth::user()->referral_link }}"  />
                    </div>
            </div>
        </div>
    </div>
 
    <!-- main-details-area-start -->
    <div class="main-details-area mt-3">
        <div class="container">
            <div class="row">
                <div class="col-xl-10 offset-xl-1 col-lg-12">
                        <div class="my_coupon">
                            <div class="my_coupens_headeing mb-30">
                                <h3>@lang('lang.all') @lang('lang.affiliate') <b>({{ count(Auth::user()->referrals)  ?? '0' }})</b></h3>
                            </div>
                            <table class="table">
                                <tr>
                                    <th>@lang('lang.affiliate') @lang('lang.name')</th>
                                    <th>@lang('lang.added_time')</th>
                                    <th>@lang('status')</th>
                                </tr>
                                @foreach (@$data['affiliate'] as $item)
                                    <tr>
                                        <td>{{ @$item->username }}</td>
                                        <td>{{DateFormat(@$item->created_at)}}</td>
                                        <td>{{ @$item->status == 1 ?'Active':'Pending' }}</td>
                                    </tr>
                                @endforeach
                            </table>
                           
                            <div class="Pagination">
                                {{ $data['affiliate']->onEachSide(1)->links('frontend.paginate.frontentPaginate') }}
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
<script src="{{ asset('public/frontend/js/') }}/affiliate.js"></script>
@endpush