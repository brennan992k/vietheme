<!DOCTYPE html>
<html>
<head>
	<title>{{ $item_details->title }} @lang('lang.license')</title>
    <link rel="stylesheet" href="{{asset('public/css/common_style.css')}}">
    <style>
        body{
            font-family: "Open Sans", sans-serif;
        }
    </style>
</head>

<body>
    @php
        $logo_conditions = ['title'=>'Logo', 'active_status'=>1];
        $logo = dashboard_background($logo_conditions);
    @endphp
    <img src="{{ @$logo ? asset(@$logo->image) : asset('public/frontend/img/Logo.png') }}" alt="" class="dm_max_width_123">
    <h2 class="dm_title_style">@lang('lang.license_certificate')</h2>
    <p></p>
    <table class="sm_padding_left">
        <tr>
            <td class="dm_font_weight">@lang('lang.licensors_author_username'):</td>
            <td>{{ $author_details->username }}</td>
        </tr>
        <tr>
            <td class="dm_font_weight">@lang('lang.license'):</td>
            <td>{{ $user_details->username }}</td>
        </tr>
        <tr>
            <td class="dm_font_weight">@lang('lang.item_title'):</td>
            <td>{{ $item_details->title }}</td>
        </tr>
        <tr>
            <td class="dm_font_weight">@lang('lang.item_URL'):</td>
            <td>{{ route('singleProduct',[str_replace(' ','-',$item_details->title),$item_details->id]) }}</td>
        </tr>
         <tr>
            <td class="dm_font_weight">@lang('lang.item_ID'):</td>
            <td>{{ $item_details->id }}</td>
        </tr>
         <tr>
            <td class="ft">@lang('lang.item_purchase_code'):</td>
            <td>{{ @$purchase_code->purchase_code }}</td>
        </tr>
         <tr>
            <td class="ft">@lang('lang.item_purchase_date'):</td>
            <td>{{ @$purchase_code->created_at }}</td>
        </tr>
    </table>
</body>
</html>