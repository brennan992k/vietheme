
@extends('frontend.master')
@push('css')
<link rel="stylesheet" href="{{ asset('public/frontend/package/') }}/style.css">    
@endpush
@section('content')

<div class="banner-area4">
    <div class="banner-area-inner">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="banner-info">
                        <h2>@lang('lang.package_plan')</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="login-area  registration_area mt-25 mb-40">
    <form action="{{ route('user.packageBuy') }}" name="registration" id="Pricing_pan_Buy" method="POST">
       @csrf 
        <input hidden type="text" value="{{ @$data['package']->id}}" name="package_id">
        <div class="container">
            <input type="hidden" id="url" value="{{url('/')}}">
            
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-12">
                    <div class="text-center white-box single_registration_area">
                        <div class="reg_tittle">
                            <h5>@lang('lang.Available') @lang('lang.Packages')</h5>
                        </div>
                    
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-effect">
                                        <select class="niceSelect w-100 bb form-control" name="package_plan">
                                            <option data-display="@lang('lang.select_package')" value="">@lang('lang.select_package')</option>
                                        @foreach ($data['all_package'] as $item)
                                            <option value="{{@$item->packageType->id }}" {{  @$data['package']->id == @$item->id ?'selected':'' }}>{{@$item->packageType->name }}</option>
                                        @endforeach

                                        </select>
                                        @if ($errors->has('package_plan'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('package_plan') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-effect">
                                        <select class="niceSelect w-100 package_price bb form-control" name="package_price">
                                            <option data-display="Select Package" value="">@lang('lang.select_package')</option>
                                            @if (@$data['package'])
                                                <option value="{{ @$data['package']->packageType->month }}" selected >{{ @$data['package']->packageType->month }}</option>
                                                <option value="{{ @$data['package']->packageType->half_year }}" >{{ @$data['package']->packageType->half_year }}</option>
                                                <option value="{{ @$data['package']->packageType->year }}" >{{ @$data['package']->packageType->year }}</option>
                                            @endif
                                        </select>
                                        @if ($errors->has('package_price'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('package_price') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <input hidden value="{{@$data['package']->packageType->month  }}"  readonly="readonly" type="text" id="amount" name="total">
            <div class="row justify-content-center align-items-center mt-30">
                <div class="col-lg-12">
                    <div class="text-center white-box single_registration_area">
                        <div class="reg_tittle">
                            <h5>@lang('lang.Billing') @lang('lang.Information')</h5>
                        </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group">
                                    <input class="form-control" type="text" name='first_name' value="{{ @$data['user']->profile->first_name}}" placeholder="First name"/>
                                    @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                                    </div>
                                    <div class="input-group">
                                        <input class="form-control" type="text" name='last_name' value="{{ @$data['user']->profile->last_name}}" placeholder="Last name"/>
                                        @if ($errors->has('last_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                    <div class="input-group">
                                        <input class="form-control" type="text" name='company_name' value="{{ @$data['user']->profile->company_name}}" placeholder="Company"/>
                                        @if ($errors->has('company_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('company_name') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="email"  value="{{ @$data['user']->email}}" placeholder="Email address" readonly="readonly"/>
                                    
                                    </div>
                                    <div class="input-group">
                                        <input class="form-control" type="text" name='address' value="{{ @$data['user']->profile->address}}" placeholder="Address"/>
                                        @if ($errors->has('address'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                  
                                </div>
                                <div class="col-lg-6">
                                        <div class="input-effect">
                                                <select class="wide customselect country dm_display_none"
                                                     name="country_id">
                                                    <option data-display="Country*">
                                                        Select</option>
                                                    @foreach ($data['country'] as $item)                                                                                        
                                                    <option value="{{ $item->id }}" {{@$data['user']->profile->country_id == @$item->id ?'selected':'' }}>{{ @$item->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('country_id'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('country_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="input-effect">
                                                <select class="wide state customselect dm_display_none"
                                                     name="state_id">
                                                        <option data-display="State*">
                                                            Select</option>
                                                            @if (@$data['user'])
                                                                <option value="{{ @$data['user']->profile->state_id }}" selected >{{ @$data['user']->profile->state->name }}</option>
                                                            @endif
                                                </select>
                                                @if ($errors->has('state_id'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('state_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="input-effect">
                                                <select class="wide city customselect dm_display_none"  name="city_id">
                                                    <option data-display="Town/City*">@lang('lang.select_city')</option>
                                                        @if (@$data['user'])
                                                        <option value="{{ @$data['user']->profile->city_id }}" selected >{{ @$data['user']->profile->city->name }}</option>
                                                        @endif
                                                </select>
                                                @if ($errors->has('city_id'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('city_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="input-group">
                                                <input class="form-control" type="text" name='zipcode' value="{{isset($data['user'])? $data['user']->profile->zipcode:old('zipcode')}}" placeholder="Zip code"/>
                                                @if ($errors->has('zipcode'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('zipcode') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                </div>


                             
                            </div>
                    </div>
                </div>
            </div>
            
            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="login_button text-center">
                        <button type="submit" class="primary-btn fix-gr-bg">
                            @lang('lang.next') @lang('lang.Now')!
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>    
</section>


<!--================ Start End Login Area =================-->

@endsection
@push('js')
<script src="{{asset('public/frontend/js/item.js')}}"></script>
<script src="{{ asset('public/frontend/js/') }}/package.js"></script>

@endpush