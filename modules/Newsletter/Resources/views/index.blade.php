@extends('backend.master')
@section('mainContent')
   <link rel="stylesheet" href="{{asset('/')}}/Modules/Newsletter/Resources/assets/newsletter.css">


<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.subscription') </h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#" class="active">@lang('lang.subscription') @lang('lang.list')</a>

            </div>
        </div>
    </div>
</section>


<section class="admin-visitor-area">
    <div class="container-fluid p-0">




        <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">
                                    @lang('lang.add')  @lang('lang.email')
                            </h3>
                        </div>
                        @if (isset($newsletter))
     <form action="{{ route ('update_subscription')}}" method="POST" class="form-horizontal" enctype="multipart/form-data" id="addCategory">
                <input type="hidden" name="id" value="{{ $newsletter->id }}">
        @else
     <form action="{{ route ('add_subscription')}}" method="POST" class="form-horizontal" enctype="multipart/form-data" id="addCategory">
                        @endif


                            @csrf
                                            {{-- @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif --}}
                        <div class="white-box">
                            <div class="add-visitor">

                                <div class="row mt-40">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="email"  name="email"
                                                   autocomplete="off" value="{{ isset($newsletter)?$newsletter->email:old('email')}}">
                                            <label>@lang('lang.email') <span>*</span></label>
                                            <span class="focus-border"></span>
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg">
                                            <span class="ti-check"></span>
                                                @if (isset($newsletter))
                                                @lang('lang.update')
                                                @else
                                                @lang('lang.add')
                                                @endif
                                                @lang('lang.email')

                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0">@lang('lang.subscription') @lang('lang.list')</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">


                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>

                                <tr>

                                    <th>@lang('lang.email')</th>
                                    <th>@lang('lang.status')</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['newsletter'] as $item)
                               <input type="hidden" id="id" value="{{$item->id}}">
                                <tr id="{{$item->id}}">

                                    <td valign="top">{{$item->email}}</td>
                                    <td>
                                            <label class="switch">
                                              <input type="checkbox" class="switch-input-newsletter" {{$item->active_status == 0? '':'checked'}}>
                                              <span class="slider round"></span>
                                            </label>
                                        </td>

                                    <td valign="top">
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{ url('newsletter/email-edit/'.$item->id)}}">@lang('lang.edit')</a>
                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteClassModal{{$item->id}}"  href="#">@lang('lang.delete')</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                  <div class="modal fade admin-query" id="deleteClassModal{{$item->id}}" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('lang.delete') @lang('lang.email')</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                      <a href="{{ route('email_Delete',$item->id)}}" class="text-light">
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
        </div>
    </div>
</section>

@endsection


