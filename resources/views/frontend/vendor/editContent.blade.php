@extends('frontend.master')
@push('css')
<link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/select2.min.css">
<link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/page_loader.css">
<link rel="stylesheet" href="{{ asset('public/frontend/') }}/editContent.css">
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
                                <h2>@lang('lang.update') @lang('lang.product')</h2>
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
                <div class="row">
                    <div class="col-xl-10 offset-xl-1">
                        <div class="row"> 
                                                    
                            @if(@$data['edit']->id)
                            <div class="col-xl-10 offset-xl-1">
                                @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    <form action="{{ route('admin.itemUpdate')}}" id="file_update" method="POST" enctype="multipart/form-data">
                                @else
                                    @if (@$item_preview != null)
                                    <form action="{{ route('author.portfolio',Auth::user()->username)}}" method="get" >
                                    @else
                                    <form action="{{ route('author.itemUpdate')}}" id="file_update" method="POST" enctype="multipart/form-data">
                                    @endif
                                  
                                @endif
                                    @csrf
                                <div class="single_upload_area">
                                        <input type="text" hidden name="category_id" value="{{@$data['edit']->category_id}}">
                                        <input type="text" hidden name="id" value="{{@$data['edit']->id}}">
                                        <div class="d-flex justify-content-center" id="page_loader" style="display: none">
                                            <div class="loader" style="display: none">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>  
                                        </div>
                                        <div class="upload_description gray-bg">

                                            <select class="wide " id="select_category" name="upload_or_link" onchange="checkIsLink(this)">
                                                <option data-display="@lang('lang.product_upload_or_link')">@lang('lang.product_upload_or_link')</option>
                                                
                                                    <option value="" >@lang('lang.select')</option>
                                                    <option value="1" {{ $data['edit']->is_upload == 1 ?'selected':''}}>@lang('lang.upload')</option>
                                                    <option value="0" {{ $data['edit']->is_upload == 0 ?'selected':''}}>@lang('lang.link')</option>
                                                
                                            </select>

                                            @if ($errors->has('upload_or_link'))
                                            <span class="invalid-feedback invalid-select error" role="alert">
                                                <strong>{{ $errors->first('upload_or_link') }}</strong>
                                            </span>
                                         @endif
                                       {{-- @dd($data['edit']->is_upload) --}}

                                                <h3>@lang('lang.name_and_desription')</h3>
                                                


                                                    <input type="text" name="title" id="" placeholder="@lang('lang.name')*" value="{{isset($data['edit'])? $data['edit']->title:old('title')}}">
                                                    @if ($errors->has('title'))
                                                    <span class="invalid-feedback invalid-select error"
                                                          role="alert">
                                                        <strong>{{ $errors->first('title') }}</strong>
                                                    </span>
                                                  @endif
                                                  <p>@lang('lang.maximum_100_characters_no_HTML_r_emoji_allowed')</p>
                                                    <input type="text" name="feature1" id="" placeholder="@lang('lang.key_features')" value="{{isset($data['edit'])? $data['edit']->feature1:old('feature1')}}">
                                                    @if ($errors->has('feature1'))
                                                    <span class="invalid-feedback invalid-select error"
                                                          role="alert">
                                                        <strong>{{ $errors->first('feature1') }}</strong>
                                                    </span>
                                                    @endif
                                                    <input type="text" name="feature2" id="" placeholder="@lang('lang.key_features')" value="{{isset($data['edit'])? $data['edit']->feature2:old('feature2')}}">
                                                    @if ($errors->has('feature2'))
                                                    <span class="invalid-feedback invalid-select error"
                                                          role="alert">
                                                        <strong>{{ $errors->first('feature2') }}</strong>
                                                    </span>
                                                    @endif
                                                    <p>
                                                        @lang('lang.key_feature_messsage')
                                                       
                                                    </p>
                                                    <textarea  name="description" id="messageArea" cols="30" rows="10"
                                                        placeholder="">{{isset($data['edit'])? $data['edit']->description:old('description')}}</textarea>
                                                        <p>@lang('lang.key_feature_messsage_description')
                                                        </p>
                                                
                                            </div>
                                            <div class="upload_description gray-bg padding-bottom">
                                                <h3>@lang('lang.Files')</h3>
                                                <div class="fileAdd d-none">
                                                    
                                            </div>
                                            {{-- admin --}}
                                            {{-- <div class="row">
                                                <div class="col-lg-6">
                                                     <a href="#" class="boxed-btn minimal_width">Upload File(s)
                                                             <input type="file" id="file_upload_js">
                                                         </a>
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                     <span class="invalid-feedback invalid-select error" role="alert" class="db">
                                                             <strong id="file_upload_js_error"></strong>
                                                         </span>
                                                </div>
                                            </div> --}}
                                            
                                                
                                                        <!-- DM_uploader  -->
                                                        <div class="row">
                                                            <div class="col-12">
                                                            <div class="DM_uploader d-flex align-items-center justify-content-between mb_20px">
                                                                <h5 id="thumbneils_title" >{{ Illuminate\Support\Str::replaceFirst('public/uploads/SessionFile/', '',@$data['edit']->icon) }}</h5>
                                                                <a href="javascript:void(0)"  class="boxed-btn boxed_button">@lang('lang.browse_file')
                                                                            <input type="file" name="thumdnail" value="{{ @$data['edit']->icon }}" onchange="thembnailUpload()" id="thembnails_upload">
                                                                </a>
                                                                </div>
                                                            </div>
                                                        </div>
             
                                                        @if ($errors->has('thumdnail'))
                                                        <span class="invalid-feedback invalid-select error"
                                                            role="alert">
                                                            <strong>{{ $errors->first('thumdnail') }}</strong>
                                                        </span>
                                                        @endif
                                                        <p>
                                                            @lang('lang.thumdnail_message')
                                                        </p>
                                                        <!-- DM_uploader  -->
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="DM_uploader d-flex align-items-center justify-content-between mb_20px">
                                                                    @php
                                                                       $theme_preview_array=explode(",", $data['edit']->theme_preview); 
                                                                    @endphp
                                                                    <h5 id="preview_file" >{{ @count($theme_preview_array) }} @lang('lang.images_found')</h5>
                                                                    <a href="javascript:void(0)" class="boxed-btn boxed_button">@lang('lang.browse_file')
                                                                                    <input type="file" onchange="previewUpload()" value="{{ @$data['edit']->theme_preview }}" id="preview_upload" name="theme_preview" >
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                               
                                                    @if ($errors->has('theme_preview'))
                                                        <span class="invalid-feedback invalid-select"
                                                            role="alert">
                                                            <strong>{{ $errors->first('theme_preview') }}</strong>
                                                        </span>
                                                    @endif
                                                    <p>@lang('lang.theme_preview_message')
                                                        <br>
                                                        <strong>[@lang('lang.mark_all_images')]</strong> 
                                                    </p>
                                                    <!-- DM_uploader  -->
                                                <div id="main_file_upload_section" style="display: {{ @$data['edit']->is_upload == 1 ?'block':'none'}}" >
                                                    <div class="row d-none">
                                                            <div class="col-12">
                                                                <div class="DM_uploader d-flex align-items-center justify-content-between mb_20px">
                                                                    <h5 id="main_file_title" >{{ Illuminate\Support\Str::replaceFirst('public/uploads/product/main_file/zip/', '',@$data['edit']->main_file) }}</h5>
                                                                    <a href="javascript:void(0)" class="boxed-btn boxed_button">@lang('lang.browse_file')
                                                                                    <input type="file" value="{{ @$data['edit']->main_file }}" onchange="mainFileUpload()" name="main_file" id="mail_file_upload">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- DM_uploader  -->
                                                    {{-- <select class="wide file fileSelect"  name="main_file" id="main_file">

                                                            @if (@$data['edit']->main_file != null && @$data['edit']->main_file != '')
                                                            <option value="{{ @$data['edit']->main_file }}" data-display="{{ str_replace_first('public/uploads/product/main_file/zip/', '',@$data['edit']->main_file) }}">{{ str_replace_first('public/uploads/product/main_file/zip/', '',@$data['edit']->main_file) }}</option>
                                                            @else
                                                            <option data-display="Main Files*">Main Files*</option>
                                                            @endif
                                                    </select> --}}
                                                    @if ($errors->has('main_file'))
                                                    <span class="invalid-feedback invalid-select"
                                                        role="alert">
                                                        <strong>{{ $errors->first('main_file') }}</strong>
                                                    </span>
                                                    @endif
                                                    <p>@lang('lang.main_file_message')</p>
                                                    <div class="row">
                                                        <div class="col-12">
                                                         <div class="DM_uploader d-flex align-items-center justify-content-between mb_20px">
                                                             <h5 id="file_title">{{ Illuminate\Support\Str::replaceFirst('public/uploads/product/main_file/zip/', '',@$data['edit']->main_file) }}*</h5>
                                                             <a href="javascript:void(0)" class="boxed-btn boxed_button">@lang('lang.browse_file')
                                                                             <input type="file" onchange="fileUpload()" value="{{ @$data['edit']->main_file }}" name="file" id="file_upload">
                                                             </a>
                                                             </div>
                                                        </div>
                                                    </div>
                                                    @if ($errors->has('file'))
                                                    <span class="invalid-feedback invalid-select"
                                                        role="alert">
                                                        <strong>{{ $errors->first('file') }}</strong>
                                                    </span>
                                                    @endif
                                                    </div>
                                                    
                                                    <div id="product_purchase_link" style="display: {{ @$data['edit']->is_upload == 1 ?'none':'block'}}">
                                                        <div class="col-12 p-0">
                                                            <input type="text" name="purchase_link" placeholder="@lang('lang.purchase_link')*" value="{{ @$data['edit']->purchase_link }}">
                                                        </div>
                                                        @if ($errors->has('purchase_link'))
                                                            <span class="invalid-feedback invalid-select error" role="alert">
                                                                <strong>{{ $errors->first('purchase_link') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div> 
                                                    <p>@lang('lang.ZIP_containing_an_installable') {{@Session::get('categorySlect')->title}} @lang('lang.theme')</p>
                                                    {{-- <p>@lang('lang.file_message') </p> --}}
                                                    {{-- @foreach ($data['category'] as $item)
                                                    @if ($item->file_permission == 1 && @$data['edit']->category_id == $item->id)
                                                      
                                                    <select class="wide file fileSelect"  name="file">
                                                            @if (@$data['edit']->file != null && @$data['edit']->file != '')
                                                            <option value="{{ @$data['edit']->file }}" data-display="{{ str_replace_first('public/uploads/product/file/zip/', '',@$data['edit']->file) }}">{{ str_replace_first('public/uploads/product/file/zip/', '',@$data['edit']->file) }}</option>
                                                            @else
                                                            <option data-display="Wordpress*">Wordpress*</option>
                                                            @endif
                                                    </select>
                                                    @if ($errors->has('file'))
                                                    <span class="invalid-feedback invalid-select"
                                                        role="alert">
                                                        <strong>{{ $errors->first('file') }}</strong>
                                                    </span>
                                                    @endif
                                                    <p>@lang('lang.file_message') </p>
                                                      
                                                    @endif
                                                    @endforeach --}}
                                            </div>
                                            <div class="upload_description gray-bg padding-bottom">
                                                    <h3>@lang('lang.categories_and_attributes')</h3>
                                                            <select class="wide"  name="sub_category_id" id="sub_category_id">

                                                                @if (!@$data['edit']->sub_category_id)
                                                                <option data-display="@lang('lang.category')*">@lang('lang.category')*</option>
                                                                @endif

                                                                @foreach ($data['edit']->category->subCategory as $value)
                                                                     <option value="{{ $value->id }}" {{@$data['edit']->sub_category_id == $value->id ? 'selected':''}} class="pl"> -{{ $value->title }}</option>
                                                                @endforeach
                                                            </select>
  
                                                            <div class="disable_key">
                                                                {{--dynamic input filed--}}                                                        
                                                                @foreach ($data['attribute'] as $key => $item)                                                         
                                                                    {{-- <select class="js-example-basic-multiple dm_display_none" data-placeholder="{{@$item->name}} *" name="{{@$item->field_name}}[]" multiple="multiple" aria-readonly="false"  title="Select "> --}}
                                                                    <select class="js-example-basic-multiple dm_display_none" data-placeholder="{{@$item->name}} *" name="optional_att[{{@$item->field_name}}][]" multiple="multiple" aria-readonly="false"  title="Select ">
                                                                        @foreach ($item->subAttribute as $value)
                                                                            @if ($data['edit']->category_id == $value->category_id)                                                                
                                                                                <option  data-display="{{@$value->name}}"  value="{{@$value->id}}" 
                                                                                {{getAttributeSelecedStatus($data['edit']->id, $item->field_name, $value->id )}}>{{@$value->name}} </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>  
                                                                    @if (@$errors->has(@$item->field_name))
                                                                        <span class="invalid-feedback invalid-select" role="alert">
                                                                            <strong>{{ @$errors->first(@$item->field_name) }}</strong>
                                                                        </span>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        <input type="text" name="demo_url" placeholder="@lang('lang.demo_url')*"  value="{{isset($data['edit'])? $data['edit']->demo_url:old('demo_url')}}">
                                                </div>
                                                

                                                

                                            <div class="upload_description gray-bg padding-bottom">
                                                <h3>@lang('lang.Tags')</h3>
                                                    <textarea  name="tags" id="" cols="30" rows="10" 
                                                    placeholder="@lang('lang.Tags')" >{{isset($data['edit'])? $data['edit']->tags:old('tags')}}</textarea>
                                                    <p>@lang('lang.tags_message')</p>
                                            </div>
                                            <div class="upload_description gray-bg padding-bottom prise-item">
                                                <div class="upload_hding">
                                                    <h3>@lang('lang.message_to_the_reviewer')</h3>
                                                    <p>@lang('lang.upload_heading')</p>
                                                </div>
                                                         @php
                                                            $regular = App\Models\ManageQuery::BuyerFees(1);
                                                            // DB::table('buyer_fees')->where('type', 1)->first();
                                                         $category_details=$category_details=App\Models\ManageQuery::SelectedCategoryDetails($data['edit']->category_id);
                                                        //  DB::table('item_categories')->where('id',$data['edit']->category_id)->first();
                                                        //  $category_details=DB::table('item_categories')->where('id',Session::get('categorySlect')->id)->first();
                                                        $regular_recommended_price[]=explode("-",$category_details->recommended_price);
                                                         $extended_recommended_price[]=explode("-",$category_details->recommended_price_extended);
                                                         $recommended_price_commercial[]=explode("-",$category_details->recommended_price_commercial);
    
                                                         $item_fee=App\Models\ManageQuery::FreeItemOfCategory($data['edit']->category_id);
                                                        //  DB::table('item_fees')->where('category_id',$data['edit']->category_id)->first();
                                                       
                                                    @endphp 
                                                        <div class="upload_inner d-flex align-items-center mb-10">
                                                                <span class="lisence-name">@lang('lang.regular_license')</span>
                                                                <span>{{ @GeneralSetting()->currency_symbol}}</span>
                                                                <div class="input_field">
                                                                    <label for="">@lang('lang.ITEM_PRISE')</label>
                                                                    <input type="text" id="Re_item" name="Re_item" onkeyup="regular(this.value)" value="{{isset($data['edit'])? $data['edit']->Re_item:old('Re_item')}}">
                                                                </div>
                                                                <span>+</span>
                                                                <div class="input_field">
                                                                    <label for="">@lang('lang.BUYER_FEE')</label>
                                                                    <input type="text" id="Re_buyer" name="Re_buyer" hidden value="{{ @$data['edit']->Re_buyer}}" value="{{isset($data['edit'])? $data['edit']->Re_buyer:old('Re_buyer')}}">
                                                                    <input type="text"  disabled placeholder="{{ @GeneralSetting()->currency_symbol}} {{ @$data['edit']->Re_buyer}}" onkeyup="regular(this.value)">
                                                                </div>
                                                                <span>=</span>
                                                                {{-- <div class="input_field last-one">
                                                                    <label for="">Purchase Price</label>
                                                                    <input type="text" disabled placeholder="{{ @GeneralSetting()->currency_symbol}} {{isset($data['edit'])? $data['edit']->Reg_total:old('Reg_total')}}" id="Re_total" >
                                                                    <input type="text" disabled hidden id="Reg_total" name="Reg_total" value="{{isset($data['edit'])? $data['edit']->Reg_total:old('Reg_total')}}">
                                                                </div> --}}
                                                                <div class="input_field last-one">
                                                                    <label for="">@lang('lang.purchase_price')</label>
                                                                    <input type="text" name="Reg_total_price" readonly  value="{{isset($data['edit'])? $data['edit']->Reg_total:old('Reg_total')}}" placeholder="{{ @GeneralSetting()->currency_symbol}} {{isset($data['edit'])? $data['edit']->Reg_total:old('Reg_total')}}" id="Re_total" >
                                                                    <input type="text" disabled hidden id="Reg_total"  value="{{isset($data['edit'])? $data['edit']->Reg_total:old('Reg_total')}}">
                                                                </div>
                                                                <div class="recomander">
                                                                    <p>@lang('lang.recommended') <br>
                                                                        @lang('lang.purchase_price') <br>
                                                                       {{ @GeneralSetting()->currency_symbol}}{{ @$regular_recommended_price[0][0]  }} - {{ @GeneralSetting()->currency_symbol}}{{@$regular_recommended_price[0][1]}}</p> 
                                                           </div>
                                                        </div>
                                                        @php
                                                            $extended = App\Models\ManageQuery::BuyerFees(2);
                                                        @endphp
                                                        <div class="upload_inner d-flex align-items-center mb-10">
                                                                <span class="lisence-name">@lang('lang.extended_license')</span>
                                                                <span>{{ @GeneralSetting()->currency_symbol}}</span>
                                                                <div class="input_field">
                                                                    <label for="">@lang('lang.ITEM_PRISE')</label>
                                                                    <input type="text" id="E_item" name="E_item" onkeyup="Extended(this.value)" value="{{isset($data['edit'])? $data['edit']->E_item:old('E_item')}}">
                                                                </div>
                                                                <span>+</span>
                                                                <div class="input_field">
                                                                    <label for="">@lang('lang.BUYER_FEE')</label>
                                                                   <input type="text" id="E_buyer" name="E_buyer" hidden value="{{ @$data['edit']->E_buyer}}" value="{{isset($data['edit'])? $data['edit']->E_buyer:old('E_buyer')}}">
                                                                   <input type="text"   disabled placeholder="{{ @GeneralSetting()->currency_symbol}} {{ @$data['edit']->E_buyer}}" onkeyup="Extended(this.value)">
                                                                </div>
                                                                <span>=</span>
                                                                <div class="input_field last-one">
                                                                    <label for="">@lang('lang.purchase_price')</label>
                                                                    <input type="text" id="E_total" value="{{isset($data['edit'])? $data['edit']->Ex_total:old('Ex_total')}}" disabled placeholder="{{ @GeneralSetting()->currency_symbol}} {{isset($data['edit'])? $data['edit']->Ex_total:old('Ex_total')}}">
                                                                    <input type="text" hidden id="Ex_total" disabled placeholder="{{ @GeneralSetting()->currency_symbol}} 100" name="Ex_total" value="{{isset($data['edit'])? $data['edit']->Ex_total:old('Ex_total')}}">
                                                                    <input type="hidden" name="Ex_total_price" id="ex_price" value="{{isset($data['edit'])? $data['edit']->Ex_total:old('Ex_total')}}">
                                                                </div>
                                                                <div class="recomander">
                                                                    <p>@lang('lang.recommended') <br>
                                                                        @lang('lang.purchase_price') <br>
                                                                        {{ @GeneralSetting()->currency_symbol}}{{ @$extended_recommended_price[0][0]  }} - {{ @GeneralSetting()->currency_symbol}}{{@$extended_recommended_price[0][1]}}</p> 
                                                          
                                                            </div>
                                                        </div>
                                                        <div class="upload_inner d-flex align-items-center mb-10">
                                                            <span class="lisence-name"> @lang('lang.commercial') @lang('lang.License')</span>
                                                            <span>{{ @GeneralSetting()->currency_symbol}}</span>
                                                            <div class="input_field">
                                                                <label for="">@lang('lang.ITEM_PRISE')</label>
                                                                <input  type="text" step="any"   id="C_item" name="C_item" onkeyup="Commercial(this.value)" value="{{isset($data['edit'])? $data['edit']->C_item:old('C_item')}}">
                                                            </div>
                                                            <span>+</span>
                                                            <div class="input_field">
                                                                <label for="">@lang('lang.BUYER_FEE')</label>
                                                                <input  type="text" step="any"   id="C_buyer" name="C_buyer" hidden value="{{ @$item_fee->co_fee}}" value="{{isset($data['edit'])? $data['edit']->C_buyer:old('C_buyer')}}">
                                                                <input  type="text"    disabled placeholder="{{ @GeneralSetting()->currency_symbol}}{{ @$item_fee->co_fee}}" onkeyup="Commercial(this.value)">
                                                            </div>
                                                            <span>=</span>
                                                            <div class="input_field last-one">
                                                                <label for="">@lang('lang.purchase_price')</label>
                                                                <input  type="text"     disabled id="C_total"  placeholder="{{ @GeneralSetting()->currency_symbol}} {{isset($data['edit'])? $data['edit']->C_total:old('C_total')}}">
                                                                <input  type="text"  disabled hidden id="Co_total" placeholder="{{ @GeneralSetting()->currency_symbol}}"  value=" {{isset($data['edit'])? $data['edit']->C_total:old('C_total')}}">
                                                                <input type="hidden" name="C_total_price" id="c_price" value="{{isset($data['edit'])? $data['edit']->C_total:old('C_total')}}">
                                                            </div>
                                                            <div class="recomander">
                                                                <p>@lang('lang.recommended') <br>
                                                                        @lang('lang.purchase_price') <br>
                                                                        {{ @GeneralSetting()->currency_symbol}}{{ @$recommended_price_commercial[0][0]  }} - {{ @GeneralSetting()->currency_symbol}}{{@$recommended_price_commercial[0][1]}}</p> 
                                                            
                                                            </div>
                                                    </div>
                                                        <p>@lang('lang.price_message') </p>
                                                </div>
                                            <div class="upload_description gray-bg padding-bottom">
                                                <h3>@lang('lang.message_to_the_reviewer')</h3>
                                                    <textarea class="autherMsg" name="user_msg" id="autherMsg" cols="30" rows="10" 
                                                    placeholder="Messages">{{@$data['edit']->user_msg}}</textarea>
                                              
                                                    <p>@lang('lang.submit_message') {{ @GeneralSetting()->system_name }}</p>
                                                </div>
                                            </div>
                                            @if (@$item_preview!=null)
                                            <p class="text-danger text-center">@lang('lang.your_previous_update_is_pending')</p>
                                            <p  class="boxed-btn mt-20">@lang('lang.update') @lang('lang.product')</p>
                                            @else
                                            <button  class="boxed-btn mt-20" id="itemSubmit" type="submit">@lang('lang.update') @lang('lang.product')</button>
                                            @endif
                                            
                                
                                </div>
                            </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
@include('error.error')     
@endsection
@push('js')
<script src="{{ asset('public/frontend/js/') }}/select2.min.js"></script>
<script src="{{ asset('public/frontend/js/') }}/file_upload.js"></script>
<script src="{{ asset('public/frontend/js/') }}/item_files.js"></script>
<script src="{{ asset('public/frontend/js/') }}/page_loader.js"></script>
<script>
        @if($errors->any())
            @foreach($errors->all() as $error)
                  toastr.error('{{ $error }}','Error',{
                      closeButton:true,
                      progressBar:true,
                   });
            @endforeach
        @endif
    </script>

<script src="https://cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script>
 
<script type="text/javascript">
    CKEDITOR.replace('messageArea', {
        filebrowserUploadUrl: "{{route('ckeditor_upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form',
            on: {
                instanceReady: function() {
                    this.dataProcessor.htmlFilter.addRules( {
                        elements: {
                            img: function( el ) {
                                // Add an attribute.
                                if ( !el.attributes.alt )
                                    el.attributes.alt = 'Feature image';

                                // Add some class.
                                el.addClass( 'feature_image_ck' );
                            }
                        }
                    } );            
                }
            }
    });
</script>

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

@endpush