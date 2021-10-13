@extends('backend.master')
@section('mainContent')

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.Product') @lang('lang.update') @lang('lang.list')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#" class="active">@lang('lang.Product') @lang('lang.update')  @lang('lang.list')</a>
            </div>
        </div>
    </div>
</section>


<section class="admin-visitor-area DM_table_info">
    <div class="container-fluid p-0">
       

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title sm_mb_20 lm_mb_35">
                            <h3 class="mb-0">@lang('lang.Product') @lang('lang.preview') @lang('lang.list') </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                    <div class="col-lg-12">
                        
                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                           
                                <tr>
                                    <th>@lang('lang.id')</th>
                                    <th>@lang('lang.title')</th>
                                    <th>@lang('lang.category')</th>
                                    <th>@lang('lang.demo') @lang('lang.url')</th>
                                    <th>@lang('lang.image')</th>
                                    <th>@lang('lang.price')</th>
                                    <th>@lang('lang.author')</th>
                                    <th>@lang('lang.sell')</th>
                                    <th>@lang('lang.status')</th>
                                    <th>@lang('lang.feedback')</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach($data as $key => $item)
                                <tr>
                                    <td valign="top">{{$i++}}</td>
                                    <td valign="top"><a target="_blank" href="{{ route('singleProduct',[str_replace(' ', '-',@$item->title),@$item->id])}}">{{Str::limit(@$item->title,20)}}</a></td>
                                    <td valign="top">{{@$item->category->title}} / {{@$item->subCategory->title}}</td>
                                    <td valign="top"><a href="{{@$item->demo_url}}" target="_blank" class="primary-btn small fix-gr-bg">Click here</a></td>
                                    <td valign="top"><img src="{{asset(@$item->icon)}}" class="content_list_wh_40"></td>
                                    <td valign="top">{{@GeneralSetting()->currency_symbol}}{{@$item->Reg_total}}</td>
                                    <td aign="top"><a target="_blank" href="{{ route('user.profile',@$item->user->username)}}">{{@$item->user->username }}</a></td>
                                    <td>{{ @$item->sell }}</td>
                                    <td valign="top">
                                                @if (@$item->active_status == 0)
                                                @lang('lang.pending')
                                                @endif
                                                @if ( @$item->active_status == 2)                                        
                                                <font color="orange"> @lang('lang.soft_rejected')</font>
                                                @endif
                                                @if ( @$item->active_status == 3)                                        
                                                <font color="red"> @lang('lang.hard_rejected')</font>
                                                @endif
                                    </td>
                                    <td><a valign="top"><a href="" data-toggle="modal" data-target="#FeedBack{{$item->id}}"  class="primary-btn small fix-gr-bg">@lang('lang.feedback')</a></td>  </td>
                                    <td valign="top">
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                             <a class="dropdown-item" target="_blank" href="{{ route('singleProduct',[str_replace(' ', '-',@$item->title),@$item->item_id])}}">@lang('lang.view')</a>
                                                <a class="dropdown-item" target="_blank" href="{{ route('admin.contentEdit',@$item->item_id)}}">@lang('lang.edit')</a>
                                                <a class="dropdown-item" target="_blank" href="{{ route('admin.ProductDownload',@$item->item_id) }}">@lang('lang.download')</a> 
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteClassModal{{@$item->id}}"  href="">@lang('lang.delete')</a>     
                                                <a class="dropdown-item" href="{{ route('admin.item_feedback_direct',@$item->id) }}">@lang('lang.approve')</a>                           
                                                @if (@$item->active_status == 1)
                                                   <a class="dropdown-item" data-toggle="modal" data-target="#ApproveClassModal{{@$item->id}}"  href="">   @lang('lang.deactive')  </a>
                                                @else   
                                                   <a class="dropdown-item" data-toggle="modal" data-target="#ApproveClassModal{{@$item->id}}"  href=""> @lang('lang.approve')</a>
                                                @endif
                                                   
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                  <div class="modal fade admin-query" id="deleteClassModal{{@$item->id}}" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('lang.delete') @lang('lang.item')</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                    <a href="{{ route('admin.previewitemDelete',@$item->id) }}" class="text-light">
                                                    <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                                                     </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                    <div class="modal fade admin-query " id="FeedBack{{@$item->id}}" >
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">@lang('lang.product') @lang('lang.feedback') </h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
    
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.item_review_feedback',@$item->id)}}" method="POST">
                                                        @csrf
                                                        <div class="row mt-40 main_color">
                                                            <div class="col-lg-12">
                                                                    <label>@lang('lang.author') @lang('lang.message')   <span class="text-red">*</span></label>
                                                                <div class="input-effect">
                                                                    <small>{!! @$item->user_msg !!}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-40">
                                                            <div class="col-lg-12">
                                                                <label>@lang('lang.subject')   <span class="text-red">*</span></label>
                                                                <div class="input-effect">
                                                                    <input class="primary-input form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" id="subject" name="subject">
                                                                    <span class="invalid-feedback dm_display_block mt-0"  role="alert"><strong id="subject_error"></strong></span>
                                                                    <span class="focus-border"></span>
                                                                    @if ($errors->has('subject'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('subject') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-40">
                                                            <div class="col-lg-12">
                                                                    <label>@lang('lang.reply')   <span class="text-red">*</span></label>
                                                                <div class="input-effect">
                                                                    <textarea id="summernote" class="primary-input summernote form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="" cols="30" rows="10" data-sample-short>{{  old('description')}}</textarea>
                        
                                                                    <span class="focus-border"></span>
                                                                    @if ($errors->has('description'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('description') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-40">
                                                            <div class="col-lg-12">
                                                                    <label>@lang('lang.status')   <span class="text-red">*</span></label>
                                                                <div class="input-effect">
                                                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status">
                                                                                <option data-display="@lang('lang.status') *" value="">@lang('lang.status') *</option> 
                                                                                <option value="1" {{isset($data['edit'])? $data['edit']->status == 1?'selected':'': 'selected'}} >@lang('lang.approve')</option> 
                                                                                <option value="2" {{isset($data['edit'])? $data['edit']->status == 2?'selected':'': ''}}>@lang('soft') @lang('lang.reject')</option> 
                                                                                <option value="3" {{isset($data['edit'])? $data['edit']->status == 2?'selected':'': ''}}>@lang('hard') @lang('lang.reject')</option> 
                                                                            </select>
                                                                            <span class="focus-border"></span>
                                                                            @if ($errors->has('status'))
                                                                            <span class="invalid-feedback " role="alert">
                                                                                <strong>{{ $errors->first('status') }}</strong>
                                                                            </span>
                                                                            @endif
                                                                </div>
                                                            </div>
                                                        </div>
    
                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                        <a href="{{ route('admin.itemDelete',$item->id) }}" class="text-light">
                                                        <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.submit')</button>
                                                         </a>
                                                    </div>
                                                </form>
    
                                                </div>
    
                                            </div>
                                        </div>
                                    </div>
                                  <div class="modal fade admin-query" id="ApproveClassModal{{@$item->id}}" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('lang.item')</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                        @if (@$item->active_status == 1)
                                                        <h4>@lang('lang.are_you_want_to_deactive')</h4>
                                                        @else   
                                                        <h4>@lang('lang.are_you_want_to_Approve')</h4>
                                                        @endif
                                                        {{-- <h4>@lang('lang.are_you_want_to_Approve')</h4> --}}
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                    <a href="{{ route('admin.item_preview_approve',@$item->id) }}" class="text-light">
                                                            @if (@$item->active_status == 1)
                                                                <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.deactive')</button>
                                                            @else   
                                                                 <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.approve')</button>
                                                            @endif
                                                            {{-- <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.approve')</button> --}}
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
</section>

@endsection



