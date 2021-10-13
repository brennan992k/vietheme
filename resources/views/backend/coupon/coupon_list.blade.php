@extends('backend.master')
@section('mainContent')

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.coupon') @lang('lang.list')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.coupon')</a>
                <a href="{{ route('admin.coupon')}}" class="active">@lang('lang.coupon') @lang('lang.list')</a>
                @if(isset($data['edit']) && !empty(@$data['edit']))
                <a href="#" class="active">@lang('lang.coupon') @lang('lang.edit')</a>
            @endif
            </div>
        </div>
    </div>
</section>


<section class="admin-visitor-area DM_table_info">
    <div class="container-fluid p-0">
        @if(isset($data['edit']) && !empty(@$data['edit']))
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{route('admin.coupon')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    @lang('lang.add')
                </a>
            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title lm_mb_35 sm_mb_20">
                            <h3 class="mb-0">@lang('lang.coupon') @lang('lang.list')</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 mt-30">
                        @if (isset($data['edit']))
                        <form action="{{route('admin.couponUpdate')}}" method="post">
                        @else
                        <form action="{{route('admin.couponStore')}}" method="post">
                        @endif
                        
                            @csrf
                            <div class="white-box">
                                <div class="add-visitor">
                                        <input type="hidden" name="id" value="{{isset($data['edit'])? $data['edit']->id: ''}}">

                                        <div class="row mb-30">
                                            <div class="col-lg-12">
                                                <div class="input-effect">
                                                    <input class="primary-input form-control{{ $errors->has('coupon_code') ? ' is-invalid' : '' }}" type="text" name="coupon_code"
                                                           autocomplete="off" value="{{isset($data['edit'])? $data['edit']->coupon_code :old('coupon_code')}}">
                                                    <label>@lang('lang.coupon') @lang('lang.code') <span>*</span></label>
                                                    <span class="focus-border"></span>
                                                    @if ($errors->has('coupon_code'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('coupon_code') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-30">
                                            <div class="col-lg-12">
                                                <div class="input-effect">
                                                    <input class="primary-input form-control{{ $errors->has('discount') ? ' is-invalid' : '' }}" type="text" name="discount"
                                                           autocomplete="off" value="{{isset($data['edit'])? $data['edit']->discount :old('discount')}}">
                                                    <label>@lang('lang.coupon') @lang('lang.amount') <span>*</span></label>
                                                    <span class="focus-border"></span>
                                                    @if ($errors->has('discount'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('discount') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-40">
                                                <div class="col-lg-12">
                                                    <div class="input-effect">
                                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('coupon_type') ? ' is-invalid' : '' }}"
                                                                name="coupon_type">
                                                            <option data-display="@lang('lang.coupon') @lang('lang.type') *" value="">@lang('lang.coupon') @lang('lang.type')</option>
                                                            <option  value="0" {{isset($data['edit'])? ($data['edit']->coupon_type==0? 'selected':'' ) :''}}>@lang('lang.once')</option>
                                                            <option  value="1" {{isset($data['edit'])? ($data['edit']->coupon_type==1? 'selected':'' ) :''}}>@lang('lang.multiple')</option>
                                                           
                                                        </select>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('coupon_type'))
                                                            <span class="invalid-feedback invalid-select"
                                                                  role="alert">
                                                                <strong>{{ $errors->first('coupon_type') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="row mb-40">
                                                <div class="col-lg-12">
                                                    <div class="input-effect">
                                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('discount_type') ? ' is-invalid' : '' }}"
                                                                name="discount_type">
                                                            <option data-display="@lang('lang.discount') @lang('lang.type') *" value="">@lang('lang.discount') @lang('lang.type')</option>
                                                            <option  value="0" {{isset($data['edit'])? ($data['edit']->discount_type==0? 'selected':'' ) :''}}>@lang('lang.fixed')</option>
                                                            <option  value="1" {{isset($data['edit'])? ($data['edit']->discount_type==1? 'selected':'' ) :''}}>@lang('lang.percent') (%)</option>
                                                           
                                                        </select>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('discount_type'))
                                                            <span class="invalid-feedback invalid-select"
                                                                  role="alert">
                                                                <strong>{{ $errors->first('discount_type') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
    

                                    <div class="row mt-30">
                                        <div class="col-lg-12">
                                         <div class="input-effect">
                                             <input class="primary-input date form-control {{ $errors->has('from') ? ' is-invalid' : '' }}" type="text" value="{{isset($data['edit'])? date('m/d/Y',strtotime($data['edit']->from))  :''}}" readonly placeholder="@lang('lang.start_date')" id="startDate"  name="from">
                                             <span class="focus-border"></span>
                                                     @if ($errors->has('from'))
                                                     <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $errors->first('from') }}</strong>
                                                     </span>
                                                     @endif
                                         </div>
                                     </div>
                                    </div>
                                     <div class="row mt-30">
                                        <div class="col-lg-12">
                                         <div class="input-effect">
                                             <input class="primary-input date form-control {{ $errors->has('to') ? ' is-invalid' : '' }}" type="text" value="{{isset($data['edit'])? date('m/d/Y',strtotime($data['edit']->to)) :''}}" readonly placeholder="@lang('lang.end_date')" id="endDate"  name="to">
                                             <span class="focus-border"></span>
                                                @if ($errors->has('to'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('to') }}</strong>
                                                </span>
                                                @endif
                                         </div>
                                     </div>
                                    </div>
                                 
    
    
    
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <select class="niceSelect w-100 bb form-control{{ $errors->has('active_status') ? ' is-invalid' : '' }}" name="active_status">
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
    
    
    
                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                            <button class="primary-btn fix-gr-bg">
                                                <span class="ti-check"></span>
                                                @if(isset($data['edit']))
                                                    @lang('lang.update')
                                                @else
                                                    @lang('lang.save')
                                                @endif
                                                @lang('lang.coupon')
    
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-9">
                        
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                           
                                <tr>
                                    <th>@lang('lang.code')</th>
                                    <th>@lang('lang.discount')</th>
                                    {{-- <th>@lang('lang.min_price')</th> --}}
                                    <th>@lang('lang.coupon_type')</th>
                                    <th>@lang('lang.discount') @lang('lang.type')</th>
                                    <th>@lang('lang.valid') @lang('lang.date')</th>
                                    <th>@lang('lang.status')</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['coupon'] as $item)
                                <tr>
                                    <td valign="top">{{@$item->coupon_code}} </td>
                                    <td valign="top">{{@GeneralSetting()->currency_symbol}}{{@$item->discount}}</td>
                                    {{-- <td valign="top">{{@GeneralSetting()->currency_symbol}}{{@$item->min_price}}</td> --}}
                                    <td valign="top">
                                        @if ($item->coupon_type==0)
                                            @lang('lang.once')
                                        @else
                                            @lang('lang.multiple')
                                        @endif 
                                    </td>
                                    <td valign="top">
                                        @if ($item->discount_type==0)
                                            @lang('lang.fixed')
                                        @else
                                            @lang('lang.percent')
                                        @endif 
                                    </td>
                                    <td valign="top">
                                        {{DateFormat(@$item->from)}} - 
                                        {{DateFormat(@$item->to)}}

                                    </td>
                                    <td valign="top">
                                            @if (@$item->status == 1  && date('y-m-d', strtotime(@$item->from)) <= date('y-m-d') && date('y-m-d', strtotime(@$item->to)) >= date('y-m-d') )
                                            @lang('lang.active')
                                            @else   
                                            @lang('lang.inactive')
                                            @endif
                                    </td>
                                    <td valign="top">
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{route('admin.coupon_edit',$item->id)}}"  >@lang('lang.edit')</a>
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteClassModal{{@$item->id}}" >@lang('lang.delete')</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                  <div class="modal fade admin-query" id="deleteClassModal{{@$item->id}}" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('lang.delete') @lang('lang.coupon')</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                      <a href="{{ route('admin.deletecoupon',@$item->id)}}" class="text-light">
                                                    <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                                                     </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
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


