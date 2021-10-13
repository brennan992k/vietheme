@extends('errors::illustrated-layout')

@section('code', '503')
@section('title', __('Service Unavailable'))

<style>
	.back_image{
		background-image: url({{ asset('/svg/503.svg') }});
	}
</style>
@section('image')
    <div class="back_image absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message', __($exception->getMessage() ?: 'Sorry, we are doing some maintenance. Please check back soon.'))
