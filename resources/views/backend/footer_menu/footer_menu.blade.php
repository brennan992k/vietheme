@extends('backend.master')
@section('mainContent')



<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.footer_menu') @lang('lang.list')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="{{ url('footer-menu')}}" class="active">@lang('lang.footer_menu') @lang('lang.list')</a>
                
            </div>
        </div>
    </div>
</section>


<section class="admin-visitor-area DM_table_info">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-3 ">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">

                                @if(isset($editData) && !empty(@$editData))
                                    @lang('lang.edit')
                                @else
                                    @lang('lang.add')
                                @endif
                                @lang('lang.footer_menu')
                            </h3>
                        </div>
                        @if(isset($editData) && !empty(@$editData))
                            <form action="{{url('footer-menu-store-update')}}"  method="POST" class="form-horizontal" enctype="multipart/form-data">
                                @else
                            <form action="{{url('footer-menu-store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data" id="addbadge">
                        @endif

                            @csrf

                        <div class="white-box ">
                            <div class="add-visitor {{!isset($editData)? 'disabledbutton':''}}">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('menu_title') ? ' is-invalid' : '' }}" type="text" name="menu_title"
                                                   autocomplete="off" value="{{isset($editData)? $editData->menu_title :old('menu_title')}}">

                                            <input type="hidden" name="id" value="{{isset($editData)? $editData->id: ''}}">
                                            <label>@lang('lang.menu_title') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('menu_title'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('menu_title') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('menu_url') ? ' is-invalid' : '' }}" type="text" name="menu_url" autocomplete="off" value="{{isset($editData)? $editData->menu_url:old('menu_url')}}">

                                            <label>@lang('lang.menu_url') </label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('menu_url'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('menu_url') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <select class="niceSelect w-100 bb form-control{{ $errors->has('position_no') ? ' is-invalid' : '' }}"
                                                name="position_no" id="position_no">
                                                <option data-display="Select Position No *"
                                                        value="">Select</option>
                                                @foreach($data as $key=>$value)
                                                    @if(isset($editData))
                                                        <option
                                                            value="{{$value->position_no}}" {{$value->position_no == $editData->position_no? 'selected':''}}>{{$value->position_no}}</option>
                                                    @else
                                                        <option value="{{$value->position_no}}" {{old('position_no')!=''? (old('position_no') == $value->position_no? 'selected':''):''}} >{{$value->position_no}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('position_no'))
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong>{{ $errors->first('position_no') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div> 
                                </div>
                                
                                <div class="row mt-50">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg">
                                            <span class="ti-check"></span>
                                            @if(isset($editData))
                                                @lang('lang.update')
                                            @else
                                                @lang('lang.save')
                                            @endif
                                            @lang('lang.menu')

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
                            <h3 class="mb-0">@lang('lang.footer_menu') @lang('lang.list')</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                           
                                <tr>
                                    <th>@lang('lang.position')</th>
                                    <th>@lang('lang.menu_title')</th>
                                    <th>@lang('lang.menu_url')</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                <tr>
                                    <td valign="top">{{$item->position_no}}</td>
                                   
                                    <td valign="top">{{@$item->menu_title}}</td>
                                    <td valign="top">{{@$item->menu_url}}</td>
                                    
                                    <td valign="top">
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{url('edit_footer-menu/'.@$item->id)}}">@lang('lang.edit')</a>
                                                
                                            </div>
                                        </div>
                                    </td>
                                </tr>
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


