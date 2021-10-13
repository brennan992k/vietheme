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
            <h1>@lang('lang.agent')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="{{route('admin.agent')}}">@lang('lang.agent') @lang('lang.list')</a>
                <a href="">@lang('lang.agent') @lang('lang.edit')</a>
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
                <h3 class="mb-20">@lang('lang.agent') @lang('lang.details')</h3>
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
                                    @lang('lang.agent') @lang('lang.name')
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
                                 @lang('lang.date_of_joining')
                            </div>
                            <div class="value">
                                @if(isset($data))
                                {{ DateFormat(@$data->created_at) }}
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
                        <a class="nav-link active" href="#studentProfile" role="tab" data-toggle="tab">@lang('lang.profile')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#Earning" role="tab" data-toggle="tab">@lang('lang.balance')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#staffDocuments" role="tab" data-toggle="tab">@lang('lang.credit') @lang('lang.card')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#ItemBuy" role="tab" data-toggle="tab">@lang('lang.buy') @lang('lang.item')</a>
                    </li>
                    <li class="nav-item edit-button">
                        <a href="{{ route('admin.agent_edit',@$data->id)}}" class="primary-btn small fix-gr-bg">@lang('lang.edit')
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Start Profile Tab -->
                    <div role="tabpanel" class="tab-pane fade show active" id="studentProfile">
                        <div class="white-box">
                            <h4 class="stu-sub-head">@lang('lang.personal_info')</h4>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            @lang('lang.mobile_no')
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            @if(isset($data)){{@$data->profile->mobile}}@endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                            @lang('lang.email')
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                            @if(isset($data)){{@$data->email}}@endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                               @lang('lang.company') @lang('lang.name')
                                            </div>
                                        </div>
    
                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                @if(isset($data->profile->company_name)){{@$data->profile->company_name}}@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                @lang('lang.address')
                                            </div>
                                        </div>
    
                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                @if(isset($data->profile->address)){{@$data->profile->address}}@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                @lang('lang.Date_of_birth')
                                            </div>
                                        </div>
    
                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                @if(isset($data->profile->dob)) {{ DateFormat(@$data->profile->dob) }}@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6">
                                            <div class="">
                                                @lang('lang.marital_status')
                                            </div>
                                        </div>
    
                                        <div class="col-lg-7 col-md-7">
                                            <div class="">
                                                 @if (@$data->profile->marital_status == "married")
                                                    @lang('lang.married')
                                                 @endif
                                                 @if (@$data->profile->marital_status == "unmarried")
                                                    @lang('lang.unmarried')
                                                 @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>


                        </div>
                    </div>
                    <!-- End Profile Tab -->

                    <!-- Start leave Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="Earning">
                        <div class="white-box">
                            <div class="row mt-30">
                                <div class="col-lg-12">
                                    <div class="row">
                                            <div class="col-lg-3 col-6">
                                                <a href="#" class="d-block">
                                                    <div class="white-box single-summery">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <h3> {{ @GeneralSetting()->currency_symbol}} {{ @$data->balance->amount}}</h3>
                                                                <p class="mb-0">@lang('lang.total') @lang('lang.balance')</p>
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
                    <!-- End leave Tab -->

                    <!-- Start Documents Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="staffDocuments">
                        <div class="white-box">
                            <h4 class="stu-sub-head">@lang('lang.added') @lang('lang.card')</h4>
                            @if(isset($data->credit_card))                            
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                             @lang('lang.card') @lang('lang.name')
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            @if(isset($data->credit_card)){{@$data->credit_card->name}}@endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                                @lang('lang.card') @lang('lang.number')
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                            @if(isset($data->credit_card)){{@$data->credit_card->card_number}}@endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                                @lang('lang.cvc') 
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                            @if(isset($data->credit_card)){{@$data->credit_card->cvc}}@endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                                @lang('lang.expiration') @lang('lang.date') 
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                            {{ @$data->credit_card->exp_mm}}/{{ @$data->credit_card->exp_yy}}
                                        </div>
                                    </div>
                                </div>
                            </div>                           
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                                @lang('lang.status') 
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                            @if (@$data->credit_card->status == 1)
                                            @lang('lang.active')
                                            @else   
                                            @lang('lang.pending')
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            @else
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                                @lang('lang.no') 
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            @endif                         

                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="ItemBuy">
                            <div class="white-box">
                                <div class="text-right mb-20">
                                    <table id="table_id" class="display school-table" cellspacing="0" width="100%">
    
                                        <thead>
                                       
                                            <tr>
                                                <th>@lang('lang.title')</th>
                                                <th>@lang('lang.category')</th>
                                                <th>@lang('lang.demo') @lang('lang.url')</th>
                                                <th>@lang('lang.image')</th>
                                                <th>@lang('lang.price')</th>
                                                <th>@lang('lang.status')</th>
                                                <th>@lang('lang.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data->itemOrder as $item)
                                            <tr>  
                                                <td hidden>{{ @$item->id}}</td>
                                                <td><a target="_blank" href="{{ route('singleProduct',[str_replace(' ', '-',@$item->Item->title),@$item->id])}}">{{Str::limit(@$item->Item->title,20)}}</a></td>
                                                <td valign="top">{{@$item->Item->category->title}} / {{@$item->Item->subCategory->title}}</td>
                                                <td valign="top"><a href="{{@$item->Item->demo_url}}" target="_blank" class="primary-btn small fix-gr-bg">@lang('lang.click_here')</a></td>
                                                <td valign="top"><img src="{{asset($item->Item->icon)}}" height="40px" width="40px"></td>
                                                <td valign="top">{{ @GeneralSetting()->currency_symbol}} {{@$item->subtotal}}</td>
                                                <td valign="top">
                                                            @if ($item->status == 1)
                                                            @lang('lang.active')
                                                            @else   
                                                            @lang('lang.pending')
                                                            @endif
                                                </td>
                                                <td valign="top">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                            @lang('lang.select')
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                         <a class="dropdown-item" target="_blank" href="{{ route('singleProduct',[str_replace(' ', '-',@$item->Item->title),@$item->Item->id])}}">@lang('lang.view')</a>
                                                            {{-- <a class="dropdown-item" target="_blank" href="{{ route('admin.contentEdit',$item->id)}}">@lang('lang.edit')</a>
                                                            <a class="dropdown-item" data-toggle="modal" data-target="#deleteClassModal{{$item->id}}"  href="">@lang('lang.delete')</a> --}}
                                                        </div>
                                                    </div>
                                                </td>
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
