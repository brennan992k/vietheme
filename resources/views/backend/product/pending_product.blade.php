@extends('backend.master')
@section('mainContent')
<link rel="stylesheet" href="{{ asset('public/backEnd/css/') }}/pending_product.css">
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.Product') @lang('lang.pending') @lang('lang.list')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#" class="active">@lang('lang.Product') @lang('lang.pending') @lang('lang.list')</a>
            </div>
        </div>
    </div>
</section>


<section class="admin-visitor-area DM_table_info">
    <div class="container-fluid p-0">
       

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title sm_mb_20 lm_mb_35>
                            <h3 class="mb-0">@lang('lang.Product') @lang('lang.pending') @lang('lang.list') </h3>
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
                                    <th>@lang('lang.feedback')</th>
                                    <th>@lang('lang.status')</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['item'] as $key => $item)
                                <tr>
                                    <td valign="top">{{ $key+1 }}</td>
                                    <td valign="top"><a target="_blank" href="{{ route('admin.product_viewSingle',[str_replace(' ', '-',@$item->title),$item->id])}}">{{Str::limit(@$item->title,20)}}</a></td>
                                    <td valign="top">{{@$item->category->title}} / {{@$item->subCategory->title}}</td>
                                    <td valign="top"><a href="{{@$item->demo_url}}" target="_blank" class="primary-btn small fix-gr-bg">@lang('lang.click_here')</a></td>
                                    <td valign="top"><img src="{{asset(@$item->icon)}}" class="content_list_wh_40"></td>
                                    <td valign="top">{{@GeneralSetting()->currency_symbol}}{{@$item->Reg_total}}</td>
                                    <td aign="top"><a target="_blank" href="{{ route('user.profile',@$item->user->username)}}">{{@$item->user->username }}</a></td>
                                    <td valign="top"><a href="" data-toggle="modal" data-target="#FeedBack{{$item->id}}"  class="primary-btn small fix-gr-bg">@lang('lang.feedback')</a></td>
                                    <td valign="top">
                                                @if (@$item->status == 2)
                                                @lang('lang.soft_rejected')
                                                @endif   
                                                @if (@$item->status == 0)
                                                @lang('lang.pending')
                                                @endif
                                                @if (@$item->status == 3)
                                                @lang('lang.hard_rejected')
                                                @endif
                                    </td>
                                    
                                    <td valign="top">
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                             <a class="dropdown-item" target="_blank" href="{{ route('admin.product_viewSingle',[str_replace(' ', '-',@$item->title),@$item->id])}}">@lang('lang.view')</a>
                                                <a class="dropdown-item" target="_blank" href="{{ route('admin.contentEdit',@$item->id)}}">@lang('lang.edit')</a> 
                                                <a class="dropdown-item" target="_blank" href="{{ route('admin.ProductDownload',@$item->id) }}">@lang('lang.download')</a> 
                                                <a class="dropdown-item" href="{{ route('admin.itemApprove',@$item->id) }}">@lang('lang.approve')</a> 
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteClassModal{{@$item->id}}"  href="">@lang('lang.delete')</a>                                                 
                                                
                                                   
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                  <div class="modal fade admin-query Feedb" id="FeedBack{{@$item->id}}" >
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('lang.product') @lang('lang.feedback') </h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <form action="{{ route('admin.item_feedback',@$item->id)}}" method="POST" id="Feedback_form">
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
                                                                    <input class="primary-input form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject" id="subject">
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
                                                    <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.submit')</button>
                                                </div>
                                            </form>

                                            </div>

                                        </div>
                                    </div>
                                </div>
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
                                                    <a href="{{ route('admin.itemDelete',@$item->id) }}" class="text-light">
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
</section>

@endsection
@section('script')
   
@endsection



