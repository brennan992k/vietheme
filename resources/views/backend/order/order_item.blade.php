@extends('backend.master')
@section('mainContent')

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.Product') @lang('lang.order')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#" class="active">@lang('lang.order') @lang('lang.list')</a>
            </div>
        </div>
    </div>
</section>


<section class="admin-visitor-area DM_table_info">
    <div class="container-fluid p-0">       
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title lm_mb_35 sm_mb_20 ">
                            <h3 class="mb-0">@lang('lang.order') @lang('lang.list') </h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                           
                                <tr>
                                    <th>@lang('lang.title')</th>
                                    <th>@lang('lang.category')</th>
                                    <th>@lang('lang.demo') @lang('lang.url')</th>
                                    <th>@lang('lang.image')</th>
                                    <th>@lang('lang.price')</th>
                                    <th>@lang('lang.author')</th>
                                    <th>@lang('lang.buyer')</th>
                                    <th>@lang('lang.status')</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['item_order'] as $item)

                                @php
                                if (in_array($item->order_id, $data['refunds_list']))
                                    {
                                    continue;
                                    }
                                @endphp  
                                <tr>
                                    {{-- <td valign="top" hidden>{{@$item->id}}</td> --}}
                                    <td valign="top">{{Str::limit(@$item->Item->title,20)}}</td>
                                    <td valign="top">{{@$item->Item->category->title}} / {{@$item->Item->subCategory->title}}</td>
                                    <td valign="top"><a href="{{@$item->Item->demo_url}}" target="_blank" class="primary-btn small fix-gr-bg">@lang('lang.click_here')</a></td>
                                    <td valign="top"><img src="{{asset(@$item->Item->thumbnail)}}" class="order_item_thumb" ></td>
                                    <td valign="top">{{@GeneralSetting()->currency_symbol}}{{@$item->subtotal}}</td>
                                    <td aign="top"><a target="_blank" href="{{ route('user.profile',@$item->Item->user->username)}}">{{@$item->Item->user->username }}</a></td>
                                    <td aign="top"><a target="_blank" href="{{ route('user.profile',@$item->buyer->username)}}">{{@$item->buyer->username }}</a></td>
                                    <td valign="top">
                                                @if (@$item->status == 1)
                                                @lang('lang.active')
                                                @else   
                                                @lang('lang.pending')
                                                @endif
                                    </td>
                                    <td valign="top">
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                             <a class="dropdown-item" target="_blank" href="{{ route('singleProduct',[str_replace(' ', '-',@$item->Item->title),@$item->Item->id])}}">@lang('lang.view')</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection



