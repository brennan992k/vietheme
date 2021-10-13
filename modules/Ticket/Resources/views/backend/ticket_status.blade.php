@extends('backend.master')
@section('mainContent')

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
<section class="mb-40 up_dashboard">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-title">
                        <h3>@lang('lang.ticket') @lang('lang.status')</h3> 
                        {{-- {{Session::get('LoginData')->school_name}}--}}
     
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-lg-12">
                    @if(session()->has('message-success'))
                    <div class="alert alert-success">
                     {{ session()->get('message-success') }}
                 </div>
                 @elseif(session()->has('message-danger'))
                 <div class="alert alert-danger">
                  {{ session()->get('message-danger') }}
              </div>
              @endif
          </div>
      </div>
    @php
    $getData=App\Models\ManageQuery::InfixTicket();
        $progress=$getData['progress'];
        $pending=$getData['pending'];
        $close=$getData['close'];
    @endphp
      
      <div class="row">
      
        <div class="col-lg-4 col-md-4 mt-30-md">
            <a href="#" class="d-block">
              <div class="white-box single-summery">
                <div class="d-flex justify-content-between">
                  <div>
                    <h3>@lang('lang.pending') @lang('lang.ticket')</h3>
                    <p class="mb-0">@lang('lang.total') @lang('lang.pending') @lang('lang.ticket')</p>
                  </div>
                  <h1 class="gradient-color2">{{@$pending}}</h1>
                </div>
              </div>
            </a>
          </div> 
        <div class="col-lg-4 col-md-4 mt-30-md">
          <a href="#" class="d-block">
            <div class="white-box single-summery">
              <div class="d-flex justify-content-between">
                <div>
                  <h3>@lang('lang.progress') @lang('lang.ticket')</h3>
                  <p class="mb-0">@lang('lang.total') @lang('lang.progress') @lang('lang.ticket')</p>
                </div>
                <h1 class="gradient-color2">{{@$progress}}</h1>
              </div>
            </div>
          </a>
        </div> 
        <div class="col-lg-4 col-md-4 mt-30-md">
          <a href="#" class="d-block">
            <div class="white-box single-summery">
              <div class="d-flex justify-content-between">
                <div>
                  <h3>@lang('lang.close') @lang('lang.ticket')</h3>
                  <p class="mb-0">@lang('lang.total') @lang('lang.close') @lang('lang.ticket')</p>
                </div>
                <h1 class="gradient-color2">{{@$close}}</h1>
              </div>
            </div>
          </a>
        </div> 
       
    </div>
        </div>
</section>
            
<div class="row mt-40">
  <div class="col-lg-12">
      <div class="row">
          <div class="col-lg-12 col-md-12 no-gutters">
              <div class="main-title lm_mb_35 sm_mb_20">
                  <h3 class="mb-0">@lang('lang.ticket') @lang('lang.list')</h3>
              </div>
          </div>
      </div>
      

          
      <!-- </div> -->
      <div class="row DM_table_info">
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
                          {{-- <th width="10%">@lang('lang.author')</th> --}}
                          <th width="10%">@lang('lang.status')</th>
                          {{-- <th width="15%">@lang('lang.action')</th> --}}
                      </tr>
                  </thead>

                  <tbody>
                      @foreach($tickets as $ticket)
                      @if (Auth::user()->role_id == 1)
                      <tr>
                              <td><a href="{{ route('infixTicket_view',$ticket->id)}}" >{{Str::limit($ticket->subject,35)}}</a> </td>
                              <td>{{ $ticket->category_name}}</td>
                              <td>{{$ticket->user}}</td>
                              <td>{{ $ticket->priority_name}}</td>
                              {{-- <td>{{@$ticket->author?$ticket->author:'Not assign yet !'}}</td> --}}
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
                             
                      </tr>  
                      @else
                      @if (isset($ticket->author_id) && @Auth::user()->id == $ticket->author_id)
                       
                      <tr>
                            
                              <td>{{Str::limit($ticket->subject,35)}}</td>
                              <td>{{ $ticket->category_name}}</td>
                              <td>{{$ticket->user}}</td>
                              <td>{{ $ticket->priority_name}}</td>
                              <td>{{@$ticket->author?$ticket->author:'Not assign yet !'}}</td>
                              @if ($ticket->active_status == 0)
                              <td>@lang('lang.pending')</td>
                              @endif
                              @if ($ticket->active_status == 1)
                              <td>@lang('lang.close')</td>
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
                                              <a class="dropdown-item" href=""> @lang('lang.view')</a>
                                              <a class="dropdown-item" href="{{ route('infixTicket_edit',$ticket->id)}}"> @lang('lang.edit')</a>
                                              <a class="deleteUrl dropdown-item" data-modal-size="modal-md" title="Delete Ticket" href="{{ route('admin.ticket_delete_view',$ticket->id)}}"> @lang('lang.delete')</a>
      
                                              
      
                                          </div>
                                      </div>
                                  </div>
                              </div>
                                  </td>
                      </tr>   
                      @endif
                      @endif
                      @endforeach
                  </tbody>
              </table>
          </div>
      </div>
    
  </div>
</div>    


@endsection
