@extends('backend.master')
@section('mainContent')
<link rel="stylesheet" href="{{ asset('public/backEnd/css/') }}/package.css">
<script src="https://cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.package') @lang('lang.list')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="{{ route('admin.package')}}" class="active">@lang('lang.package') @lang('lang.list')</a>
                @if(isset($data['edit']) && !empty(@$data['edit']))
                <a href="#" class="active">@lang('lang.package') @lang('lang.edit')</a>
            @endif
            </div>
        </div>
    </div>
</section>


<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        @if(isset($data['edit']) && !empty(@$data['edit']))
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="{{route('admin.package')}}" class="primary-btn small fix-gr-bg">
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
                                @lang('lang.package')
                            </h3>
                        </div>
                        @if(isset($data['edit']) && !empty(@$data['edit']))
                            <form action="{{url('admin/package-update')}}"  method="POST" class="form-horizontal" enctype="multipart/form-data" id="addpackage">
                        @else
                            <form action="{{url('admin/package-store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data" id="addpackage">
                        @endif
                            @csrf

                        <div class="white-box">
                            <div class="add-visitor">
                                    <input type="hidden" name="id" value="{{isset($data['edit'])? $data['edit']->id: ''}}">
                            <div class="row mt-0">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <select class="niceSelect w-100 bb form-control{{ $errors->has('package_type') ? ' is-invalid' : '' }}" name="package_type">
                                                <option data-display="@lang('lang.package') @lang('lang.type') *" value=""> @lang('lang.package') @lang('lang.type') *</option> 
                                                @foreach ($data['package_type'] as $item)
                                                    <option value="{{ @$item->id}}" {{isset($data['edit'])? $data['edit']->package_type == $item->id?'selected':'': ''}} >{{ @$item->name }}</option> 
                                                @endforeach
                                            </select>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('package_type'))
                                            <span class="invalid-feedback " role="alert">
                                                <strong>{{ $errors->first('package_type') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-40">
                                        <div class="col-lg-12"> 
                                                <label>@lang('lang.description')  <span class="text-red">*</span></label>
                                            <div class="input-effect">
                                                <textarea id="editor" class="primary-input form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="" cols="30" rows="10" data-sample-short>{!! isset($data['edit'])? $data['edit']->description:old('description') !!}</textarea> 
                                                
                                                <span class="focus-border"></span>
                                                @if ($errors->has('description'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                                @endif
                                            </div> 
                                        </div> 
                                    </div>
                             {{--    <div class="row mt-25">
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
                                </div> --}}
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('total_item') ? ' is-invalid' : '' }}" type="text" name="total_item"
                                                   autocomplete="off" value="{{isset($data['edit'])? $data['edit']->total_item :old('total_item')}}">
                                            <label>@lang('lang.item') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('total_item'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('total_item') }}</strong>
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
                                                        <input class="primary-input" name="iconImg" type="text" id="placeholderPhoto" placeholder="@lang('lang.upload_icon')"
                                                            readonly="">
                                                        <span class="focus-border"></span>
                                                    </div>
                                                    <small>@lang('lang.please_input')</small>
                                                </div>
                                                <div class="col-auto">
                                                    <button class="primary-btn-small-input" type="button">
                                                        <label class="primary-btn small fix-gr-bg" for="image">@lang('lang.browse')</label>
                                                        <input type="file" class="d-none" name="image" id="image" value="{{isset($data['edit'])? $data['edit']->image :old('image')}}">
                                                    </button>
                                                </div>
                                            </div>
                                            @if ($errors->has('image'))
                                                    <span class="invalid-feedback dm_display_block" role="alert" >
                                                <strong>{{ $errors->first('image') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <select class="niceSelect w-100 bb form-control{{ $errors->has('session') ? ' is-invalid' : '' }}" name="active_status">
                                                <option data-display="@lang('lang.status') *" value="">@lang('lang.status') *</option> 
                                                <option value="1" {{isset($data['edit'])? $data['edit']->status == 1?'selected':'': 'selected'}} >@lang('lang.active')</option> 
                                                <option value="2" {{isset($data['edit'])? $data['edit']->status == 2?'selected':'': ''}}>@lang('lang.inactive')</option> 
                                            </select>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('session'))
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
                                            @lang('lang.package')

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
                        <div class="main-title">
                            <h3 class="mb-0">@lang('lang.package') @lang('lang.list')</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                           
                                <tr>
                                    <th>@lang('lang.name')</th>
                                    <th>@lang('lang.amount')</th>
                                    <th>@lang('lang.item')</th>
                                    <th>@lang('lang.description')</th>
                                    <th>@lang('lang.status')</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['package'] as $item)
                                <tr>
                                    <td valign="top">{{@$item->packageType->name}}</td>
                                    <td valign="top">{{@$item->packageType->month}}</td>
                                    <td valign="top">{{@$item->total_item}}</td>
                                    <td valign="top">{!!  @$item->description  !!}</td>
                                    <td valign="top">
                                        <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            @if ($item->status == 1)
                                            @lang('lang.active')
                                            @else   
                                            @lang('lang.inactive')
                                            @endif
                                        </button>
                                        </div>
                                    </td>
                                    <td valign="top">
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{url('admin/package-edit/'.@$item->id)}}">@lang('lang.edit')</a>
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteClassModal{{@$item->id}}"  href="{{url('item-delete/')}}">@lang('lang.delete')</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                  <div class="modal fade admin-query" id="deleteClassModal{{@$item->id}}" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('lang.delete') @lang('lang.package')</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                      <a href="{{ route('admin.deletepackage',$item->id)}}" class="text-light">
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

@section('script')
      
<script src="{{asset('public/backEnd/backend.js')}}"></script>
@endsection

@endsection


