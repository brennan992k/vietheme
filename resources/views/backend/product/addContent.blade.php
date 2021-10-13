@extends('backend.master')
@push('css')
<link rel="stylesheet" href="{{asset('public/backend/')}}/css/upload.css"/>
@endpush
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
                <h1>@lang('lang.sub') @lang('lang.Product') @lang('lang.list')</h1>
                <div class="bc-pages">
                    <a href="{{route('admin.dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#" class="active">@lang('lang.Product') @lang('lang.list')</a>
                </div>
            </div>
        </div>
    </section>


    <section class="admin-visitor-area">
        <div class="container-fluid p-0">
            @if(isset($data['edit']) && !empty(@$data['edit']))
                <div class="row">
                    <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                        <a href="{{ route('admin.Product')}}" class="primary-btn small fix-gr-bg">
                            <span class="ti-plus pr-2"></span>
                            @lang('lang.add')
                        </a>
                    </div>
                </div>
            @endif

            <div class="row">
                    <div class="upload_area section-padding">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="row">
                                            <div class="col-xl-3">
                                                <div class="upload_side_bar gray-bg">
                                                    <div class="upload_inner">
                                                        <h3>Select/switch Categories</h3>
                                                        <select class="wide">
                                                            <option data-display="Wordpress">Wordpress</option>
                                                            <option value="1">Wordpress 1</option>
                                                            <option value="2">Wordpress 2</option>
                                                        </select>
                                                        <a href="#" class="boxed-btn">Select Category</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-9">
                                                <div class="single_upload_area">
                                                        <div class="upload_description gray-bg">
                                                                <h3>Name and Desription</h3>
                                                                <form action="#">
                                                                    <input type="text" name="" id="" placeholder="Name*">
                                                                    <p>We do not sell or share your details without your permission. Find out more in
                                                                        our Privacy Policy. Your username, email and <br> password can be updated via
                                                                        your Codepixar Account settings.
                                                                    </p>
                                                                    <input type="text" name="" id="" placeholder="Key Features">
                                                                    <input type="text" name="" id="" placeholder="Key Features">
                                                                    <p>We do not sell or share your details without your permission. Find out more in
                                                                        our Privacy Policy. Your username, email and <br> password can be updated via
                                                                        your Codepixar Account settings.
                                                                    </p>
                                                                    <textarea name="#" id="" cols="30" rows="10"
                                                                        placeholder="HTML5 Description"></textarea>
                                                                    <p>We do not sell or share your details without your permission. Find out more in
                                                                        our Privacy Policy. Your username, email and <br> password can be updated via
                                                                        your Codepixar Account settings.
                                                                    </p>
                                                                </form>
                                                            </div>
                                                            <div class="upload_description gray-bg padding-bottom">
                                                                <h3>Files</h3>
                                                                <div class="single_up_preview plus_padding">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-xl-6 col-md-7 ">
                                                                            <div class="preview_wrap d-flex align-items-center">
                                                                                <span><i class="ti-check"></i></span>
                                                                                <div class="preview_heading">
                                                                                    <h4>Theme_Preview.zip (2 mins ago)</h4>
                                                                                    <span>saved</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-6 col-md-5">
                                                                            <div class="remove_btn text-right">
                                                                                <a href="#" class="boxed_btn_red">Remove</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <a href="#" class="boxed-btn">Upload File(s)</a>
                                                                <div class="upload_preview_box">
                                                                    <div class="single_up_preview">
                                                                        <div class="row align-items-center">
                                                                            <div class="col-xl-5 col-md-7 col-lg-5">
                                                                                <div class="preview_wrap d-flex align-items-center">
                                                                                    <span><i class="ti-check"></i></span>
                                                                                    <div class="preview_heading">
                                                                                        <h4>Theme_Preview.zip (2 mins ago)</h4>
                                                                                        <span>saved</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-xl-4 col-md-5 col-lg-4">
                                                                                <div class="ProgressWrap">
                                                                                    <span class="progress">
                                                                                        <div class="progress-bar dm_width_35_per"
                                                                                           >
                                                                                        </div>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-xl-3 col-md-12 col-lg-3">
                                                                                <div class="remove_btn text-right">
                                                                                    <a href="#" class="boxed_btn_red">Remove</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="single_up_preview">
                                                                        <div class="row align-items-center">
                                                                            <div class="col-xl-5 col-md-7 col-lg-5">
                                                                                <div class="preview_wrap d-flex align-items-center">
                                                                                    <span><i class="ti-check"></i></span>
                                                                                    <div class="preview_heading">
                                                                                        <h4>Theme_Preview.zip (2 mins ago)</h4>
                                                                                        <span>saved</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-xl-4 col-md-5 col-lg-4">
                                                                                <div class="ProgressWrap">
                                                                                    <span class="progress">
                                                                                        <div class="progress-bar dm_width_45_per"
                                                                                           >
                                                                                        </div>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-xl-3 col-md-12 col-lg-3">
                                                                                <div class="remove_btn text-right">
                                                                                    <a href="#" class="boxed_btn_red">Remove</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="single_up_preview">
                                                                        <div class="row align-items-center">
                                                                            <div class="col-xl-5 col-md-7 col-lg-5">
                                                                                <div class="preview_wrap d-flex align-items-center">
                                                                                    <span><i class="ti-check"></i></span>
                                                                                    <div class="preview_heading">
                                                                                        <h4>Theme_Preview.zip (2 mins ago)</h4>
                                                                                        <span>saved</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-xl-4 col-md-5 col-lg-4">
                                                                                <div class="ProgressWrap">
                                                                                    <span class="progress">
                                                                                        <div class="progress-bar dm_width_35_per"
                                                                                            >
                                                                                        </div>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-xl-3 col-md-12 col-lg-3">
                                                                                <div class="remove_btn text-right">
                                                                                    <a href="#" class="boxed_btn_red">Remove</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <form action="#">
                                                                        <select class="wide dm_display_none" >
                                                                            <option data-display="Thumbnails*">Thumbnails*</option>
                                                                            <option value="1">Thumbnails*</option>
                                                                            <option value="2">Thumbnails*</option>
                                                                        </select>
                                                                    <p>We do not sell or share your details without your permission. Find out more in
                                                                        our Privacy Policy. Your username, email and <br> password can be updated via
                                                                        your Codepixar Account settings.
                                                                    </p>
                                                                    <select class="wide dm_display_none" >
                                                                            <option data-display="Theme Preview*">Theme Preview*</option>
                                                                            <option value="1">Theme Preview*</option>
                                                                            <option value="2">Theme Preview*</option>
                                                                        </select>
                                                                    <p>We do not sell or share your details without your permission. Find out more in
                                                                        our Privacy Policy. Your username, email and <br> password can be updated via
                                                                        your Codepixar Account settings.
                                                                    </p>
                                                                    <select class="wide dm_display_none" >
                                                                            <option data-display="Thumbnails**">Main Files*</option>
                                                                            <option value="1">Main Files*</option>
                                                                            <option value="2">Main Files*</option>
                                                                    </select>
                                                                    <p>We do not sell or share your details without your permission. Find out more in
                                                                        our Privacy Policy. Your username, email and <br> password can be updated via
                                                                        your Codepixar Account settings.
                                                                    </p>
                                                                    <select class="wide dm_display_none" >
                                                                            <option data-display="Thumbnails*">Wordpress*</option>
                                                                            <option value="1">Wordpress Theme*</option>
                                                                            <option value="2">Wordpress Theme*</option>
                                                                    </select>
                                                                    <p>We do not sell or share your details without your permission. Find out more in our Privacy Policy. Your username, email and password can be updated via your Codepixar Account settings.
                                                                    </p>
                                                                </form>
                                                            </div>
                                                            <div class="upload_description gray-bg padding-bottom">
                                                                    <h3>Categories and Attributes</h3>
                                                                    <form action="#">
                                                                            <select class="wide dm_display_none" >
                                                                                <option data-display="Category*">Category*</option>
                                                                                <option value="1">Category*</option>
                                                                                <option value="2">Category*</option>
                                                                                <option value="4">Category*</option>
                                                                            </select>
                                                                        <select class="wide dm_display_none" >
                                                                                <option data-display="High Resolution*">High Resolution*</option>
                                                                                <option value="1">High Resolution*</option>
                                                                                <option value="2">High Resolution*</option>
                                                                                <option value="4">High Resolution*</option>
                                                                            </select>
                                                                        <select class="wide dm_display_none" >
                                                                                <option data-display="Widget Ready*">Widget Ready*</option>
                                                                                <option value="1">Widget Ready*</option>
                                                                                <option value="2">Widget Ready*</option>
                                                                                <option value="4">Widget Ready*</option>
                                                                        </select>
                                                                        <select class="wide dm_display_none" >
                                                                                <option data-display="Compatible Browsers*">Compatible Browsers*</option>
                                                                                <option value="1">Compatible Browsers*</option>
                                                                                <option value="2">Compatible Browsers*</option>
                                                                                <option value="4">Compatible Browsers*</option>
                                                                        </select>
                                                                        <select class="wide dm_display_none" >
                                                                                <option data-display="Compatible With*">Compatible With*</option>
                                                                                <option value="1">Compatible With*</option>
                                                                                <option value="2">Compatible With*</option>
                                                                                <option value="4">Compatible With*</option>
                                                                        </select>
                                                                        <select class="wide dm_display_none" >
                                                                                <option data-display="Framework*">Framework*</option>
                                                                                <option value="1">Framework*</option>
                                                                                <option value="2">Framework*</option>
                                                                                <option value="4">Framework*</option>
                                                                        </select>
                                                                        <select class="wide dm_display_none" >
                                                                                <option data-display="Software Version*">Software Version*</option>
                                                                                <option value="1">Software Version*</option>
                                                                                <option value="2">Framework*</option>
                                                                                <option value="4">Framework*</option>
                                                                        </select>
                                                                        <select class="wide dm_display_none" >
                                                                                <option data-display="ThemeForest Files Included*">Software Version*</option>
                                                                                <option value="1">Software Version*</option>
                                                                                <option value="2">Framework*</option>
                                                                                <option value="4">Framework*</option>
                                                                        </select>
                                                                        <select class="wide dm_display_none" >
                                                                                <option data-display="Columns*">Columns*</option>
                                                                                <option value="1">Software Version*</option>
                                                                                <option value="2">Framework*</option>
                                                                                <option value="4">Framework*</option>
                                                                        </select>
                                                                        <select class="wide dm_display_none" >
                                                                                <option data-display="Layout*">Layout*</option>
                                                                                <option value="1">Software Version*</option>
                                                                                <option value="2">Framework*</option>
                                                                        </select>
                                                                        <input type="text" placeholder="Demo URL*">
                                                                    </form>
                                                                </div>
                                                            <div class="upload_description gray-bg padding-bottom">
                                                                <h3>tags</h3>
                                                                <form action="#">
                                                                    <textarea name="" id="" cols="30" rows="10" placeholder="tags"></textarea>
                                                                </form>
                                                                <p>We do not sell or share your details without your permission. Find out more in our Privacy Policy. Your username, email and password can be updated via your Codepixar Account settings.
                                                                    </p>
                                                            </div>
                                                            <div class="upload_description gray-bg padding-bottom prise-item">
                                                                <div class="upload_hding">
                                                                    <h3>Message to the Reviewer</h3>
                                                                    <p>We do not sell or share your details without your permission. Find out more in our Privacy Policy. Your username, email and password can be updated via your Codepixar Account settings.
                                                                        </p>
                                                                </div>
                                                                    <form action="#">
                                                                        <div class="upload_inner d-flex align-items-center mb-10">
                                                                                <span class="lisence-name">regular license</span>
                                                                                <span>$</span>
                                                                                <div class="input_field">
                                                                                    <label for="">ITEM PRISE</label>
                                                                                    <input type="text">
                                                                                </div>
                                                                                <span>+</span>
                                                                                <div class="input_field">
                                                                                    <label for="">BUYER FEE</label>
                                                                                    <input type="text" placeholder="$12">
                                                                                </div>
                                                                                <span>=</span>
                                                                                <div class="input_field last-one">
                                                                                    <label for="">Purchase Price</label>
                                                                                    <input type="text" placeholder="$12">
                                                                                </div>
                                                                                <div class="recomander">
                                                                                    <p>Recommended <br>
                                                                                            Purchase price <br>
                                                                                            $44 - $59</p>
                                                                                </div>
                                                                        </div>
                                                                        <div class="upload_inner d-flex align-items-center mb-10">
                                                                                <span class="lisence-name">Extended License</span>
                                                                                <span>$</span>
                                                                                <div class="input_field">
                                                                                    <label for="">ITEM PRISE</label>
                                                                                    <input type="text">
                                                                                </div>
                                                                                <span>+</span>
                                                                                <div class="input_field">
                                                                                    <label for="">BUYER FEE</label>
                                                                                    <input type="text" placeholder="$600">
                                                                                </div>
                                                                                <span>=</span>
                                                                                <div class="input_field last-one">
                                                                                    <label for="">Purchase Price</label>
                                                                                    <input type="text" placeholder="$12">
                                                                                </div>
                                                                                <div class="recomander">
                                                                                    <p>Recommended <br>
                                                                                            Purchase price <br>
                                                                                            $2200 - $2950</p>
                                                                                </div>
                                                                        </div>
                                                                    </form>
                                                                    <p>We do not sell or share your details without your permission. Find out more in our Privacy Policy. Your username, email and password can be updated via your Codepixar Account settings.
                                                                        </p>
                                                                </div>
                                                            <div class="upload_description gray-bg padding-bottom">
                                                                <h3>Message to the Reviewer</h3>
                                                                <form action="#">
                                                                    <textarea name="" id="" cols="30" rows="10" placeholder="Messages"></textarea>
                                                                </form>
                                                                <p>We do not sell or share your details without your permission. Find out more in our Privacy Policy. Your username, email and password can be updated via your Codepixar Account settings.
                                                                    </p>
                                                            </div>
                                                            <a href="#" class="primary-btn fix-gr-bg mt-20">submit item</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
    </section>



@endsection




