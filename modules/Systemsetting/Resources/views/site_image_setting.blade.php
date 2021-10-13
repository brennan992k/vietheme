@extends('backend.master')
@section('mainContent')
    @php
        function showPicName($data){
            $name = explode('/', $data);
            return $name[3];
        }
    @endphp
   

<link rel="stylesheet" href="{{'public/bkacEnd/'}}/modules.css">
<link rel="stylesheet" href="{{asset('public/backend/modules.css')}}">
    <section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('lang.site_image_settings')</h1>
                <div class="bc-pages">
                    <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">@lang('lang.site_image_settings')</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">  
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0">@lang('lang.site_image_settings')</h3>
                            </div>
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <input type="hidden" id="url" value="{{url('/')}}">
                                <thead>
                                @if(session()->has('message-success') != "" ||
                                session()->get('message-danger') != "")
                                    <tr>
                                        <td colspan="4">
                                            @if(session()->has('message-success-status'))
                                                <div class="alert alert-success">
                                                    @lang('lang.inserted_message')
                                                </div>
                                            @elseif(session()->has('message-danger'))
                                                <div class="alert alert-danger">
                                                    @lang('lang.error_message')
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>@lang('lang.sl')</th>
                                    <th>@lang('lang.title')</th>
                                    {{-- <th>@lang('lang.type')</th> --}}
                                    <th>@lang('lang.background') @lang('lang.image')</th>
                                    {{-- <th>@lang('lang.status')</th> --}}
                                    <th>@lang('lang.action')</th>
                                </tr>
                                </thead>

                                <tbody>
                                    @foreach ($editDatas as $editData)
                                    <tr>
                                        <td>{{$editData->id}}</td>
                                        <td>{{$editData->title}}</td>
                                        {{-- <td><p class="primary-btn small tr-bg">{{$editData->type}}</p></td> --}}
                                        <td>
                                             @if($editData->type == 'image')
                                            <img src="{{asset($editData->image)}}" 
                                            @if (@$editData->id == 3 || @$editData->id == 4)
                                                width="220px" height="auto"
                                            @elseif (@$editData->id == 2)
                                                width="60px" height="auto"
                                            @else
                                                width="180px" height="auto">
                                            @endif
                                             
                                            @else
                                             <div class="site_image_color" style="background-color:{{$editData->color}} "></div>
                                            @endif
                                        </td>
                                        </td>

                                        <td>
                                           
                                            @if ($editData->id==4)
                                                <a href="#" data-toggle="modal" class="primary-btn small fix-gr-bg mb-20" data-target="#modalLogin">View Text</a>
                                            @endif
                                            @if ($editData->id==5)
                                                <a href="#" data-toggle="modal" class="primary-btn small fix-gr-bg mb-20" data-target="#modalAddBrand">View Text</a>
                                            @endif
                                           <a  data-toggle="modal" onclick="lol({{ $editData->id }})" class="primary-btn small fix-gr-bg mb-20" data-target="#addQuery{{ $editData->id }}"  href="#"> @lang('lang.change')</a>

                                        </td>
                                    
                                    </tr>
                                    {{-- @if ($editData->id==5) --}}
                                    <div class="modal fade" id="modalLogin" >
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                   
                                                     <h4 class="modal-title" id="modalAddBrandLabel">@lang('lang.sign_in_page_message')</h4>
                                                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    
                                                </div>
                                            @php
                                                $message=App\Models\ManageQuery::SiteInageMessage(4);
                                            @endphp
                                                <div class="modal-body">
                                                    <form action="{{url('systemsetting/update_login_msg')}}" method="post">
                                                   @csrf
                                                     <textarea id="summernoteLogin" class="primary-input form-control{{ $errors->has('signin_message') ? ' is-invalid' : '' }}" name="signin_message"  cols="30" rows="30">{{ $message->additional_text }}</textarea>
                                                     <div class="row mt-20">
                                                        <div class="col-lg-12 text-center">
                                                            <button id="AddBrandButton" type="submit" class="primary-btn small fix-gr-bg mb-20">@lang('lang.update')</button>
                                                        
                                                        </div>
                                                    </div>
                                                </form>
                                                </div>
                                                   
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="modalAddBrand" >
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                   
                                                     <h4 class="modal-title" id="modalAddBrandLabel">@lang('lang.404_error_message_text')</h4>
                                                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    
                                                </div>
                                            @php
                                                $message=App\Models\ManageQuery::SiteInageMessage(5);
                                            @endphp
                                                <div class="modal-body">
                                                    <form action="{{url('systemsetting/update_error_msg')}}" method="post">
                                                   @csrf
                                                     <textarea id="summernoteError" class="primary-input form-control{{ $errors->has('message') ? ' is-invalid' : '' }}" name="message"  cols="30" rows="30">{{ $message->additional_text }}</textarea>
                                                     <div class="row mt-20">
                                                        <div class="col-lg-12 text-center">
                                                            <button id="AddBrandButton" type="submit" class="primary-btn small fix-gr-bg mb-20">@lang('lang.update')</button>
                                                        
                                                        </div>
                                                    </div>
                                                </form>
                                                </div>
                                                   
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                    {{-- @endif --}}

              
                                <div class="modal fade admin-query" id="addQuery{{ $editData->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Change {{$editData->title}} </h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <div class="modal-body">
                                                    <center>
                                                        <br/><br/>
                                                    @if (isset($editData->image))
                                                            <div id="image" class="mb-30">
                                                            <img @if (@$editData->id == 3 || @$editData->id == 4) width="240px" height="auto" @elseif (@$editData->id == 2) width="80px" height="auto" @else width="220px" height="auto" @endif id="preview_image" src="{{asset($editData->image)}}"/>
                                                            <i id="loading" class="fa fa-spinner fa-spin fa-3x fa-fw  site_image_spinner" ></i>
                                                        </div>
                                                    @else
                                                        <div id="image" class="mb-20">
                                                            <img width="200" height="auto" id="preview_image" src="{{asset('images/noimage.jpg')}}"/>
                                                            <i id="loading" class="fa fa-spinner fa-spin fa-3x fa-fw  site_image_spinner" ></i>
                                                        </div>
                                                    @endif
                                                        <form>
                                                        <p>
                                                            <a href="javascript:changeProfile()" class="primary-btn small fix-gr-bg mb-20 site_image_upload_a">
                                                                @lang('lang.upload_photo')
                                                            </a>&nbsp;&nbsp;
                                                        </p>
                                                        <input type="file" id="bg_image" hidden class="site_image_hidden_bg_image"/>
                                                        <input type="hidden" id="file_name"/>
                                                        <form>
                                                    </center>
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
<center>
    <br/><br/>


</center>
<!-- JavaScripts -->
<script src="{{ asset('/')}}Modules/Systemsetting/Resources/assets/js/jquery-3.1.1.min.js"></script>
<script src="{{ asset('/')}}Modules/Systemsetting/Resources/assets/js/fontawesome.js"></script>

<script src="{{ asset('/')}}public/backend/ajax_image_upload.js"></script>



@endsection
