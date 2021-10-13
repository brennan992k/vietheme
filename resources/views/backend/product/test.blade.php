@extends('backend.master')
@section('mainContent')

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.product_upload')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#" class="active">@lang('lang.product_upload') </a>
            </div>
        </div>
    </div>
</section>
<style>
    .select_Staff_width {
         width: 100%;
    }
</style>
<section class="admin-visitor-area DM_table_info">
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
                <div class="col-lg-3">
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
            </div>

                <div class="col-xl-9">
                    <div class="white-box">
                        <div class="add-visitor">
                    <form action="http://127.0.0.1/spondon/digital/author/item-store" method="POST" id="file_up" enctype="multipart/form-data" novalidate="novalidate">
                        <input type="hidden" name="_token" value="jRuPtYLqWjzByP7teBCVeknm9qOMFjHZso8RwBCj">                                <div class="single_upload_area">
                            <input type="text" hidden="" name="category_id" value="1">
                                <div class="upload_description gray-bg">
                                    <h3>Name and Desription</h3>


                                    
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
                                    <p>Maximum 100 characters. No HTML or emoji allowed</p>
                                    
                                    <div class="row mt-10">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input class="primary-input form-control{{ $errors->has('feature1') ? ' is-invalid' : '' }}" type="text" name="feature1"
                                                       autocomplete="off" value="{{isset($data['edit'])? $data['edit']->feature1 :old('feature1')}}">
    
                                                <input type="hidden" name="id" value="{{isset($data['edit'])? $data['edit']->id: ''}}">
                                                <label>@lang('lang.feature') <span>*</span></label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('feature1'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('feature1') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input class="primary-input form-control{{ $errors->has('feature2') ? ' is-invalid' : '' }}" type="text" name="feature2"
                                                       autocomplete="off" value="{{isset($data['edit'])? $data['edit']->feature2 :old('feature2')}}">
    
                                                <input type="hidden" name="id" value="{{isset($data['edit'])? $data['edit']->id: ''}}">
                                                <label>@lang('lang.feature') <span>*</span></label>
                                                <span class="focus-border"></span>
                                                @if ($errors->has('feature2'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('feature2') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <p>Highlight what makes your item unique or a key selling point. They appear on search result pages next to an image of your item. Max 45 characters per line. No HTML or emoji allowed. Do not repeat features or keyword spam.</p>
                                    
                                    

                                    
                                        <textarea name="description" id="messageArea" cols="30" rows="10" placeholder="" style="visibility: hidden; display: none;"></textarea>
                                        <p>HTML or plain text allowed, no emoji This field is used for search, so please be descriptive! If you're linking to external images, please mind the page load speed: use few, compress them and host them on a fast server or CDN.</p>
                                    
                                </div>



                                <div class="upload_description gray-bg padding-bottom">
                                    <h3>Files</h3>
                                    <div class="fileAdd">                                                    
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
                                
                               
                                <p>JPEG or PNG 80x80px Thumbnail</p>
                                
                                         
                                            
                                        
                                                                                                
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
                                  <p>ZIP - All files for buyers, not including preview images.</p>
                                
                                <!-- DM_uploader  -->

                                
                                <p>The maximum file size allowed is 500 MB - please ensure compression has been optimized before uploading. </p> 
                            </div>




                            <div class="upload_description gray-bg padding-bottom">
                                <h3>Categories and Attributes</h3>

                                

                                                                        

                                    @php
                                        $roles=DB::table('roles')->get();
                                    @endphp

                                        <div  id="indivitual_email_sms">

                                            <div class="white-box">
                                                <div class="row mb-35">

                                                    <div class="col-lg-12">
                                                        <select class="niceSelect w-100 bb form-control{{ $errors->has('role_id') ? ' is-invalid' : '' }}" name="role_id" id="staffsByRoleCommunication">
                                                            <option data-display="@lang('lang.role')  *" value="">@lang('lang.role') *</option>
                                                            @foreach($roles as $value) 
                                                                @if(isset($editData))
                                                                <option value="{{@$value->id}}" {{@$value->id == @$editData->role_id? 'selected':''}}>{{ @$value->name}}</option>
                                                                @else
                                                                <option value="{{ @$value->id}}">{{ @$value->name}}</option>
                                                                @endif 
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('leave_type'))
                                                        <span class="invalid-feedback invalid-select" role="alert">
                                                            <strong>{{ $errors->first('leave_type') }}</strong>
                                                        </span> @endif
                                                    </div>

                                                    <div class="col-lg-12 mt-30" id="selectStaffsDiv">
                                                        <label for="checkbox" class="mb-2">@lang('lang.name')</label>
                                                        
                                                        <select multiple id="selectStaffss" name="message_to_individual[]" class="select_Staff_width">

                                                        </select>
                                                        <div class="">
                                                        <input type="checkbox" id="checkbox_section" class="common-checkbox">
                                                        <label for="checkbox_section" class="mt-3">@lang('lang.select_all') </label>
                                                        </div>
                                                        @if ($errors->has('staff_id'))
                                                            <span class="invalid-feedback invalid-select" role="alert">
                                                                <strong>{{ $errors->first('staff_id') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        



















                                                                            <div class="">                                                       
                                                                                @foreach ($attribute as $key => $item) 
                                                                                    <div class="col-lg-12 mt-30" id="selectStaffsDiv">
                                                                                        <label for="checkbox" class="mb-2">{{@$item->name}} *</label>
                                                                                        
                                                                                        <select multiple id="selectStaffssttttttttttttt" name="optional_att[{{@$item->field_name}}][]" class="select_Staff_width">
                                                                                            @foreach ($item->subAttribute as $value)
                                                                                                @if (@Session::get('categorySlect')->id == $value->category_id)                                                                
                                                                                                    <option  data-display="{{@$value->name}}"  value="{{@$value->id}}">{{@$value->name}}</option>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </select>
                                                                                        <div class="">
                                                                                        <input type="checkbox" id="checkbox_section" class="common-checkbox">
                                                                                        <label for="checkbox_section" class="mt-3">@lang('lang.select_all') </label>
                                                                                        </div>
                                                                                        @if ($errors->has('staff_id'))
                                                                                            <span class="invalid-feedback invalid-select" role="alert">
                                                                                                <strong>{{ $errors->first('staff_id') }}</strong>
                                                                                            </span>
                                                                                        @endif
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                            {{-- <div class="">                                                       
                                                                                @foreach ($attribute as $key => $item) 
                                                                                    <div class="col-lg-12">

                                                                                        <select  class="select_Staff_width" data-placeholder="{{@$item->name}} *" name="optional_att[{{@$item->field_name}}][]" multiple="multiple" aria-readonly="false"  title="Select ">
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
                                                                                    </div>
                                                                                @endforeach
                                                                            </div> --}}
                               

                                                  
                                <div class="col-12 p-0">
                                    <input type="text" name="demo_url" placeholder="Demo url*" value="">
                                </div>
                            </div>

                            <div class="upload_description gray-bg padding-bottom">
                                <h3>Tags *</h3>
                                    <textarea name="tags" id="" cols="30" rows="10" placeholder="Tags"></textarea>
                                <p>Maximum of 15 keywords covering features, usage, and styling. Keywords should all be in lowercase and separated by commas. e.g. photography, gallery, modern, jquery, wordpress theme.</p>
                            </div>
                            <div class="upload_description gray-bg padding-bottom prise-item">
                                <div class="upload_hding">
                                    <h3>Message to the Reviewer</h3>
                                    <p>It's important that you set the price for your items independently and not discuss your pricing decisions with other authors. The item price will include your author fee and your initial term of item support (if you offer it). See our Author Terms and Item Support breakdown if you want to know more</p>
                                </div>
                                 
                                        <div class="upload_inner d-flex align-items-center mb-10">
                                                <span class="lisence-name">regular license</span>
                                                <span>$</span>
                                                <div class="input_field">
                                                    <label for="">ITEM PRISE</label>
                                                    <input type="text" step="any" id="Re_item" name="Re_item" onkeyup="regular(this.value)" value="">
                                                </div>
                                                <span>+</span>
                                                <div class="input_field">
                                                    <label for="">BUYER FEE</label>
                                                    <input type="text" step="any" id="Re_buyer" name="Re_buyer" hidden="" value="6">
                                                    <input type="text" disabled="" placeholder="$6" onkeyup="regular(this.value)">
                                                </div>
                                                <span>=</span>
                                                <div class="input_field last-one">
                                                    <label for="">Purchase price</label>
                                                    <input type="text" name="Reg_total_price" readonly="" value="" placeholder="$" id="Re_total">
                                                    <input type="text" disabled="" hidden="" id="Reg_total" value="">
                                                </div>
                                                <div class="recomander">
                                                    <p>Recommended <br>
                                                            Purchase price <br>
                                                            $45 - $67</p> 
                                                </div>
                                        </div>
                                        <div class="upload_inner d-flex align-items-center mb-10">
                                                <span class="lisence-name">Extended License</span>
                                                <span>$</span>
                                                <div class="input_field">
                                                    <label for="">ITEM PRISE</label>
                                                    <input type="text" step="any" id="E_item" name="E_item" onkeyup="Extended(this.value)" value="">
                                                </div>
                                                <span>+</span>
                                                <div class="input_field">
                                                    <label for="">BUYER FEE</label>
                                                    <input type="text" step="any" id="E_buyer" name="E_buyer" hidden="" value="62">
                                                    <input type="text" disabled="" placeholder="$62" onkeyup="Extended(this.value)">
                                                </div>
                                                <span>=</span>
                                                <div class="input_field last-one">
                                                    <label for="">Purchase price</label>
                                                    <input type="text" disabled="" id="E_total" placeholder="$100">
                                                    <input type="text" disabled="" hidden="" id="Ex_total" placeholder="$100" value="">
                                                    <input type="hidden" name="Ex_total_price" id="ex_price" value="">
                                                </div>
                                                <div class="recomander">
                                                    <p>Recommended <br>
                                                            Purchase price <br>
                                                            $150 - $170</p> 
                                                
                                                </div>
                                        </div>
                                    <p>The "Recommended purchase price" is just a guide to help you decide - all pricing decisions are yours and yours only. </p>
                                </div>
                            <div class="upload_description gray-bg padding-bottom">
                                <h3>Message to the Reviewer</h3>
                                    <textarea class="autherMsg" name="user_msg" id="autherMsg" cols="30" rows="10" placeholder="Message"></textarea>
                                
                            <p>Any images, sounds, video, code, flash, or other assets that are not my own work, have been appropriately licensed for use in the file preview or main download. Other than these items, this work is entirely my own and I have full rights to sell it on Infix Market</p>
                            </div>
                            <button class="boxed-btn mt-20" type="submit">Submit Product</button>
                        
                        </div>
                    </form>
                    </div>
                    </div>
                    </div>
            </div>
    </div>
</section>
{{-- <script src="{{asset('public/backend/vendors/js/select2/select2.min.js')}}"></script> --}}
{{-- <script src="{{asset('public/backend/send_email.js')}}"></script> --}}

<script>
$("#selectStaffss").select2();
    $("#checkbox").click(function () {
        if ($("#checkbox").is(':checked')) {
            $("#selectStaffss > option").prop("selected", "selected");
            $("#selectStaffss").trigger("change");
        } else {
            $("#selectStaffss > option").removeAttr("selected");
            $("#selectStaffss").trigger("change");
        }
    });


    // for select2 multiple dropdown in send email/Sms in Class tab
    $("#selectStaffss").select2();
    $("#checkbox_section").click(function () {
        if ($("#checkbox_section").is(':checked')) {
            $("#selectStaffss > option").prop("selected", "selected");
            $("#selectStaffss").trigger("change");
        } else {
            $("#selectStaffss > option").removeAttr("selected");
            $("#selectStaffss").trigger("change");
        }
    });
</script>
@endsection



