<!DOCTYPE html>
<html>
<head>
	<title>{{ $item_details->title }} @lang('lang.license')</title>
</head>
<style>
    .ft{
        font-weight: bold;
    }
    .pl{
        padding-left:100px
    }
    .title_style{
        font-weight: bold; 
        font-size:3em;
    }
    .mw{
        max-width:123px;
    }
</style>
<body>
    @php
        $logo_conditions = ['title'=>'Logo', 'active_status'=>1];
        $logo = dashboard_background($logo_conditions);
    @endphp
 
    <img src="{{ @$logo ? asset(@$logo->image) : asset('public/frontend/img/Logo.png') }}" alt="">
    <h2 class="title_style">@lang('lang.license_certificate')</h2>
    <p></p>
    <table class="pl">
        <tr>
            <td class="ft">@lang('lang.licensors_author_username'):</td>
            <td>{{ $author_details->username }}</td>
        </tr>
        <tr>
            <td class="ft">@lang('lang.license'):</td>
            <td>{{ $user_details->username }}</td>
        </tr>
        <tr>
            <td class="ft">@lang('lang.item_title'):</td>
            <td>{{ $item_details->title }}</td>
        </tr>
        <tr>
            <td class="ft">@lang('lang.item_URL'):</td>
            <td>{{ route('singleProduct',[str_replace(' ','-',$item_details->title),$item_details->id]) }}</td>
        </tr>
         <tr>
            <td class="ft">@lang('lang.item_ID'):</td>
            <td>{{ $item_details->id }}</td>
        </tr>
         <tr>
            <td class="ft">@lang('lang.item_purchase_code'):</td>
            <td>@lang('lang.free')</td>
        </tr>
    </table>
</body>
</html>