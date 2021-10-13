@extends('backend.master')
@section('mainContent')



<link rel="stylesheet" href="{{'public/bkacEnd/'}}/modules.css">
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('lang.about')  @lang('lang.system') </h1>
                <div class="bc-pages">
                    <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">@lang('lang.system_settings')</a>
                    <a href="#">@lang('lang.about')  @lang('lang.system') </a>
                </div>
            </div>
        </div>
    </section>   

    <section class="admin-visitor-area up_admin_visitor empty_table_tab">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4">
                 
                   @if (!appMode())
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'updateSystem', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                   @endif
                   
                    <div class="white-box sm_mb_20 sm2_mb_20 md_mb_20 ">
                        <div class="main-title">
                            <h3 class="mb-30">@lang('lang.Upload_From_Local_Directory')</h3>
                        </div>
                        <div class="add-visitor">

                            <div class="row no-gutters input-right-icon mb-20">
                                <div class="col">
                                    <div class="input-effect">
                                        <input
                                            class="primary-input form-control {{ $errors->has('content_file') ? ' is-invalid' : '' }}"
                                            readonly="true" type="text"
                                            placeholder="{{isset($editData->file) && @$editData->file != ""? getFilePath3(@$editData->file):app('translator')->get('lang.browse')}} "
                                            id="placeholderPhoto" name="content_file">
                                        <span class="focus-border"></span>
                                        @if ($errors->has('content_file'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('content_file') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button class="primary-btn-small-input" type="button">
                                        <label class="primary-btn small fix-gr-bg"
                                               for="photo">@lang('lang.browse')</label>
                                        <input type="file" class="d-none form-control" name="updateFile"
                                               required
                                               id="photo">
                                    </button>

                                </div>
                            </div>
                            @php
                            $tooltip = "";
                            if (appMode()){
                                $tooltip ='For the demo version, you cannot change this';
                            }
                        @endphp

                            <div class="row mt-40">
                                <div class="col-lg-12 text-center">
                                    <button class="primary-btn fix-gr-bg" data-toggle="tooltip"
                                            title="{{@$tooltip}}">
                                        <span class="ti-check"></span>
                                        @if(isset($session))
                                            @lang('lang.update')
                                        @else
                                            @lang('lang.save')
                                        @endif

                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>

                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="white-box">
                                <h2 class="main-title">@lang('lang.about')  @lang('lang.system') </h2>
                                <div class="add-visitor">
                                    <table style="width:100%; box-shadow: none;"  class="display school-table school-table-style about_system_table">
                                        @php 
                                            @$data = app('infix_general_settings');
                                            $importFile = Illuminate\Support\Facades\File::get(storage_path('app/' . '.version'));
                                        @endphp
                                        <tr>

                                            <td>@lang('lang.software_version')</td>
                                            <td>
                                                @if ($importFile)
                                                    {{@$importFile}}
                                                @else
                                                    {{@$data->software_version}}
                                                @endif
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>@lang('lang.Check_update')</td>
                                            <td><a href="https://codecanyon.net/user/codethemes/portfolio" target="_blank"> <i class="ti-new-window"> </i>@lang('lang.update') </a> </td>
                                        </tr> 
                                        <tr>
                                            <td> @lang('lang.PHP_version')</td>
                                            <td>{{phpversion() }}</td>
                                        </tr>
                                        <tr>
                                            <td> @lang('lang.curl_enable')</td>
                                            <td>@php
                                            if  (in_array  ('curl', get_loaded_extensions())) {
                                                echo 'enable';
                                            }
                                            else {
                                                echo 'disable';
                                            }
                                            @endphp</td>
                                        </tr>
                           
                                        
                                        <tr>
                                            <td> @lang('lang.purchase_code')</td>
                                            <td>{{__('Verified')}}</td>
                                        </tr>
                           

                                        <tr>
                                            <td>@lang('lang.install_domain')</td>
                                            <td>{{@$data->system_domain}}</td>
                                        </tr>

                                        <tr>
                                            <td> @lang('lang.system_activated_date')</td>
                                            <td>{{DateFormat(@$data->system_activated_date)}}</td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                            

                </div>
            </div>
        </div>
    </section>


@endsection



