@extends('backend.master')
@section('mainContent')

<link rel="stylesheet" href="{{asset('/Modules/RolePermission/public/css/style.css')}}">
<link rel="stylesheet" href="{{asset('public/backEnd/')}}/assign_permission.css">

<section class="sms-breadcrumb mb-40 white-box lol">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.role_permission') </h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.system_settings')</a>
                <a href="#">@lang('lang.role_permission')</a> 
            </div>
        </div>
    </div>
</section>

<div class="role_permission_wrap">
        <div class="permission_title">
            <h4>@lang('lang.assign_permission') ({{@$role->name}})</h4>
        </div>
    </div>

    <div class="erp_role_permission_area ">



        <!-- single_permission  -->

    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'assign_permission_update',
                        'method' => 'POST']) }}
                        <div  class="mesonary_role_header">
            @foreach ($modules as $key=> $module)
                <div class="single_role_blocks">
                    <div class="single_permission" id="">
                        <div class="permission_header d-flex align-items-center justify-content-between">
                            <div>
                                <input type="hidden" name="module_id[{{@$module->id}}]" value="{{@$module->id}}">
                                <input type="checkbox" name="permission[{{@$module->id}}]" value="1"  id="Main_Module_{{@$module->id}}" class="common-radio permission-checkAll main_module_id_" {{ $module->permission == 1 ? 'checked':''}} >
                            <label for="Main_Module_{{@$module->id}}">{{@$module->name}}</label>
                            </div>
                        </div>


                        {{-- <div id="Role1" class="collapse">
                        <div  class="permission_body">
                        <ul>
                            <li>
                                <div class="submodule">
                                    <input id="Sub_Module_" name="module_id[]" value=""  class="infix_csk common-radio  module_id_ module_link"  type="checkbox" >

                                    <label for="Sub_Module_">Sub Module</label>
                                    <br>
                                </div>

                                <ul class="option">

                               
                                  <li>
                                      <div class="module_link_option_div" id="">
                                          <input id="Option_" name="module_id[]" value=""  class="infix_csk common-radio    module_id_ module_option__ module_link_option"  type="checkbox" >

                                          <label for="Option_">Sub 2</label>
                                          <br>
                                      </div>
                                  </li>

                            
                                </ul>
                              </li>
                        </ul> --}}
                    {{-- </div>
                    </div> --}}
                </div>
            </div>
            @endforeach
 </div>
         <div class="row mt-40">
            <div class="col-lg-12 text-center">
                <button class="primary-btn fix-gr-bg">
                    <span class="ti-check"></span>
                    @lang('submit')
                    
                </button>
            </div>
        </div>

         {{ Form::close() }}


    </div>

@endsection



@section('script')




@endsection
