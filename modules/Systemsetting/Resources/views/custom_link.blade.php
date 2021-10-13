@extends('backend.master')
@section('mainContent')
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('lang.custom') @lang('lang.links') @lang('lang.page')</h1>
                <div class="bc-pages">
                    <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">@lang('lang.system_settings')</a>
                    <a href="#">@lang('lang.custom') @lang('lang.links')</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area">
        <div class="container-fluid p-0">
            <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-30">  @lang('lang.custom') @lang('lang.links') @lang('lang.list') </h3>
                            </div> 
                                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'systemsetting/footer-custom-link/update', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }} 
                            <div class="white-box">

                                <div class="row">
                                    <div class="col-lg-12">
                                        @if(session()->has('message-success'))
                                            <div class="alert alert-success">
                                                @lang('lang.operation_success_message')
                                            </div> 
                                        @endif
                                    </div>
                                </div> 
                                 <div class="row">  
                                                <div class="col-lg-4 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="title1" autocomplete="off" value="{{isset($links)?@$links->title1:''}}">
                                                        <label>@lang('lang.title') 01 </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div> 
                                                <div class="col-lg-4 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="title2" autocomplete="off"  value="{{isset($links)?@$links->title2:''}}" >
                                                        <label>@lang('lang.title') 02 </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div> 
                                                <div class="col-lg-4 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="title3" autocomplete="off"  value="{{isset($links)?@$links->title3:''}}" >
                                                        <label>@lang('lang.title') 03 </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div> 
                                 </div>

                                <div class="row">
                                                <div class="col-lg-4 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="link_label1" autocomplete="off"   value="{{isset($links)?@$links->link_label1:''}}"  >
                                                        <label>@lang('lang.link') @lang('lang.label') 01 </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div>  
                                                <div class="col-lg-4 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="link_label2" autocomplete="off"   value="{{isset($links)?@$links->link_label2:''}}" >
                                                        <label>@lang('lang.link') @lang('lang.label')  02 </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div>  
                                                <div class="col-lg-4 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="link_label3" autocomplete="off"   value="{{isset($links)?@$links->link_label3:''}}"  >
                                                        <label>@lang('lang.link') @lang('lang.label')  03 </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div>  
                                            </div>

                                                

                                            <div class="row">
                                                <div class="col-lg-4 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="link_href1" autocomplete="off"   value="{{isset($links)?@$links->link_href1:''}}"  >
                                                        <label>@lang('lang.link') @lang('lang.url') 01 </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div>  
 
                                                <div class="col-lg-4 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="link_href2" autocomplete="off"   value="{{isset($links)?@$links->link_href2:''}}"  >
                                                        <label>@lang('lang.link') @lang('lang.url') 02 </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div>  
                                                <div class="col-lg-4 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="link_href3" autocomplete="off"   value="{{isset($links)?@$links->link_href3:''}}"  >
                                                        <label>@lang('lang.link') @lang('lang.url') 03 </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div>  
                                               
                                            </div>

                                                <!-- ****************** ****************** ****************** ****************** -->


                                            <div class="row">
 
                                                <div class="col-lg-4 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="link_label5" autocomplete="off"    value="{{isset($links)?@$links->link_label5:''}}"  >
                                                        <label>@lang('lang.link') @lang('lang.label')  05 </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div>  
                                                <div class="col-lg-4 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="link_label6" autocomplete="off"    value="{{isset($links)?@$links->link_label6:''}}"  >
                                                        <label>@lang('lang.link') @lang('lang.label')  06 </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div>  
                                                <div class="col-lg-4 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="link_label7" autocomplete="off"    value="{{isset($links)?@$links->link_label7:''}}"  >
                                                        <label>@lang('lang.link') @lang('lang.label')  07 </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div>  

                                        </div>
                                        <div class="row">
                                                <div class="col-lg-4 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="link_href5" autocomplete="off"   value="{{isset($links)?@$links->link_href5:''}}"  >
                                                        <label>@lang('lang.link') @lang('lang.url') 05 </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div>  
 
                                                <div class="col-lg-4 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="link_href6" autocomplete="off"   value="{{isset($links)?@$links->link_href6:''}}"  >
                                                        <label>@lang('lang.link') @lang('lang.url') 06 </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div>  
                                                <div class="col-lg-4 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="link_href7" autocomplete="off"   value="{{isset($links)?@$links->link_href7:''}}"  >
                                                        <label>@lang('lang.link') @lang('lang.url') 07 </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div>  
                                               
                                        </div>  

                                                <!-- ****************** ****************** ****************** ****************** -->


                                    <div class="row">
                                                <div class="col-lg-4 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="link_label9" autocomplete="off"  value="{{isset($links)?@$links->link_label9:''}}" >
                                                        <label>@lang('lang.link') @lang('lang.label') 09 </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div>  
                                                <div class="col-lg-4 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="link_label10" autocomplete="off"   value="{{isset($links)?@$links->link_label10:''}}">
                                                        <label>@lang('lang.link') @lang('lang.label') 10 </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div>  
                                                <div class="col-lg-4 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="link_label11" autocomplete="off"  value="{{isset($links)?@$links->link_label11:''}}">
                                                        <label>@lang('lang.link') @lang('lang.label') 11 </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div>  
                                    </div>

                                    <div class="row">
 
                                                <div class="col-lg-4 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="link_href9" autocomplete="off"   value="{{isset($links)?@$links->link_href9:''}}"  >
                                                        <label>@lang('lang.link') @lang('lang.url') 09 </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div>  
 
                                                <div class="col-lg-4 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="link_href10" autocomplete="off"   value="{{isset($links)?@$links->link_href10:''}}"  >
                                                        <label>@lang('lang.link') @lang('lang.url') 10 </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div>  
                                                <div class="col-lg-4 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="link_href11" autocomplete="off"   value="{{isset($links)?@$links->link_href11:''}}"  >
                                                        <label>@lang('lang.link') @lang('lang.url') 11 </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div>  
                                    </div>


                                                <!-- ****************** ****************** ****************** ****************** -->

                                    <div class="row">
                                                <div class="col-lg-4 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="link_label13" autocomplete="off"   value="{{isset($links)?@$links->link_label13:''}}"  >
                                                        <label>@lang('lang.link') @lang('lang.label') 13 </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div>  
                                                <div class="col-lg-4 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="link_label14" autocomplete="off"   value="{{isset($links)?@$links->link_label14:''}}"  >
                                                        <label>@lang('lang.link') @lang('lang.label') 14 </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div>  
                                                <div class="col-lg-4 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="link_label15" autocomplete="off"   value="{{isset($links)?@$links->link_label15:''}}"  >
                                                        <label>@lang('lang.link') @lang('lang.label') 15 </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div>  
                                    </div>
                                    <div class="row">
 
                                                <div class="col-lg-4 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="link_href13" autocomplete="off"   value="{{isset($links)?@$links->link_href13:''}}"  >
                                                        <label>@lang('lang.link') @lang('lang.url') 13 </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div>  
 
                                                <div class="col-lg-4 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="link_href14" autocomplete="off"   value="{{isset($links)?@$links->link_href14:''}}"  >
                                                        <label>@lang('lang.link') @lang('lang.url') 14 </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div>  
                                                <div class="col-lg-4 mt-40"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="link_href15" autocomplete="off"   value="{{isset($links)?@$links->link_href15:''}}"  >
                                                        <label>@lang('lang.link') @lang('lang.url') 15 </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div>  
                                            </div>
                                                {{-- kjfkjd --}}
                                                <div class="mt-20">
                                                    <a href="https://fontawesome.com/v4.7.0/icons/" target="_blank">@lang('lang.font_awesome_icon_list') </a>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 mt-40">
                                                        <div class="input-effect">
                                                            <input class="primary-input form-control{{ $errors->has('icon1') ? ' is-invalid' : '' }}"
                                                                type="text" name="icon1" autocomplete="off" value="{{isset($footer_setting)? $footer_setting->icon1:''}}">
                
                                                            <label>@lang('lang.font_awesome_icon') <span>*</span></label>
                                                            <span class="focus-border"></span>
                                                            @if ($errors->has('icon1'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('icon1') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 mt-40">
                                                        <div class="input-effect">
                                                            <input class="primary-input form-control{{ $errors->has('url1') ? ' is-invalid' : '' }}"
                                                                type="text" name="url1" autocomplete="off" value="{{isset($footer_setting)? $footer_setting->url1:''}}">
                
                                                            <label>@lang('lang.social_url') <span>*</span></label>
                                                            <span class="focus-border"></span>
                                                            @if ($errors->has('url1'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('url1') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 mt-40">
                                                        <div class="input-effect">
                                                            <input class="primary-input form-control{{ $errors->has('icon2') ? ' is-invalid' : '' }}"
                                                                type="text" name="icon2" autocomplete="off" value="{{isset($footer_setting)? $footer_setting->icon2:''}}">
                                                            <label>@lang('lang.font_awesome_icon') <span>*</span></label>
                                                            <span class="focus-border"></span>
                                                            @if ($errors->has('icon2'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('icon2') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 mt-40">
                                                        <div class="input-effect">
                                                            <input class="primary-input form-control{{ $errors->has('url2') ? ' is-invalid' : '' }}"
                                                                type="text" name="url2" autocomplete="off" value="{{isset($footer_setting)? $footer_setting->url2:''}}">
                                                            <label>@lang('lang.social_url') <span>*</span></label>
                                                            <span class="focus-border"></span>
                                                            @if ($errors->has('url2'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('url2') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="row">
                                                <div class="col-lg-4 mt-40">
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control{{ $errors->has('icon3') ? ' is-invalid' : '' }}"
                                                            type="text" name="icon3" autocomplete="off" value="{{isset($footer_setting)? $footer_setting->icon3:''}}">
            
                                                        <label>@lang('lang.font_awesome_icon') <span>*</span></label>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('icon3'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('icon3') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mt-40">
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control{{ $errors->has('url3') ? ' is-invalid' : '' }}"
                                                            type="text" name="url3" autocomplete="off" value="{{isset($footer_setting)? $footer_setting->url3:''}}">
            
                                                        <label>@lang('lang.social_url') <span>*</span></label>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('url3'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('url3') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 mt-40">
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control{{ $errors->has('icon4') ? ' is-invalid' : '' }}"
                                                            type="text" name="icon4" autocomplete="off" value="{{isset($footer_setting)? $footer_setting->icon4:''}}">
            
                                                        <label>@lang('lang.font_awesome_icon') <span>*</span></label>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('icon4'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('icon4') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mt-40">
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control{{ $errors->has('url4') ? ' is-invalid' : '' }}"
                                                            type="text" name="url4" autocomplete="off" value="{{isset($footer_setting)? $footer_setting->url4:''}}">
            
                                                        <label>@lang('lang.social_url') <span>*</span></label>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('url4'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('url4') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 mt-40">
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control{{ $errors->has('icon5') ? ' is-invalid' : '' }}"
                                                            type="text" name="icon5" autocomplete="off" value="{{isset($footer_setting)? $footer_setting->icon5:''}}">
            
                                                        <label>@lang('lang.font_awesome_icon') <span>*</span></label>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('icon5'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('icon5') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mt-40">
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control{{ $errors->has('url5') ? ' is-invalid' : '' }}"
                                                            type="text" name="url5" autocomplete="off" value="{{isset($footer_setting)? $footer_setting->url5:''}}">
            
                                                        <label>@lang('lang.social_url') <span>*</span></label>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('url5'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('url5') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mt-40">
                                                    <div class="input-effect">
                                                            <textarea name="copyright_text" rows="3" class="primary-input form-control{{ $errors->has('copyright_text') ? ' is-invalid' : '' }}">{{isset($footer_setting)? $footer_setting->copyright_text:''}}</textarea>
                                                        <label>@lang('lang.copyright_text') <span>*</span></label>
                                                        <span class="focus-border"></span>
                                                        @if ($errors->has('copyright_text'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('copyright_text') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>


                                    <div class="row mt-40">
                                        <div class="col-lg-12 text-center">
                                            <button class="primary-btn fix-gr-bg">
                                                <span class="ti-check"></span>
                                                @if(isset($edit))
                                                    @lang('lang.update')
                                                @endif
                                            </button>
                                        </div>
                                    </div>


                            </div>
                            {{ Form::close() }}
                        </div> 
                </div>
 
            </div>
        </div>
    </section>

 
@endsection

