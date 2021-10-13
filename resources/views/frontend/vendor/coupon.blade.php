@extends('frontend.master')
@push('css')
  <link rel="stylesheet" href="{{ asset('public/frontend/') }}/coupon.css">
@endpush
@section('content')
<input type="text" hidden  class="id" value="{{ Auth::user()->id}}">
    <!-- banner-area start -->
    <div class="banner-area4">
            <div class="banner-area-inner">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-xl-6">
                            <div class="banner-info knowledge_title">
                                <h2>@lang('lang.coupon_item')</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- banner-area end -->
    
        <!-- upload_area _start -->
        <div class="upload_area section-padding">
            <div class="container">
                    <div class="satements_area">
                            <div class="row">
                                <div class="col-xl-8">
                                    <div class="statement_details gray-bg">
                                        <div class="d-flex align-items-center justify-content-between pb-5">
                                                <div>
                                                    <h4 class="">@lang('lang.coupon_list')</h4>
                                                </div>
                                                <div>
                                                        @if (@$data['edit'])
                                                          <a href="{{ route('author.coupon_list')}}" class="boxed-btn">@lang('lang.add_coupon')</a>
                                                        @endif
                                                </div>
                                        </div>
                                        <div class="statement_table ">
                                            <table class="table">
                                                <thead>
                                                    <tr class="table-row">
                                                        <th scope="col">@lang('lang.coupon_name')</th>
                                                        <th scope="col">@lang('lang.coupon_code')</th>
                                                        <th scope="col">@lang('lang.discount')</th>
                                                        <th scope="col">@lang('lang.valid_date')</th>
                                                        <th scope="col">@lang('lang.status')</th>
                                                        <th scope="col">@lang('lang.action')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data['coupon'] as $key => $item)
                                                    <tr>
                                                        <td data-label="Account">{{ @$item->name}}</td>
                                                        <td data-label="Due Date">{{ @$item->code}}</td>
                                                        <td data-label="Due Date">{{ @$item->discount}}</td>
                                                        <td data-label="Period2">{{ date('F j, Y',strtotime(@$item->to))}}</td>
                                                        <td  data-label="Period"> {{ @$item->status == 1?'Active':'Pending'}}</td>
                                                        <td  data-label="Period red">
                                                        <a href="{{ route('author.couponEdit',@$item->id)}}" class="edit"> <i class="ti-pencil-alt"></i></a>
                                                            <a  onclick="deleItem({{@$key}})" class="trash"> <i class="ti-trash"></i></a>
                                                            <a id="delete-form-{{ @$key }}" href="{{ route('author.couponDelete',@$item->id)}}" class="dm_display_none">
                                                               
                                                            </a>
                                                        </td>
                                                    </tr>                                                        
                                                    @endforeach
                                                    
                                                </tbody>
                                            </table>
                                            <div class="Pagination">
                                                    {{ @$data['coupon']->onEachSide(1)->links('frontend.paginate.frontentPaginate') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="author_setting_bar gray-bg">
                                        <h3>{{isset($data['edit'])? 'Edit' :'Add'}} @lang('lang.coupon')</h3>
                                        
                                        <div class="earning_taks d-flex justify-content-between align-content-center">
                                            @if (@$data['edit'])
                                                 <form action="{{ route('author.couponUpdate',@$data['edit']->id)}}" method="POST" id="couponStore" enctype="multipart/form-data">
                                             @else   
                                                <form action="{{ route('author.couponStore')}}" method="POST" id="couponStore" enctype="multipart/form-data">
                                            @endif
                                                    @csrf
                                                <div class="single_upload_area">
                                                    <div class="upload_description gray-bg couponAdd">
                                                            
                                                        <input type="text" name="name" id="" placeholder="Name*" value="{{isset($data['edit'])? $data['edit']->name :old('name')}}">
                                                        @if ($errors->has('name'))
                                                        <span class="invalid-feedback invalid-select error"
                                                                role="alert">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                        @endif
                                                        <input type="text" name="discount" id="" placeholder="Discount" value="{{isset($data['edit'])? $data['edit']->discount :old('discount')}}">
                                                        @if ($errors->has('discount'))
                                                        <span class="invalid-feedback invalid-select error"
                                                                role="alert">
                                                            <strong>{{ $errors->first('discount') }}</strong>
                                                        </span>
                                                        @endif
                                                        <input type="date" name="valid_date" id=""  value="{{ old('valid_date') }}" value="{{isset($data['edit'])? date('y-m-d',strtotime($data['edit']->valid_date)) :old('valid_date')}}">
                                                        @if ($errors->has('valid_date'))
                                                        <span class="invalid-feedback invalid-select error"
                                                                role="alert">
                                                            <strong>{{ $errors->first('valid_date') }}</strong>
                                                        </span>
                                                        @endif
                                                        <select class="wide dm_display_none"  name="status" id="status">
                                                                <option data-display="status*">@lang('lang.status') *</option>
                                                                <option value="1" {{isset($data['edit'])? $data['edit']->status == 1?'selected':'': 'selected'}} >@lang('lang.active')</option> 
                                                                <option value="2" {{isset($data['edit'])? $data['edit']->status == 2?'selected':'': ''}}>@lang('lang.pending')</option> 
                                                        </select>
                                                            
                                                    </div>
                                                </div>
                                                 <button  class="boxed-btn mt-20" type="submit">@lang('lang.submit')</button>
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
@endsection
@push('js')
<script src="{{ asset('public/frontend/js/') }}/coupon.js"></script>
<script src="{{ asset('public/frontend/js/') }}/delete.js"></script>
@endpush