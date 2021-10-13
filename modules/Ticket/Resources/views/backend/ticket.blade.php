@extends('backend.master')
@section('mainContent')
<script src="https://cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.ticket_list')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="{{ route('infixTicket_list')}}">@lang('lang.ticket_system')</a>
                <a href="#">@lang('lang.ticket_list')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area DM_table_info">
    <div class="container-fluid p-0">
        <div class="row justify-content-between p-3">
            <div class="bc-pages">
             
            </div>
          
            <div class="bc-pages">
                    <a href="{{ route('infixTicket_ticket') }}" class="primary-btn small fix-gr-bg">
                            <span class="ti-plus pr-2"></span>
                            @lang('lang.add')
                        </a>
            </div>
          

    </div>


           
            <div class="row">
                <div class="col-lg-12">
                        
                    <div class="">
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => ['infixTicket_search'], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_studentA']) }}
                            <div class="row white-box">
                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                <div class="col-lg-4 mt-30-md">
                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('category') ? ' is-invalid' : '' }}" id="select_class" name="category">
                                        <option data-display="@lang('lang.ticket_category') *" value="">@lang('lang.ticket_category') @lang('lang.select') *</option>
                                        @foreach($category as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                     @if ($errors->has('category'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-4 mt-30-md">
                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('priority') ? ' is-invalid' : '' }}" id="select_class" name="priority">
                                        <option data-display="@lang('lang.ticket_priority') *" value="">@lang('lang.ticket_priority') @lang('lang.select') *</option>
                                        @foreach($priority as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                     @if ($errors->has('priority'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('priority') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-4 mt-30-md">
                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('active_status') ? ' is-invalid' : '' }}" id="select_class" name="active_status">
                                        <option data-display="@lang('lang.status') *" value="">@lang('lang.status') *</option>
                                        <option value="0">@lang('lang.pending')</option>
                                        <option value="1">@lang('lang.complete')</option>
                                    </select>
                                     @if ($errors->has('active_status'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('active_status') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-12 mt-20 text-right">
                                    <button type="submit" class="primary-btn small fix-gr-bg">
                                        <span class="ti-search pr-2"></span>
                                        @lang('lang.search')
                                    </button>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
           

            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 ">
                            <div class="main-title lm_mb_35 sm_mb_20 ">
                                <h3 class="mb-0">@lang('lang.ticket_list')</h3>
                            </div>
                        </div>
                    </div>
                    

                        
                    <!-- </div> -->
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                     @if(session()->has('message-success') != "" ||
                                    session()->get('message-danger') != "")
                                    <tr>
                                        <td colspan="7">
                                            @if(session()->has('message-success'))
                                            <div class="alert alert-success">
                                                {{ session()->get('message-success') }}
                                            </div>
                                            @elseif(session()->has('message-danger'))
                                            <div class="alert alert-danger">
                                                {{ session()->get('message-danger') }}
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th width="25%">@lang('lang.subject')</th>
                                        <th width="15%">@lang('lang.category')</th>
                                        <th width="10%">@lang('lang.user') @lang('lang.name')</th>
                                        <th width="15%">@lang('lang.ticket_priority')</th>
                                        <th width="10%">@lang('lang.assignee')</th>
                                        <th width="10%">@lang('lang.status')</th>
                                        <th width="15%">@lang('lang.action')</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($tickets as $ticket)
                                    
                                    @if (Auth::user()->role_id == 1)
                                    <tr>
                                            <td>{{Illuminate\Support\Str::limit($ticket->subject,35)}}</td>
                                            <td>{{ @$ticket->ticket_category->name}}</td>
                                            <td>{{@$ticket->user->username}}</td>
                                            <td>{{ @$ticket->ticket_priority->name}}</td>
                                            <td>{{ isset($ticket->assignee->username) ? $ticket->assignee->username : 'Not assign yet !'}}</td>
                                            @if ($ticket->active_status == 0)
                                            <td>
                                                <button class="primary-btn small bg-danger text-white border-0">@lang('lang.pending')</button>
                                            </td>
                                            @endif
                                            @if ($ticket->active_status == 1)
                                            <td><button class="primary-btn small bg-success text-white border-0">@lang('lang.close')</button></td>
                                            @endif
                                            @if ($ticket->active_status == 2)
                                            <td>
                                                <button class="primary-btn small bg-warning  text-white border-0">@lang('lang.progress')</button>
                                            </td>
                                            @endif
                                            <td>
                                                    <div class="row">
                                                    <div class="col-sm-6">
                    
                                                    <div class="dropdown">
                                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                            @lang('lang.select')
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                                {{-- <a class="dropdown-item" href="{{ route('admin.ticket_view',$ticket->id)}}"> @lang('lang.view')</a> --}}
                                                                <a class="dropdown-item" href="{{ route('infixTicket_view',$ticket->id)}}"> @lang('lang.view')</a>
                                                                <a class="dropdown-item" href="{{ route('infixTicket_edit',$ticket->id)}}"> @lang('lang.edit')</a>
                                                                {{-- <a class="deleteUrl dropdown-item" data-modal-size="modal-md" title="Delete Ticket" href="{{ route('admin.ticket_delete_view',$ticket->id)}}"> @lang('lang.delete')</a> --}}

                                                                <a class="dropdown-item" data-toggle="modal" data-target="#deleteTicketModal{{$ticket->id}}"  href="#">@lang('lang.delete')</a>
                                                
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                </td>
                                    </tr>  
                                    @else                                     
                                    <tr>
                                          
                                            <td>{{Str::limit($ticket->subject,35)}}</td>
                                            <td>{{ $ticket->ticket_category->name}}</td>
                                            <td>{{$ticket->user->username}}</td>
                                            <td>{{ $ticket->ticket_priority->name}}</td>
                                            <td>{{ isset($ticket->assignee->username) ? $ticket->assignee->username : 'Not assign yet !'}}</td>
                                            @if (@$ticket->active_status == 0)
                                            <td>@lang('lang.pending')</td>
                                            @endif
                                            @if (@$ticket->active_status == 1)
                                            <td>@lang('lang.close')</td>
                                            @endif
                                            @if (@$ticket->active_status == 2)
                                            <td>@lang('lang.progress')</td>
                                            @endif

                                            <td>
                                                    <div class="row">
                                                    <div class="col-sm-6">
                    
                                                    <div class="dropdown">
                                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                            @lang('lang.select')
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">   
                                                            <a class="dropdown-item" href="{{ route('infixTicket_view',$ticket->id)}}"> @lang('lang.view')</a>
                                                            <a class="dropdown-item" href="{{ route('infixTicket_edit',$ticket->id)}}"> @lang('lang.edit')</a> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                </td>
                                    </tr>   
                                    @endif
                                        <div class="modal fade admin-query" id="deleteTicketModal{{$ticket->id}}" >
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">@lang('lang.delete') @lang('lang.ticket')</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="text-center">
                                                            {{-- <p class="text-danger">@lang('lang.deleteWarningQuestion') </p> --}}
                                                            <h4>@lang('lang.are_you_sure_to_delete')</h4>
                                                        </div>

                                                        <div class="mt-40 d-flex justify-content-between">
                                                            <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                                                            <a href="{{ route('admin.ticket_delete_view',$ticket->id)}}" class="text-light">
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
<script src="{{ asset('/')}}public/backend/js/jquery.min.js"></script>
<script src="{{ asset('/')}}public/backend/backend_modules.js"></script>

@endsection
