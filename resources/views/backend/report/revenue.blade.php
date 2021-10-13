@extends('backend.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.admin') @lang('lang.revenue')</h1>
            <div class="bc-pages">
                <a href="{{url('admin/dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.reports')</a>
                <a href="{{route('admin.revenue')}}">@lang('lang.admin') @lang('lang.revenue')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-8 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30">@lang('lang.select_criteria') </h3>
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
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'admin.revenue', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        <div class="row">
                            <div class="col-lg-3">
                              <select class="niceSelect w-100 bb form-control date_type" onchange="setDate(this)" name="date_type" id="date_type">
                                <option data-display="@lang('lang.set_date')" value="">@lang('lang.set_date')</option>
                                    <option data-display="Today" value="1"> Today </option>
                                    <option data-display="Yesterday" value="2"> Yesterday </option>
                                    <option data-display="Last 7 days" value="3"> Last 7 days </option>
                                    <option data-display="Last 30 days" value="4"> Last 30 days </option>
                                    <option data-display="This Month" value="5"> This Month </option>
                                    <option data-display="Last Month" value="6"> Last Month </option>
                                    <option data-display="Custom Range" value="7"> Custom Range </option>
                                    
                                </select>
                            </div>

                            <div class="col-lg-4 mt-30-md">
                               <div class="col-lg-12">
                                <div class="input-effect">
                                    <input class="primary-input date form-control {{ $errors->has('start_date') ? ' is-invalid' : '' }}" type="text" readonly placeholder="@lang('lang.start_date')" id="startDate"  name="start_date">
                                    <span class="focus-border"></span>
                                            @if ($errors->has('start_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('start_date') }}</strong>
                                            </span>
                                            @endif
                                </div>
                            </div>
                           </div>
                            <div class="col-lg-4 mt-30-md">
                               <div class="col-lg-12">
                                <div class="input-effect">
                                    <input class="primary-input date form-control {{ $errors->has('end_date') ? ' is-invalid' : '' }}" type="text" readonly placeholder="@lang('lang.end_date')" id="endDate"  name="end_date">
                                    <span class="focus-border"></span>
                                            @if ($errors->has('end_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('end_date') }}</strong>
                                            </span>
                                            @endif
                                </div>
                            </div>
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
    @if (isset($revenue_list ))
        
    
 <div class="row mt-40">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4 no-gutters">
                    <div class="main-title">
                        <h3 class="mb-0"> @lang('lang.revenue') @lang('lang.list')</h3>
                    </div>
                </div>
            </div>

         <div class="row">
                <div class="col-lg-12">
                    <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>@lang('lang.product')</th>
                                <th>@lang('lang.price')</th>
                                {{-- <th>@lang('lang.tax')</th> --}}
                                <th>@lang('lang.revenue')</th>
                                <th>@lang('lang.date')</th>
                            </tr>
                        </thead>
                        @php
                            $total_revenue=0;
                        @endphp
                        <tbody>
                            @foreach ($revenue_list as $item)
                            @php
                                $total_revenue+=$item['revenue'];
                            @endphp
                            <tr>
                                <td> {{@$item['title']}} </td>
                                <td> {{@$item['price']}} </td>
                                <td> {{@$item['revenue']}} </td>
                                <td> {{DateFormat(@$item['date'])}}</td>
                            </tr>
                            @endforeach
           
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td colspan="1">@lang('lang.total'): </td>
                                {{-- <td>{{$sale_count}}</td> --}}
                                <td colspan="2">{{$total_revenue}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
</section>


@endsection
