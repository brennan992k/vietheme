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
            <h1>@lang('lang.category') @lang('lang.list')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="{{ route('admin.adCategory')}}" class="active">@lang('lang.category') @lang('lang.list')</a>
                @if(isset($data['edit']) && !empty(@$data['edit']))
                <a href="#" class="active">@lang('lang.category') @lang('lang.edit')</a>
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
                <a href="{{route('admin.adCategory')}}" class="primary-btn small fix-gr-bg">
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
                                @lang('lang.category')
                            </h3>
                        </div>
                        @if(isset($data['edit']) && !empty(@$data['edit']))
                            <form action="{{url('admin/add-category-store-update')}}"  method="POST" class="form-horizontal" enctype="multipart/form-data" id="addCategory">
                        @else
                            <form action="{{url('admin/add-category-store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data" id="addCategory">
                        @endif
                            @csrf

                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" type="text" name="title"
                                                   autocomplete="off" value="{{isset($data['edit'])? $data['edit']->title :old('title')}}">

                                            <input type="hidden" name="id" value="{{isset($data['edit'])? $data['edit']->id: ''}}">
                                            <label>@lang('lang.title') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('title'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" type="text" name="description" autocomplete="off" value="{{isset($data['edit'])? $data['edit']->description:old('description')}}">

                                            <label>@lang('lang.description') </label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('description'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <select class="niceSelect w-100 bb form-control{{ $errors->has('up_permission') ? ' is-invalid' : '' }}" name="up_permission">
                                                <option data-display="@lang('lang.up') @lang('lang.permission') *" value="">@lang('lang.up') @lang('lang.permission') *</option> 
                                                 <option value="1" {{ @$data['edit']->up_permission ==1 ?'selected':old('up_permission') ==(1 ? 'selected':'') }}>@lang('lang.yes')</option> 
                                                <option value="2" {{ @$data['edit']->up_permission ==2 ?'selected':old('up_permission') ==(2 ? 'selected':'')}}>@lang('lang.no')</option> 
                                            </select>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('up_permission'))
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong>{{ $errors->first('up_permission') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <select class="niceSelect w-100 bb form-control{{ $errors->has('up_permission') ? ' is-invalid' : '' }}" name="file_permission">
                                                <option data-display="@lang('lang.file') @lang('lang.permission') *" value="">@lang('lang.file') @lang('lang.permission') *</option> 
                                               <option value="1" {{ @$data['edit']->file_permission ==1 ?'selected':old('file_permission') ==(1 ? 'selected':'')}}>@lang('lang.yes')</option> 
                                                <option value="2" {{ @$data['edit']->file_permission ==2 ?'selected':old('file_permission') ==(2 ? 'selected':'')}}>@lang('lang.no')</option> 
                                            </select>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('file_permission'))
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong>{{ $errors->first('file_permission') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('recommended_price') ? ' is-invalid' : '' }}" type="text" name="recommended_price"
                                                   autocomplete="off" value="{{isset($data['edit'])? $data['edit']->recommended_price :old('recommended_price')}}">
                                            <label>@lang('lang.RECM_regular') @lang('lang.price') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('recommended_price'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('recommended_price') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('recommended_price_extended') ? ' is-invalid' : '' }}" type="text" name="recommended_price_extended"
                                                   autocomplete="off" value="{{isset($data['edit'])? $data['edit']->recommended_price_extended :old('recommended_price_extended')}}">
                                            <label>@lang('lang.RECM_extended')   @lang('lang.price') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('recommended_price_extended'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('recommended_price_extended') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('recommended_price_commercial') ? ' is-invalid' : '' }}" type="text" name="recommended_price_commercial"
                                                   autocomplete="off" value="{{isset($data['edit'])? $data['edit']->recommended_price_commercial :old('recommended_price_commercial')}}">
                                            <label>@lang('lang.RECM_commercial')   @lang('lang.price') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('recommended_price_commercial'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('recommended_price_commercial') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                            <div class="">
                                            <input type="checkbox" id="category" class="common-checkbox" name="show_menu" value="1" {{isset($data['edit'])?(@$data['edit']->show_menu == 1? 'checked':''):''}}>
                                            <label for="category">@lang('lang.show_in_menu')</label>
                                        </div>
                                    </div>
                                </div>

                                @if (isset($data['edit']))
                                    
                               
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <select id="category_status" class="niceSelect w-100 bb form-control{{ $errors->has('active_status') ? ' is-invalid' : '' }}" onchange="changeOrder()" name="active_status">
                                                <option data-display="@lang('lang.status') *" value="">@lang('lang.status') *</option> 
                                                <option value="1" {{ @$data['edit']->active_status ==1 ?'selected':old('active_status') ==(1 ? 'selected':'')}}>@lang('lang.active')</option> 
                                                <option value="2" {{ @$data['edit']->active_status ==2 ?'selected':old('active_status') ==(2 ? 'selected':'')}}>@lang('lang.inactive')</option> 
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
                                @endif
                                @php
                                    $categories_position=ItemCategory();
                                    $positions=[];
                                    $order=[];
                                    foreach($categories_position as $cat_position){
                                        $positions[$cat_position->id]=$cat_position->position;
                                    }
                                    $category_count=$categories_position->count();
                                    for ($i=1; $i < $category_count+1; $i++) { 
                                       $order[$i]=$i;
                                    }
                                    $positions=array_diff($order,$positions);
                                    $max_order=max($order)+1;
                                   
                                @endphp

                                <div class="row mt-25 dm_display_none" id="position_div" >
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <select class="niceSelect w-100 bb form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" name="position">
                                                <option data-display="@lang('lang.position') *" value="">@lang('lang.position') *</option> 
                                               @foreach ($order as $orde)
                                               
                                            <option data-display="{{ $orde }}" value="{{ $orde }}" >{{ $orde }}</option> 
                                               @endforeach
                                               <option data-display="{{ $max_order }}" value="{{ $max_order }}">{{ $max_order }}</option> 
                                            </select>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('position'))
                                            <span class="invalid-feedback invalid-select" role="alert">
                                                <strong>{{ $errors->first('position') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if (@$data['edit']->active_status==1)
                                    <div class="row mt-25">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <select class="niceSelect w-100 bb form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" name="position">
                                                    <option data-display="@lang('lang.position') *" value="">@lang('lang.position') *</option> 
                                                    <option data-display="{{ @$data['edit']->position }}" value="{{ @$data['edit']->position }}">{{ @$data['edit']->position }}</option> 
                                                    
                                                    @foreach ($order as $orde)
                                                    <option data-display="{{ $orde }}" value="{{ $orde }}" {{ @$data['edit']->position ==$orde ? 'selected':''}}>{{ $orde }}</option> 
                                                   @endforeach

                                                </select>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('position'))
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong>{{ $errors->first('position') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                                
                                <div class="row mt-50">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg">
                                            <span class="ti-check"></span>
                                            @if(isset($data['edit']))
                                                @lang('lang.update')
                                            @else
                                                @lang('lang.save')
                                            @endif
                                            @lang('lang.category')

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
                            <h3 class="mb-0">@lang('lang.category') @lang('lang.list')</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                           
                                <tr>
                                    <th>@lang('lang.position')</th>
                                    <th>@lang('lang.up') @lang('lang.permission')</th>
                                    <th>@lang('lang.file') @lang('lang.permission')</th>
                                    <th>@lang('lang.title')</th>
                                    <th>@lang('lang.RECM_regular')</th>
                                    <th>@lang('lang.RECM_extended')</th>
                                    <th>@lang('lang.RECM_commercial')</th>
                                    
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['category'] as $item)
                                <tr>
                                    <td valign="top">{{$item->position}}</td>
                                    <td valign="top">
                                                    @if (@$item->up_permission == 1)
                                                    @lang('lang.yes')
                                                    @else   
                                                    @lang('lang.no')
                                                    @endif
                                    </td>
                                    <td valign="top">
                                                    @if (@$item->file_permission == 1)
                                                    @lang('lang.yes')
                                                    @else   
                                                    @lang('lang.no')
                                                    @endif
                                    </td>
                                    <td valign="top">{{@$item->title}}</td>
                                    <td valign="top">{{@$item->recommended_price}}</td>
                                    <td valign="top">{{@$item->recommended_price_extended}}</td>
                                    <td valign="top">{{@$item->recommended_price_commercial}}</td>
                                    
                                    <td valign="top">
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{url('admin/add-category-edit/'.@$item->id)}}">@lang('lang.edit')</a>
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteClassModal{{@$item->id}}"  href="#">@lang('lang.delete')</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                  <div class="modal fade admin-query" id="deleteClassModal{{@$item->id}}" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('lang.delete') @lang('lang.category')</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                      <a href="{{ route('admin.deleteCategory',@$item->id)}}" class="text-light">
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


