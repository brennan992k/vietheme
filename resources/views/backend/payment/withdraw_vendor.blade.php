@extends('backend.master')
@section('mainContent')

@php
function showPicName($data){
$name = explode('/', $data);
return $name[4];
}
function showJoiningLetter($data){
$name = explode('/', $data);
return $name[3];
}
function showResume($data){
$name = explode('/', $data);
return $name[3];
}
function showOtherDocument($data){
$name = explode('/', $data);
return $name[3];
}

@endphp
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.withdraws')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="{{route('admin.payableUser')}}">@lang('lang.vendor') @lang('lang.withdraws') @lang('lang.list')</a>
            </div>
        </div>
    </div>
</section>
<section class="mb-40 student-details">
    <div class="container-fluid p-0">
        <div class="row">
         <div class="col-lg-3">
            <!-- Start Student Meta Information -->
            <div class="main-title">
                <h3 class="mb-20">@lang('lang.vendor') @lang('lang.info')</h3>
            </div>
            <div class="student-meta-box">
                <div class="student-meta-top"></div>
                @if(!empty(@$data->profile->image))
                <img class="student-meta-img img-100" src="{{asset(@$data->profile->image)}}"  alt="">
                @else
                <img class="student-meta-img img-100" src="{{asset('public/frontend/img/profile/1.png')}}"  alt="">
                @endif
                <div class="white-box">
                    <div class="single-meta mt-10">
                        <div class="d-flex justify-content-between">
                            <div class="name">
                                @lang('lang.vendor') @lang('lang.name')
                            </div>
                            <div class="value">
                                @if(isset($data)){{@$data->full_name}}@endif
                            </div>
                        </div>
                    </div>
                    <div class="single-meta">
                        <div class="d-flex justify-content-between">
                            <div class="name">
                                @lang('lang.role') 
                            </div>
                            <div class="value">
                               @if(isset($data)){{@$data->role->name}}@endif
                           </div>
                       </div>
                   </div>
                    <div class="single-meta">
                        <div class="d-flex justify-content-between">
                            <div class="name">
                                @lang('lang.balance') 
                            </div>
                            <div class="value">
                               @if(isset($data)) {{@GeneralSetting()->currency_symbol}} {{@$data->balance->amount}}@endif
                           </div>
                       </div>
                   </div>
                    <div class="single-meta">
                        <div class="d-flex justify-content-between">
                            <div class="name">
                                @lang('lang.date_of_joining')
                            </div>
                            <div class="value">
                                @if(isset($data))
                                {{date('jS M, Y', strtotime(@$data->created_at))}}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Student Meta Information -->

            </div>

            <!-- Start Student Details -->
            <div class="col-lg-9 staff-details">
        
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#Earning" role="tab" data-toggle="tab">@lang('lang.earnings')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#studentProfile" role="tab" data-toggle="tab">@lang('lang.payment')</a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" href="#withdraw_history" role="tab" data-toggle="tab">@lang('lang.withdraws') @lang('lang.history')</a>
                    </li> 
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Start Profile Tab -->
                    <!-- Start leave Tab -->
                    <div role="tabpanel" class="tab-pane fade show active" id="Earning">
                            <div class="white-box">
                                <div class="row mt-30">
                                    <div class="col-lg-12">
                                        <div class="row">
                                                <div class="col-lg-3 col-6">
                                                    <a href="#" class="d-block">
                                                        <div class="white-box single-summery">
                                                            <div class="d-flex justify-content-between">
                                                                <div>
                                                                    <h3> {{@GeneralSetting()->currency_symbol}} {{@$data->balance->amount}} </h3>
                                                                    <p class="mb-0">@lang('lang.total') @lang('lang.earning')</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div role="tabpanel" class="tab-pane fade " id="studentProfile">
                        <div class="white-box">
                            <h4 class="stu-sub-head">@lang('lang.vendor') @lang('lang.card') @lang('lang.info')</h4>
                          

                            <div class="single-info">
                                    <form accept-charset="UTF-8" action="{{ route('admin.paymentAuthor') }}" class="require-validation"  id="payment-form" method="post">
                                        {{ csrf_field() }}
                                       <input type="text" hidden value="{{ @$payout_setup->user_id }}" name="user_id">
                                       <input type="text" hidden value="{{ @$payout_setup->id }}" name="payment_method_id">
                                        <div class='form-row'>
                                            <div class='col-xl-12 form-group'>
                                                <label class='control-label'>@lang('lang.card') @lang('lang.name')</label> <input value="{{ @$payout_setup->payment_method_name }}" name="card_name"
                                                    class='form-control' size='4' type='text' readonly>
                                            </div>
                                        </div>
                                        <div class='form-row'>
                                            <div class='col-xl-12 form-group'>
                                                <label class='control-label'>@lang('lang.email')</label> <input
                                            autocomplete='off' class='form-control card-number' size='20' value="{{ @$payout_setup->payout_email }}" name="email"
                                                    type='text' readonly>
                                            </div>
                                        </div>
                                        <div class='form-row'>
                                            <div class='col-xl-12 form-group'>
                                                <label class='control-label'>@lang('lang.phone')</label> <input
                                            autocomplete='off' class='form-control card-number' size='20' value="{{ @$payout_setup->payout_phone }}" name="phone"
                                                    type='text' readonly>
                                            </div>
                                        </div>
                                       
                                        <div class="form-row">
                                            <div class='col-xl-12 form-group'>
                                                <label class='control-label'> @lang('lang.total')</label> <input
                                                    class='form-control' placeholder='YYYY' value="{{ @$data->balance->amount}}" name="amount"
                                                     type='text'>
                                            </div>
                                        </div>
                                        <div class="form-row">

                                            <div class='col-xl-12 form-group text-center'>
                                                <button type="submit" class="primary-btn fix-gr-bg">@lang('lang.paid')</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="withdraw_history">
                        <div class="white-box">
                            <h4>@lang('lang.withdraws') @lang('lang.history')</h4>
                            <div class="text-right mb-20">
                                <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                                    <thead>
                                   
                                        <tr class="withdraw_vendor_aligh_left">
                                            {{-- <th>@lang('lang.username')</th> --}}
                                            <th>@lang('lang.card') @lang('lang.name')</th>
                                            <th>@lang('lang.email')</th>
                                            <th>@lang('lang.phone')</th>
                                            <th>@lang('lang.amount')</th>
                                            <th>@lang('lang.withdraws') @lang('lang.date')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($withdraw as $item)
                                        <tr>  
                                            {{-- <td valign="top">{{ @$item->username }}</td> --}}
                                            <td valign="top">{{ @$item->payment_method_name }}</td>
                                            <td valign="top">{{ @$item->payout_email }}</td>
                                            <td valign="top">{{ @$item->payout_phone }}</td>
                                            <td valign="top">{{ @$item->amount }}</td>
                                             <td valign="top">{{DateFormat($item->created_at)}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
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
@section('script')

@endsection
