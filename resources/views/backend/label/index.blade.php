@extends('backend.master')
@push('css')
  
@endpush
@section('mainContent')

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.level') @lang('lang.list')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="{{ route('admin.label')}}" class="active">@lang('lang.level') @lang('lang.list')</a>
                @if(isset($data['edit']) && !empty(@$data['edit']))
                <a href="#" class="active">@lang('lang.level') @lang('lang.edit')</a>
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
                <a href="{{route('admin.label')}}" class="primary-btn small fix-gr-bg">
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
                        <div class="main-title ">
                            <h3 class="mb-30">

                                @if(isset($data['edit']) && !empty(@$data['edit']))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.level')
                            </h3>
                        </div>
                        @if(isset($data['edit']) && !empty(@$data['edit']))
                            <form action="{{url('admin/label-update')}}"  method="POST" class="form-horizontal" enctype="multipart/form-data" id="addlabel">
                        @else
                            <form action="{{url('admin/label-store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data" id="addlabel">
                        @endif
                            @csrf

                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row mt-0">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('rate') ? ' is-invalid' : '' }}" type="text" name="rate"
                                                   autocomplete="off" value="{{isset($data['edit'])? $data['edit']->rate :old('rate')}}">

                                            <input type="hidden" name="id" value="{{isset($data['edit'])? $data['edit']->id: ''}}">
                                            <label>@lang('lang.rate') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('rate'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('rate') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" type="text" name="amount"
                                                   autocomplete="off" value="{{isset($data['edit'])? $data['edit']->amount :old('amount')}}">
                                            <label>@lang('lang.amount') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('amount'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('amount') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="row no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input {{ $errors->has('icon') ? ' is-invalid' : '' }}" type="text"
                                                          id="placeholderPhoto"
                                                           placeholder="@lang('lang.upload_icon') "
                                                           readonly="">
                                                    <span class="focus-border"></span>
                                                </div>
                                                <small>@lang('lang.please_input')</small>
                                            </div>
                                            <div class="col-auto">
                                                <button class="primary-btn-small-input"
                                                        type="button">
                                                    <label class="primary-btn small fix-gr-bg"
                                                           for="photo">@lang('lang.browse')</label>
                                                    <input type="file" class="d-none" name="icon"
                                                    id="photo">
                                                </button>
                                                
                                            </div>
                                        </div>
                                        @if ($errors->has('icon'))
                                        <span class="invalid-feedback dm_display_block" role="alert" >
                                      <strong>{{ $errors->first('icon') }}</strong>
                                     </span>
                                  @endif
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
                                            @lang('lang.level')

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
                        <div class="main-title lm_mb_35 sm_mb_20">
                            <h3 class="mb-0">@lang('lang.level') @lang('lang.list')</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                           
                                <tr>
                                    <th>@lang('lang.sl')</th>
                                    <th>@lang('lang.icon')</th>
                                    <th>@lang('lang.rate')</th>
                                    <th>@lang('lang.amount')</th>
                                    <th>@lang('lang.status')</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['label'] as $item)
                                <tr>
                                    <td valign="top">{{ @$item->id}}</td>
                                    <td valign="top"><img src="{{ asset(@$item->icon)}}" width="30" alt=""></td>
                                    <td valign="top">{{@$item->rate}}%</td>
                                    <td valign="top">{{@GeneralSetting()->currency_symbol}}{{@$item->amount}}</td>
                                    <td valign="top">
                                            @if (@$item->status == 1)
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
                                                <a class="dropdown-item" href="{{url('admin/label-edit/'.@$item->id)}}">@lang('lang.edit')</a>
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteClassModal{{@$item->id}}"  href="{{url('item-delete/')}}">@lang('lang.delete')</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                  <div class="modal fade admin-query" id="deleteClassModal{{@$item->id}}" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('lang.delete') @lang('lang.label')</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                      <a href="{{ route('admin.deletelabel',@$item->id)}}" class="text-light">
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


