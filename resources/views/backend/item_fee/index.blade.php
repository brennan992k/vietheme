@extends('backend.master')
@section('mainContent')

    @php
        function showPicName($data){
            $name = explode('/', $data);
            return $name[3];
        }
    @endphp

    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('lang.buyer') @lang('lang.fee') @lang('lang.list')</h1>
                <div class="bc-pages">
                    <a href="{{route('admin.dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#" class="active">@lang('lang.buyer') @lang('lang.fee') @lang('lang.list')</a>
                </div>
            </div>
        </div>
    </section>


    <section class="admin-visitor-area DM_table_info">
        <div class="container-fluid p-0">
            @if(isset($data['edit']) && !empty(@$data['edit']))
                <div class="row">
                    <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                        <a href="{{ route('admin.subCategory')}}" class="primary-btn small fix-gr-bg">
                            <span class="ti-plus pr-2"></span>
                            @lang('lang.add')
                        </a>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-30">

                                    @if(isset($data['edit']) && !empty(@$data['edit']))
                                        @lang('lang.edit')
                                    @else
                                        @lang('lang.add')
                                    @endif
                                    @lang('lang.buyer') @lang('lang.fee') 
                                </h3>
                            </div>
                            @if(isset($data['edit']) && !empty(@$data['edit']))
                                <form action="{{url('admin/item-fee-update')}}" method="POST"
                                      class="form-horizontal" enctype="multipart/form-data">
                                    @else
                                        <form action="{{url('admin/item-fee-store')}}" method="POST"
                                              class="form-horizontal" enctype="multipart/form-data">
                                            @endif
                                            @csrf

                                            <div class="white-box">
                                                <div class="add-visitor">
                                                    <div class="row mb-25">
                                                        <div class="col-lg-12">
                                                            <div class="input-effect">
                                                                <select class="niceSelect w-100 bb form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}"
                                                                        name="category_id">
                                                                    <option data-display="@lang('lang.category') *"
                                                                            value="">@lang('lang.category') *
                                                                    </option>
                                                                    @foreach($data['category'] as $item)
                                                                        <option value={{@$item->id}} {{ @$item->id == @$data['edit']->category_id ?'selected':old('category_id') == (@$item->id ? 'selected':'')}}>{{@$item->title}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <span class="focus-border"></span>
                                                                @if ($errors->has('category_id'))
                                                                    <span class="invalid-feedback invalid-select"
                                                                          role="alert">
                                                                        <strong>{{ $errors->first('category_id') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-25">
                                                        <div class="col-lg-12">
                                                            <div class="input-effect">
                                                                <input class="primary-input form-control{{ $errors->has('re_fee') ? ' is-invalid' : '' }}"
                                                                       type="number" name="re_fee" autocomplete="off"
                                                                       value="{{isset($data['edit'])? $data['edit']->re_fee:old('re_fee')}}">
                                                                  <label>@lang('lang.regular_buyer_Fee')</label>
                                                                <span class="focus-border"></span>
                                                                @if ($errors->has('re_fee'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('re_fee') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-25">
                                                        <div class="col-lg-12">
                                                            <div class="input-effect">
                                                                <input class="primary-input form-control{{ $errors->has('ex_fee') ? ' is-invalid' : '' }}"
                                                                       type="number" name="ex_fee" autocomplete="off"
                                                                       value="{{isset($data['edit'])? $data['edit']->ex_fee:old('ex_fee')}}">

                                                                     <input type="hidden" name="id"
                                                                       value="{{isset($data['edit'])? $data['edit']->id: ''}}">
                                                                <label>@lang('lang.extend_buyer_Fee') </label>
                                                                <span class="focus-border"></span>
                                                                @if ($errors->has('ex_fee'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('ex_fee') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-25">
                                                        <div class="col-lg-12">
                                                            <div class="input-effect">
                                                                <input class="primary-input form-control{{ $errors->has('co_fee') ? ' is-invalid' : '' }}"
                                                                       type="number" name="co_fee" autocomplete="off"
                                                                       value="{{isset($data['edit'])? $data['edit']->co_fee:old('co_fee')}}">

                                                                <label>@lang('lang.commercial_buyer_Fee') </label>
                                                                <span class="focus-border"></span>
                                                                @if ($errors->has('co_fee'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('co_fee') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-25">
                                                        <div class="col-lg-12">
                                                            <div class="input-effect">
                                                                <input class="primary-input form-control{{ $errors->has('support_fee') ? ' is-invalid' : '' }}"
                                                                       type="text" name="support_fee" autocomplete="off"
                                                                       value="{{isset($data['edit'])? $data['edit']->support_fee:old('support_fee')}}">

                                                                     <input type="hidden" name="id"
                                                                       value="{{isset($data['edit'])? $data['edit']->id: ''}}">
                                                                <label>@lang('lang.extend_support_Fee') (%) </label>
                                                                <span class="focus-border"></span>
                                                                @if ($errors->has('support_fee'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('support_fee') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                               
                                                    <div class="row mt-25">
                                                        <div class="col-lg-12">
                                                            <div class="input-effect">
                                                                <select class="niceSelect w-100 bb form-control{{ $errors->has('status') ? ' is-invalid' : '' }}"
                                                                        name="status">
                                                                    <option data-display="@lang('lang.status') *"
                                                                            value="">@lang('lang.status') *
                                                                    </option>
                                                                    <option value="1" {{ @$data['edit']->status ==1 ?'selected':old('status') ==(1 ? 'selected':'')}}>@lang('lang.active')</option>
                                                                    <option value="2" {{ @$data['edit']->status ==2 ?'selected':old('status') ==(2 ? 'selected':'')}}>@lang('lang.inactive')</option>
                                                                </select>
                                                                <span class="focus-border"></span>
                                                                @if ($errors->has('status'))
                                                                    <span class="invalid-feedback invalid-select"
                                                                          role="alert">
                                                                        <strong>{{ $errors->first('status') }}</strong>
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

                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title sm_mb_20 lm_mb_35">
                                <h3 class="mb-0">@lang('lang.buyer') @lang('lang.fee') @lang('lang.list') </h3>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">

                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                                <thead>

                                <tr>
                                    <th>@lang('lang.category')</th>
                                    <th>@lang('lang.regular_buyer_Fee')</th>
                                    <th>@lang('lang.extend_buyer_Fee')</th>
                                    <th>@lang('lang.commercial_buyer_Fee')</th>
                                    <th>@lang('lang.extend_support_Fee')</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data['item_fee'] as $item)
                                    <tr>
                                        <td valign="top">{{@$item->category !=""? @$item->category->title:""}}</td>
                                        <td valign="top">{{@$item->re_fee}}</td>
                                        <td valign="top">{{@$item->ex_fee}}</td>
                                        <td valign="top">{{@$item->co_fee}}</td>
                                        <td valign="top">{{@$item->support_fee}} (%)</td>
                                        <td valign="top">
                                            <div class="dropdown">
                                                <button type="button" class="btn dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    @lang('lang.select')
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{ route('admin.itemFeeEdit',@$item->id)}}">@lang('lang.edit')</a>
                                                    <a class="dropdown-item" data-toggle="modal"
                                                       data-target="#deleteClassModal{{@$item->id}}"
                                                       href="#">@lang('lang.delete')</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade admin-query" id="deleteClassModal{{@$item->id}}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">@lang('lang.delete') @lang('lang.buyer') @lang('lang.fee')</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                    </div>

                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg"
                                                                data-dismiss="modal">@lang('lang.cancel')</button>
                                                        <a href="{{ route('admin.itemFeeDelete',@$item->id)}}" class="text-light">
                                                            <button class="primary-btn fix-gr-bg"
                                                                    type="submit">@lang('lang.delete')</button>
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




