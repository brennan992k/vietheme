@extends('errors::illustrated-layout')

@section('code', '419')
@section('title', __('Page Expired'))

<style>
	.back_image{
		background-image: url({{ asset('/svg/403.svg') }});
	}
</style>

@section('image')
    <div class="back_image absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message', __('Sorry, your session has expired. Please refresh and try again.'))
