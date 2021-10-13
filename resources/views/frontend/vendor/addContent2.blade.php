@extends('frontend.master')
@push('css')
<link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/select2.min.css">
<link rel="stylesheet" href="{{ asset('public/frontend/css/') }}/page_loader.css">
<link rel="stylesheet" href="{{ asset('public/frontend/') }}/addContent2.css">

@endpush
@php
   $infix_general_settings = app('infix_general_settings');
@endphp
@section('content')
<input type="text" hidden  class="id" value="{{ Auth::user()->id}}">
<input type="text" hidden  class="url" value="{{url('/') }}">
    <!-- banner-area start -->
    <div class="banner-area4">
            <div class="banner-area-inner">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-xl-6">
                            <div class="banner-info knowledge_title">
                                <h2>@lang('lang.upload') @lang('lang.product')</h2>
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
                            <div class="col-xl-4">
                                <div class="upload_side_bar gray-bg">
                                    <form action="{{ route('author.contentSelect')}}" method="POST" id="select_content">
                                        @csrf
                                        <div class="upload_inner">
                                            <h3>@lang('lang.select_switch_ategories')</h3>
                                            
                                            <select class="wide " id="select_category" name="category">
                                                <option data-display="@lang('lang.select_category')">@lang('lang.select_category')</option>
                                                @foreach ($category as $item)
                                                    <option value="{{ @$item->id }}" {{ @Session::get('categorySlect')->id == @$item->id ?'selected':''}}>{{ @$item->title }}</option>
                                                @endforeach
                                            </select>
                                            <span class="invalid-feedback invalid-select error add_content_two_category_select"  role="alert">
                                                    <strong id="category_select"></strong>
                                            </span>
                                            <button class="boxed-btn" type="submit">@lang('lang.select_category')</button>
                                            <a href="{{route('knowledgeBase')}}" class="help">@lang('lang.help')</a>
                                        </div>
                                    </form>
                                </div>
                            </div>


                            @if(Session::has('categorySlect'))
                            <div class="col-xl-8">

                            <form action="{{ route('author.itemStore')}}" method="POST" id="file_up" enctype="multipart/form-data">
                                @csrf
                                <div class="single_upload_area">
                                    {{-- <div class="d-flex justify-content-center"> --}}
                                        
                                    {{-- </div> --}}
                                    <input type="text" hidden name="category_id" value="{{@Session::get('categorySlect')->id}}">
                                   
                                    <div class="upload_description gray-bg">
                                        {{-- <div class="d-flex justify-content-center">
                                            <div class="loader">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>  
                                        </div> --}}
                                            <h3>@lang('lang.name_and_desription')</h3>

                                            <select class="wide "  name="upload_or_link" onchange="checkIsLink(this)">
                                                <option data-display="@lang('lang.product_upload_or_link')">@lang('lang.product_upload_or_link')</option>
                                                
                                                    <option value="" >@lang('lang.select')</option>
                                                    <option value="1" selected>@lang('lang.upload')</option>
                                                    <option value="0" >@lang('lang.link')</option>
                                                
                                            </select>

                                            @if ($errors->has('upload_or_link'))
                                            <span class="invalid-feedback invalid-select error" role="alert">
                                                <strong>{{ $errors->first('upload_or_link') }}</strong>
                                            </span>
                                         @endif
                                            {{-- start title input --}}
                                            <input type="text" name="title" id="title" placeholder="@lang('lang.title')*" value="{{ old('title') }}">
                                            @if ($errors->has('title'))
                                                <span class="invalid-feedback invalid-select error"  role="alert">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif
                                            <p>@lang('lang.maximum_100_characters_no_HTML_r_emoji_allowed')</p>
                                            {{-- end title input --}}



                                            {{-- start key features --}}
                                            <input type="text" name="feature1" id="" placeholder="@lang('lang.key_features')" value="{{ old('feature1') }}">
                                            @if ($errors->has('feature1'))
                                                <span class="invalid-feedback invalid-select error" role="alert">
                                                    <strong>{{ $errors->first('feature1') }}</strong>
                                                </span>
                                            @endif
                                            {{-- end key features --}}


                                            {{--start 2nd key features --}}
                                                <input type="text" name="feature2" id="" placeholder="@lang('lang.key_features')" value="{{ old('feature2') }}">
                                                @if ($errors->has('feature2'))
                                                    <span class="invalid-feedback invalid-select error" role="alert">
                                                        <strong>{{ $errors->first('feature2') }}</strong>
                                                    </span>
                                                @endif
                                                <p>@lang('lang.key_feature_messsage')</p>
                                            {{--end 2nd key features --}}
                                            

                                            {{-- start description  --}}
                                                <textarea name="description" id="messageArea" cols="30" rows="10" placeholder="">{{ old('description') }}</textarea>
                                                <p>@lang('lang.key_feature_messsage_description')</p>
                                            {{-- end description  --}}
                                        </div>



                                        <div class="upload_description gray-bg padding-bottom">
                                            <h3>@lang('lang.Files')</h3>
                                            <div class="fileAdd d-none">                                                    
                                        </div>
                                                  
                                        {{-- start thumbnails image upload section           --}}
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="DM_uploader d-flex align-items-center justify-content-between mb_20px">
                                                    <h5 id="thumbneils_title" >@lang('lang.thumbnails')*</h5>
                                                    <a href="javascript:void(0)" class="boxed-btn boxed_button">@lang('lang.browse_file')
                                                        <input type="file" name="thumdnail" onchange="thembnailUpload()" id="thembnails_upload">
                                                    </a>
                                                </div>   
                                                @if ($errors->has('thumdnail'))
                                                    <span class="invalid-feedback invalid-select error" role="alert">
                                                        <strong>{{ $errors->first('thumdnail') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <p>@lang('lang.thumdnail_message')</p>
                                        {{-- end thumbnails image upload section           --}}
                                                 
                                                    
                                                
                                                                                                        
                                        <!-- DM_uploader  -->
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="DM_uploader d-flex align-items-center justify-content-between mb_20px">
                                                    <h5 id="preview_file" >@lang('lang.theme_preview') *</h5>
                                                    <a href="javascript:void(0)" class="boxed-btn boxed_button">
                                                        @lang('lang.browse_file')
                                                        <input type="file" onchange="previewUpload()" id="preview_upload" name="theme_preview" >
                                                    </a>
                                                </div>
                                                @if ($errors->has('theme_preview'))
                                                    <span class="invalid-feedback invalid-select" role="alert">
                                                        <strong>{{ $errors->first('theme_preview') }}</strong>
                                                    </span>
                                                @endif
                                              
                                                <p>@lang('lang.theme_preview_message')
                                                    <br>
                                                    <strong>[@lang('lang.mark_all_images')]</strong> 
                                                </p>
                                            </div>
                                        </div> 
                                        <!-- DM_uploader  -->

                                        
                                        <div id="main_file_upload_section" style="display: block" >
                                             
                                        <!-- DM_uploader  -->
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="DM_uploader d-flex align-items-center justify-content-between mb_20px">
                                                    <h5 id="main_file_title" >@lang('lang.main_files')*</h5>
                                                    <a href="javascript:void(0)" class="boxed-btn boxed_button">@lang('lang.browse_file')
                                                        <input type="file" onchange="mainFileUpload()" name="main_file" id="mail_file_upload">
                                                    </a>
                                                </div>
                                                @if ($errors->has('main_file'))
                                                <span class="invalid-feedback invalid-select"
                                                    role="alert">
                                                    <strong>{{ $errors->first('main_file') }}</strong>
                                                </span>
                                                @endif
                                                <p>@lang('lang.main_file_message')</p>
                                            </div>
                                        </div>
                                        <!-- DM_uploader  -->

                                        {{-- maximum file size allowed 500MB --}}
                                        <p>@lang('lang.maximum_file_size_allowed_500MB') </p> 
                                    </div>  
                                    <div id="product_purchase_link" style="display: none">
                                        <div class="col-12 p-0">
                                            <input type="text" name="purchase_link" placeholder="@lang('lang.purchase_link')*" value="{{ old('purchase_link') }}">
                                        </div>
                                        @if ($errors->has('purchase_link'))
                                            <span class="invalid-feedback invalid-select error" role="alert">
                                                <strong>{{ $errors->first('purchase_link') }}</strong>
                                            </span>
                                        @endif
                                    </div> 
                                    </div>




                                    <div class="upload_description gray-bg padding-bottom">
                                        <h3>@lang('lang.categories_and_attributes')</h3>

                                        {{-- select sub category --}}
                                        <select class="wide"  name="sub_category_id" id="sub_category_id">
                                            <option data-display="@lang('lang.category')*">@lang('lang.category') *</option>
                                            @foreach ($subCategory as $value)
                                                    <option value="{{ @$value->id }}" class="dm_padding_left_40"> -{{ @$value->title }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('sub_category_id'))
                                        <span class="invalid-feedback invalid-select"
                                            role="alert">
                                            <strong>{{ $errors->first('sub_category_id') }}</strong>
                                        </span>
                                        @endif
                                        {{--end select sub category --}}

 

                                        <div class="disable_key">
                                            {{--dynamic input filed--}}                                                        
                                            @foreach ($attribute as $key => $item)                                                         
                                                {{-- <select class="js-example-basic-multiple dm_display_none" data-placeholder="{{@$item->name}} *" name="{{@$item->field_name}}[]" multiple="multiple" aria-readonly="false"  title="Select "> --}}
                                                <select class="js-example-basic-multiple dm_display_none" data-placeholder="{{@$item->name}} *" name="optional_att[{{@$item->field_name}}][]" multiple="multiple" aria-readonly="false"  title="Select ">
                                                    @foreach ($item->subAttribute as $value)
                                                        @if (@Session::get('categorySlect')->id == $value->category_id)                                                                
                                                            <option  data-display="{{@$value->name}}"  value="{{@$value->id}}">{{@$value->name}}</option>
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
                                                          
                                        <div class="col-12 p-0">
                                            <input type="text" name="demo_url" placeholder="@lang('lang.demo_url')*" value="{{ old('demo_url') }}">
                                        </div>
                                    </div>

                                    <div class="upload_description gray-bg padding-bottom">
                                        <h3>@lang('lang.Tags') *</h3>
                                            <textarea name="tags" id="" cols="30" rows="10" placeholder="@lang('lang.Tags')" >{{ old('tags') }}</textarea>
                                        <p>@lang('lang.tags_message')</p>
                                    </div>
                                    <div class="upload_description gray-bg padding-bottom prise-item">
                                        <div class="upload_hding">
                                            <h3>@lang('lang.message_to_the_reviewer')</h3>
                                            <p>@lang('lang.upload_heading')</p>
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
                                                <div class="upload_inner d-flex align-items-center mb-10">
                                                    
                                                        <span class="lisence-name">@lang('lang.regular_license')</span>
                                                        <span>{{@$infix_general_settings->currency_symbol}}</span>
                                                        <div class="input_field">
                                                            <label for="">@lang('lang.ITEM_PRISE')</label>
                                                            <input type="text" step="any" id="Re_item" name="Re_item" onkeyup="regular(this.value)" value="{{ old('Re_item') }}">
                                                        </div>
                                                        <span>+</span>
                                                        <div class="input_field">
                                                            <label for="">@lang('lang.BUYER_FEE')</label>
                                                            <input  type="text" step="any"  id="Re_buyer" name="Re_buyer" hidden value="{{ @$item_fee->re_fee}}" value="{{ old('Re_buyer') }}">
                                                            <input type="text"  disabled placeholder="{{@$infix_general_settings->currency_symbol}}{{ @$item_fee->re_fee}}" onkeyup="regular(this.value)">
                                                        </div>
                                                        <span>=</span>
                                                        <div class="input_field last-one">
                                                            <label for="">@lang('lang.purchase_price')</label>
                                                            <input  type="text"   name="Reg_total_price" readonly  value="{{ old('Reg_total') }}" placeholder="{{@$infix_general_settings->currency_symbol}}" id="Re_total" >
                                                            <input  type="text"   disabled hidden id="Reg_total"  value="{{ old('Reg_total') }}">
                                                        </div>
                                                        
                                                        <div class="recomander">
                                                            <p>@lang('lang.recommended') <br>
                                                                    @lang('lang.purchase_price') <br>
                                                                    {{@$infix_general_settings->currency_symbol}}{{ @$regular_recommended_price[0][0]  }} - {{@$infix_general_settings->currency_symbol}}{{@$regular_recommended_price[0][1]}}</p> 
                                                        </div>
                                                </div>
                                                <div class="upload_inner d-flex align-items-center mb-10">
                                                        <span class="lisence-name">@lang('lang.extended_license')</span>
                                                        <span>{{@$infix_general_settings->currency_symbol}}</span>
                                                        <div class="input_field">
                                                            <label for="">@lang('lang.ITEM_PRISE')</label>
                                                            <input  type="text" step="any"   id="E_item" name="E_item" onkeyup="Extended(this.value)" value="{{ old('E_item') }}">
                                                        </div>
                                                        <span>+</span>
                                                        <div class="input_field">
                                                            <label for="">@lang('lang.BUYER_FEE')</label>
                                                            <input  type="text" step="any"   id="E_buyer" name="E_buyer" hidden value="{{ @$item_fee->ex_fee}}" value="{{ old('E_buyer') }}">
                                                            <input  type="text"    disabled placeholder="{{@$infix_general_settings->currency_symbol}}{{ @$item_fee->ex_fee}}" onkeyup="this.value)">
                                                        </div>
                                                        <span>=</span>
                                                        <div class="input_field last-one">
                                                            <label for="">@lang('lang.purchase_price')</label>
                                                            <input  type="text"     disabled id="E_total"  placeholder="{{@$infix_general_settings->currency_symbol}}">
                                                            <input  type="text"  disabled hidden id="Ex_total" placeholder="{{@$infix_general_settings->currency_symbol}}"  value="{{ old('Ex_total') }}">
                                                            <input type="hidden" name="Ex_total_price" id="ex_price" value="{{ old('Ex_total') }}">
                                                        </div>
                                                        <div class="recomander">
                                                            <p>@lang('lang.recommended') <br>
                                                                    @lang('lang.purchase_price') <br>
                                                                    {{@$infix_general_settings->currency_symbol}}{{ @$extended_recommended_price[0][0]  }} - {{@$infix_general_settings->currency_symbol}}{{@$extended_recommended_price[0][1]}}</p> 
                                                        
                                                        </div>
                                                </div>
                                                <div class="upload_inner d-flex align-items-center mb-10">
                                                        <span class="lisence-name"> @lang('lang.commercial') @lang('lang.License')</span>
                                                        <span>{{@$infix_general_settings->currency_symbol}}</span>
                                                        <div class="input_field">
                                                            <label for="">@lang('lang.ITEM_PRISE')</label>
                                                            <input  type="text" step="any"   id="C_item" name="C_item" onkeyup="Commercial(this.value)" value="{{ old('C_item') }}">
                                                        </div>
                                                        <span>+</span>
                                                        <div class="input_field">
                                                            <label for="">@lang('lang.BUYER_FEE')</label>
                                                            <input  type="text" step="any"   id="C_buyer" name="C_buyer" hidden value="{{ @$item_fee->co_fee}}" value="{{ old('C_buyer') }}">
                                                            <input  type="text"    disabled placeholder="{{@$infix_general_settings->currency_symbol}}{{ @$item_fee->co_fee}}" onkeyup="Commercial(this.value)">
                                                        </div>
                                                        <span>=</span>
                                                        <div class="input_field last-one">
                                                            <label for="">@lang('lang.purchase_price')</label>
                                                            <input  type="text"     disabled id="C_total"  placeholder="{{@$infix_general_settings->currency_symbol}}">
                                                            <input  type="text"  disabled hidden id="Co_total" placeholder="{{@$infix_general_settings->currency_symbol}}"  value="{{ old('C_total') }}">
                                                            <input type="hidden" name="C_total_price" id="c_price" value="{{ old('C_total') }}">
                                                        </div>
                                                        <div class="recomander">
                                                            <p>@lang('lang.recommended') <br>
                                                                    @lang('lang.purchase_price') <br>
                                                                    {{@$infix_general_settings->currency_symbol}}{{ @$recommended_price_commercial[0][0]  }} - {{@$infix_general_settings->currency_symbol}}{{@$recommended_price_commercial[0][1]}}</p> 
                                                        
                                                        </div>
                                                </div>
                                            <p>@lang('lang.price_message') </p>
                                        </div>
                                    <div class="upload_description gray-bg padding-bottom">
                                        <h3>@lang('lang.message_to_the_reviewer')</h3>
                                            <textarea class="autherMsg" name="user_msg" id="autherMsg" cols="30" rows="10" placeholder="@lang('lang.message')">{{ old('user_msg') }}</textarea>
                                        
                                    <p>@lang('lang.submit_message') {{ @GeneralSetting()->system_name }}</p>
                                    </div>
                                    <button  class="boxed-btn mt-20" onclick='upload_image();' id="itemSubmit" type="submit">@lang('lang.submit') @lang('lang.product')</button>
                                
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
