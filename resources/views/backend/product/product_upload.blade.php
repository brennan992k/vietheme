@extends('backend.master') @section('mainContent')
<style>
    .input_field {
    width: 150px;
    max-width: 150px !important;
    flex: 150px 0 0;
}
</style>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.product_upload') </h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.product')</a>
                <a href="#"> @lang('lang.product_upload')</a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-8 col-md-6">
            </div>
            <div class="col-lg-4 text-md-right text-left col-md-6 mb-30-lg">
                <a href="{{route('admin.content')}}" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>@lang('lang.Product') @lang('lang.list')</a>
            </div>
        </div>
        
            <div class="row">
                <div class="col-lg-3 mb-30">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-30">

                                    @lang('lang.select') @lang('lang.category') 
                                </h3>
                            </div>
                                <form action="{{route('admin.selectCategory')}}" method="POST"
                                      class="form-horizontal" enctype="multipart/form-data">
                                 
                                            @csrf

                                            <div class="white-box">
                                                <div class="add-visitor">
                                                    <div class="row mb-25">
                                                        <div class="col-lg-12">
                                                            <div class="input-effect">
                                                                <select class="niceSelect w-100 bb form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}"
                                                                        name="category">
                                                                    <option data-display="@lang('lang.category') *"
                                                                            value="">@lang('lang.category') *
                                                                    </option>
                                                                    @foreach($data['category'] as $item)
                                                                        <option value={{@$item->id}} {{ @$item->id == @Session::get('categorySlect')->id ?'selected':old('category') ==( @$item->id ? 'selected':'')}}>{{@$item->title}}</option>
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
                @if (@Session::get('categorySlect')->id)
                    
                
                <div class="col-lg-9 ">
                    <div class="white-box">
                        <div class="add-visitor">
                            <form action="{{url('admin/product-upload')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{@Session::get('categorySlect')->id}}" name="category_id">
                                <div class="row mt-20">
                                    <div class="col-lg-12 mb-30">
                                        <div class="input-effect">
                                            <select class="niceSelect w-100 bb form-control{{ $errors->has('upload_or_link') ? ' is-invalid' : '' }}"
                                                    name="upload_or_link" onchange="checkIsLink(this)">
                                                <option value="" >@lang('lang.select')</option>
                                                <option value="1"  selected>@lang('lang.upload')</option>
                                                <option value="0" >@lang('lang.link')</option>
                                            </select>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('upload_or_link'))
                                                <span class="invalid-feedback invalid-select"
                                                    role="alert">
                                                    <strong>{{ $errors->first('upload_or_link') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            <div class="row">
                                <div class="col-lg-12 ">
                                    <div class="input-effect">
                                        <input class="primary-input form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" type="text" name="title"
                                               autocomplete="off" value="{{isset($data['edit'])? $data['edit']->title :old('title')}}">

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
                            <div class="row mt-10">
                                <div class="col-lg-12">
                                    <div class="input-effect">
                                        <input class="primary-input form-control{{ $errors->has('feature1') ? ' is-invalid' : '' }}" type="text" name="feature1"
                                               autocomplete="off" value="{{isset($data['edit'])? $data['edit']->feature1 :old('feature1')}}">

                                        <input type="hidden" name="id" value="{{isset($data['edit'])? $data['edit']->id: ''}}">
                                        <label>@lang('lang.feature') <span></span></label>
                                        <span class="focus-border"></span>
                                        @if ($errors->has('feature1'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('feature1') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-20 mb-20">
                                <div class="col-lg-12">
                                    <div class="input-effect">
                                        <input class="primary-input form-control{{ $errors->has('feature2') ? ' is-invalid' : '' }}" type="text" name="feature2"
                                               autocomplete="off" value="{{isset($data['edit'])? $data['edit']->feature2 :old('feature2')}}">

                                        <input type="hidden" name="id" value="{{isset($data['edit'])? $data['edit']->id: ''}}">
                                        <label>@lang('lang.feature') <span></span></label>
                                        <span class="focus-border"></span>
                                        @if ($errors->has('feature2'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('feature2') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="input-effect mb-20">
                                    <label>@lang('lang.description') <span>*</span> </label>
                                    <textarea id="summernote" class="primary-input form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" cols="0" rows="4" name="description" id="details">{{ old('description') }}</textarea>
                                   
                                    <span class="focus-border textarea"></span> 
                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-25">
                                <div class="col-lg-12">
                                    <div class="row no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input {{ $errors->has('thumdnail') ? ' is-invalid' : '' }}" type="text"
                                                      id="placeholder_thembnails"
                                                       placeholder="@lang('lang.thumbnails') "
                                                       readonly="">
                                                <span class="focus-border"></span>
                                            </div>
                                            <small>@lang('lang.please_input')</small>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input"
                                                    type="button">
                                                <label class="primary-btn small fix-gr-bg"
                                                       for="thembnails_upload">@lang('lang.browse')</label>
                                                <input type="file" class="d-none" onchange="thembnailUpload()" id="thembnails_upload" name="thumdnail">
                                            </button>
                                            
                                        </div>
                                    </div>
                                    @if ($errors->has('thumdnail'))
                                    <span class="invalid-feedback dm_display_block" role="alert" >
                                        <strong>{{ $errors->first('thumdnail') }}</strong>
                                    </span>
                                    @endif
                                    <p id="thumbneils_title"></p>
                                </div>
                            </div>      
                            
                           
                            {{-- <p>@lang('lang.thumdnail_message')</p> --}}
                            <div class="row mt-25">
                                <div class="col-lg-12">
                                    <div class="row no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input {{ $errors->has('theme_preview') ? ' is-invalid' : '' }}" type="text"
                                                      id="placeholderPhoto"
                                                       placeholder="@lang('lang.theme_preview') "
                                                       readonly="">
                                                <span class="focus-border"></span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input"
                                                    type="button">
                                                <label class="primary-btn small fix-gr-bg"
                                                       for="preview_upload">@lang('lang.browse')</label>
                                                <input type="file" class="d-none" name="theme_preview"
                                                onchange="previewUpload()" id="preview_upload">
                                            </button>
                                            
                                        </div>
                                    </div>
                                    @if ($errors->has('theme_preview'))
                                        <span class="invalid-feedback dm_display_block" role="alert" >
                                            <strong>{{ $errors->first('theme_preview') }}</strong>
                                        </span>
                                    @endif
                                    <p id="preview_file"></p>
                                </div>
                            </div>  
                            <p>@lang('lang.theme_preview_message')
                                <br>
                                <strong>[@lang('lang.mark_all_images')]</strong> 
                            </p>     

                            
                            <div class="row mt-25" id="main_file_upload_section" style="display:block" >
                            
                                <div class="col-lg-12">
                                    <div class="row no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input {{ $errors->has('main_file') ? ' is-invalid' : '' }}" type="text"
                                                      id="placeholderPhoto"
                                                       placeholder="@lang('lang.main_files') "
                                                       readonly="">
                                                <span class="focus-border"></span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input"
                                                    type="button">
                                                <label class="primary-btn small fix-gr-bg"
                                                       for="mail_file_upload">@lang('lang.browse')</label>
                                                <input type="file" class="d-none" onchange="mainFileUpload()" name="main_file" id="mail_file_upload">
                                            </button>
                                            
                                        </div>
                                    </div>
                                    @if ($errors->has('main_file'))
                                        <span class="invalid-feedback dm_display_block" role="alert" >
                                            <strong>{{ $errors->first('main_file') }}</strong>
                                        </span>
                                    @endif
                                    <p id="main_file_title"></p>
                                </div>
                            </div> 
                            <div id="product_purchase_link" style="display: none">
                                
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('purchase_link') ? ' is-invalid' : '' }}" type="text" name="purchase_link"
                                           autocomplete="off" value="{{isset($data['edit'])? $data['edit']->purchase_link :old('purchase_link')}}">
    
                                    <input type="hidden" name="id" value="{{isset($data['edit'])? $data['edit']->id: ''}}">
                                    <label>@lang('lang.purchase_link') <span>*</span></label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('purchase_link'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('purchase_link') }}</strong>
                                        </span>
                                    @endif
                                </div>
                              
                            </div> 
                            <script>
                                function checkIsLink(selectedObj) {
                                    var selected_value=selectedObj.value;
                                    var upload_section=document.getElementById('main_file_upload_section');
                                    var purchase_link=document.getElementById('product_purchase_link');
                            
                                    if (selected_value==0) {
                                        upload_section.style.display = "none";
                                        purchase_link.style.display = "block";
                                    } else {
                                        upload_section.style.display = "block";
                                        purchase_link.style.display = "none";
                                    }
                            
                                }
                            </script>    
                            <p>@lang('lang.main_file_message')</p>
                              <div class="col-lg-12 mb-30">
                                <div class="input-effect">
                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('sub_category_id') ? ' is-invalid' : '' }}"
                                            name="sub_category_id">
                                        <option data-display="@lang('lang.category') *"
                                                value="">@lang('lang.category') *
                                        </option>
                                        @foreach($data['subCategory'] as $item)
                                            <option value={{@$item->id}} {{ @$item->id == @Session::get('categorySlect')->id ?'selected':old('category') ==( @$item->id ? 'selected':'')}}>{{@$item->title}}</option>
                                        @endforeach
                                    </select>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('sub_category_id'))
                                        <span class="invalid-feedback invalid-select"
                                              role="alert">
                                            <strong>{{ $errors->first('sub_category_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <br>
                                <style>
                                    .select_Staff_width{
                                        width: 100%;
                                        height: 35px;
                                        border-color: #D9DCE8;
                                        /* overflow-x: hidden; */

                                    }
                                    /* Hide scrollbar for Chrome, Safari and Opera */
                                    .select_Staff_width::-webkit-scrollbar {
                                        display: none;
                                    }

                                    /* Hide scrollbar for IE and Edge */
                                    .select_Staff_width {
                                        -ms-overflow-style: none;
                                    }
                                </style>
                    @foreach ($attribute as $key => $item) 
                        <div class="col-lg-12 mt-30" id="">
                            <label for="checkbox" class="mb-2">{{@$item->name}} *</label>
                            
                            <select multiple id="selectField{{@$item->id}}" name="optional_att[{{@$item->field_name}}][]" onclick="attributeSelect({{@$item->id}})"  class="select_Staff_width text-white multiple_attribute_select">
                                @foreach ($item->subAttribute as $value)
                                    @if (@Session::get('categorySlect')->id == $value->category_id)                                                                
                                        <option  data-display="{{@$value->name}}"  value="{{@$value->id}}">{{@$value->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                           
                            @if ($errors->has('staff_id'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('staff_id') }}</strong>
                                </span>
                            @endif
                        </div>

                        
                    @endforeach
                    <div class="row mt-20">
                        <div class="col-lg-12">
                            <div class="input-effect">
                                <input class="primary-input form-control{{ $errors->has('demo_url') ? ' is-invalid' : '' }}" type="text" name="demo_url"
                                       autocomplete="off" value="{{isset($data['edit'])? $data['edit']->demo_url :old('demo_url')}}">

                                <input type="hidden" name="id" value="{{isset($data['edit'])? $data['edit']->id: ''}}">
                                <label>@lang('lang.demo_url') <span>*</span></label>
                                <span class="focus-border"></span>
                                @if ($errors->has('demo_url'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('demo_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row mt-25">
                        <div class="col-lg-12">
                            <div class="input-effect">
                                <textarea class="primary-input form-control{{ $errors->has('tags') ? ' is-invalid' : '' }}" type="text" name="tags" autocomplete="off" >{{isset($data['edit'])? $data['edit']->tags:old('tags')}} </textarea>
                                <label>@lang('lang.Tags') *</label>
                                <span class="focus-border"></span>
                                @if ($errors->has('tags'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tags') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @php
                    $category_details=App\ManageQuery::SelectedCategoryDetails(Session::get('categorySlect')->id);
                    // DB::table('item_categories')->where('id',Session::get('categorySlect')->id)->first();
                    $regular_recommended_price[]=explode("-",$category_details->recommended_price);
                    $extended_recommended_price[]=explode("-",$category_details->recommended_price_extended);
                    $recommended_price_commercial[]=explode("-",$category_details->recommended_price_commercial);

                    $item_fee=App\ManageQuery::FreeItemOfCategory(Session::get('categorySlect')->id);
                    // DB::table('item_fees')->where('category_id',Session::get('categorySlect')->id)->first();
                
            @endphp 
            <style>
                span.dm_middle_span {
                    margin-top: 38px;
                    margin-right: 15px;
                }
            </style>
            {{-- <table>
                <tr class="d-flex">
                    <td>
                        <span class="lisence-name ">@lang('lang.regular_license')</span>
                    </td>
                    <td>
                        
                        <span class="dm_middle_span">{{GeneralSetting()->currency_symbol}}</span>
                        <div class="input_field">
                            <label for="">@lang('lang.ITEM_PRISE')</label>
                            <input type="number" class="primary-input form-control w-50" step="any" id="Re_item" name="Re_item" onkeyup="regular(this.value)" value="{{ old('Re_item') }}">
                        </div> 
                    </td>
                    <td>
                        <span class="dm_middle_span">+</span>
                            <div class="input_field">
                                <label for="">@lang('lang.BUYER_FEE')</label>
                                <input  type="text" class="primary-input form-control w-50" step="any"  id="Re_buyer" name="Re_buyer" hidden value="{{ @$item_fee->re_fee}}" value="{{ old('Re_buyer') }}">
                                <input type="text" class="primary-input form-control w-50"  disabled placeholder="{{GeneralSetting()->currency_symbol}}{{ @$item_fee->re_fee}}" onkeyup="regular(this.value)">
                            </div>
                    </td>
                    <td>
                        <span class="dm_middle_span">=</span>
                            <div class="input_field last-one">
                                <label for="">@lang('lang.purchase_price')</label>
                                <input  type="text" class="primary-input form-control w-50"  name="Reg_total_price" readonly  value="{{ old('Reg_total') }}" placeholder="{{GeneralSetting()->currency_symbol}}" id="Re_total" >
                                <input  type="text" class="primary-input form-control w-50"  disabled hidden id="Reg_total"  value="{{ old('Reg_total') }}">
                            </div>
                    </td>
                    <td>
                        <div class="recomander">
                            <p>@lang('lang.recommended') <br>
                                    @lang('lang.purchase_price') <br>
                                    {{GeneralSetting()->currency_symbol}}{{ @$regular_recommended_price[0][0]  }} - {{GeneralSetting()->currency_symbol}}{{@$regular_recommended_price[0][1]}}</p> 
                        </div>
                    </td>
                </tr>
            </table> --}}
            <div class="table-responsive">

            
                    <div class="upload_inner d-flex align-items-center mb-10 mt-20">
                            <span class="lisence-name ">@lang('lang.regular_license')</span>
                            <span class="dm_middle_span">{{GeneralSetting()->currency_symbol}}</span>
                            <div class="input_field">
                                <label for="">@lang('lang.ITEM_PRISE')</label>
                                <input type="text" class="primary-input form-control w-50 decimal" step="any" id="Re_item" name="Re_item" onkeyup="regular(this.value)" value="{{ old('Re_item') }}">
                            </div>
                            <span class="dm_middle_span">+</span>
                            <div class="input_field">
                                <label for="">@lang('lang.BUYER_FEE')</label>
                                <input  type="text" class="primary-input form-control w-50" step="any"  id="Re_buyer" name="Re_buyer" hidden value="{{ @$item_fee->re_fee}}" value="{{ old('Re_buyer') }}">
                                <input type="text" class="primary-input form-control w-50"  disabled placeholder="{{GeneralSetting()->currency_symbol}}{{ @$item_fee->re_fee}}" onkeyup="regular(this.value)">
                            </div>
                            <span class="dm_middle_span">=</span>
                            <div class="input_field last-one">
                                <label for="">@lang('lang.purchase_price')</label>
                                <input  type="text" class="primary-input form-control w-50"  name="Reg_total_price" readonly  value="{{ old('Reg_total') }}" placeholder="{{GeneralSetting()->currency_symbol}}" id="Re_total" >
                                <input  type="text" class="primary-input form-control w-50"  disabled hidden id="Reg_total"  value="{{ old('Reg_total') }}">
                            </div>
                            <div class="recomander">
                                <p>@lang('lang.recommended') <br>
                                        @lang('lang.purchase_price') <br>
                                        {{GeneralSetting()->currency_symbol}}{{ @$regular_recommended_price[0][0]  }} - {{GeneralSetting()->currency_symbol}}{{@$regular_recommended_price[0][1]}}</p> 
                            </div>
                    </div>
                    <div class="upload_inner d-flex align-items-center mb-10">
                            <span class="lisence-name">@lang('lang.extended_license')</span>
                            <span class="dm_middle_span">{{GeneralSetting()->currency_symbol}}</span>
                            <div class="input_field">
                                <label for="">@lang('lang.ITEM_PRISE')</label>
                                <input  type="text" class="primary-input form-control w-50 decimal" step="any"   id="E_item" name="E_item" onkeyup="Extended(this.value)" value="{{ old('E_item') }}">
                            </div>
                            <span class="dm_middle_span">+</span>
                            <div class="input_field">
                                <label for="">@lang('lang.BUYER_FEE')</label>
                                <input  type="text" class="primary-input form-control w-50" step="any"   id="E_buyer" name="E_buyer" hidden value="{{ @$item_fee->ex_fee}}" value="{{ old('E_buyer') }}">
                                <input  type="text" class="primary-input form-control w-50"    disabled placeholder="{{GeneralSetting()->currency_symbol}}{{ @$item_fee->ex_fee}}" onkeyup="Extended(this.value)">
                            </div>
                            <span class="dm_middle_span">=</span>
                            <div class="input_field last-one">
                                <label for="">@lang('lang.purchase_price')</label>
                                <input  type="text" class="primary-input form-control w-50"     disabled id="E_total"  placeholder="{{GeneralSetting()->currency_symbol}}100">
                                <input  type="text" class="primary-input form-control w-50"  disabled hidden id="Ex_total" placeholder="{{GeneralSetting()->currency_symbol}}100"  value="{{ old('Ex_total') }}">
                                <input type="hidden" name="Ex_total_price" id="ex_price" value="{{ old('Ex_total') }}">
                            </div>
                            <div class="recomander">
                                <p>@lang('lang.recommended') <br>
                                        @lang('lang.purchase_price') <br>
                                        {{GeneralSetting()->currency_symbol}}{{ @$extended_recommended_price[0][0]  }} - {{GeneralSetting()->currency_symbol}}{{@$extended_recommended_price[0][1]}}</p> 
                            
                            </div>
                    </div>
                    <div class="upload_inner d-flex align-items-center mb-10">
                            <span class="lisence-name">@lang('lang.commercial') @lang('lang.License')</span>
                            <span class="dm_middle_span">{{GeneralSetting()->currency_symbol}}</span>
                            <div class="input_field">
                                <label for="">@lang('lang.ITEM_PRISE')</label>
                                <input  type="text" class="primary-input form-control w-50 decimal" step="any"   id="C_item" name="C_item" onkeyup="Commercial(this.value)" value="{{ old('C_item') }}">
                            </div>
                            <span class="dm_middle_span">+</span>
                            <div class="input_field">
                                <label for="">@lang('lang.BUYER_FEE')</label>
                                <input  type="text" class="primary-input form-control w-50" step="any"   id="C_buyer" name="C_buyer" hidden value="{{ @$item_fee->ex_fee}}" value="{{ old('C_buyer') }}">
                                <input  type="text" class="primary-input form-control w-50"    disabled placeholder="{{GeneralSetting()->currency_symbol}}{{ @$item_fee->ex_fee}}" onkeyup="Commercial(this.value)">
                            </div>
                            <span class="dm_middle_span">=</span>
                            <div class="input_field last-one">
                                <label for="">@lang('lang.purchase_price')</label>
                                <input  type="text" class="primary-input form-control w-50"     disabled id="C_total"  placeholder="{{GeneralSetting()->currency_symbol}}100">
                                <input  type="text" class="primary-input form-control w-50"  disabled hidden id="Co_total" placeholder="{{GeneralSetting()->currency_symbol}}100"  value="{{ old('Co_total') }}">
                                <input type="hidden" name="Co_total_price" id="co_price" value="{{ old('Co_total') }}">
                            </div>
                            <div class="recomander">
                                <p>@lang('lang.recommended') <br>
                                        @lang('lang.purchase_price') <br>
                                        {{GeneralSetting()->currency_symbol}}{{ @$recommended_price_commercial[0][0]  }} - {{GeneralSetting()->currency_symbol}}{{@$recommended_price_commercial[0][1]}}</p> 
                            
                            </div>
                    </div>
                </div>
                <p>@lang('lang.price_message') </p>
            </div>

            <div class="row mt-50">
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

        </form>


                </div>
                </div>
                @endif
                </div>
            </div>
        </div>
     
</section>
@endsection
@section('script')
  
<script>
    function regular(item) {
    var Re_item = $("#Re_item").val();
    var Re_buyer = $("#Re_buyer").val();

    if (Re_item.length != 0) {
        var item = Re_item;
    } else {
        var item = 0;
    }
    var total = parseInt(item) + parseInt(Re_buyer);
    $("#Reg_total").val(total);
    $("#Re_total").attr("placeholder", "$" + total);
    $("#Re_total").attr("value", total);
}

function Extended(item) {
    var E_item = $("#E_item").val();
    var buyer = $("#E_buyer").val();

    if (E_item.length > 0) {
        var item = E_item;
    } else {
        var item = 0;
    }
    var total = parseInt(item) + parseInt(buyer);
    $("#E_total").attr("placeholder", "$" + total);
    $("#E_total").attr("value", total);
    //    $('#ex_price').attr("value",total);
    $("#ex_price").val(total);
    $("#Ex_total").val(total);
}
function Commercial(item) {
    var E_item = $("#C_item").val();
    var buyer = $("#C_buyer").val();

    if (E_item.length > 0) {
        var item = E_item;
    } else {
        var item = 0;
    }
    var total = parseInt(item) + parseInt(buyer);
    $("#C_total").attr("placeholder", "$" + total);
    $("#C_total").attr("value", total);
    //    $('#ex_price').attr("value",total);
    $("#co_price").val(total);
    $("#Co_total").val(total);
}

$('.decimal').keyup(function(){
    var val = $(this).val();
    if(isNaN(val)){
         val = val.replace(/[^0-9\.]/g,'');
         if(val.split('.').length>2) 
             val =val.replace(/\.+$/,"");
    }
    $(this).val(val); 
});

</script>
<script src="{{asset('public/backEnd/send_email.js')}}"></script>
<script src="{{asset('public/backEnd/backend.js')}}"></script>
<script src="{{asset('public/backEnd/js/admin_upload.js')}}"></script>
@endsection