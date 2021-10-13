@extends('errors::illustrated-layout')

@section('code', '403')
@section('title', __('Forbidden'))

<style>
	.back_image{
		background-image: url({{ asset('/svg/403.svg') }});
	}
</style>

@section('image')
    <div class="back_image absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message', __($exception->getMessage() ?: 'Sorry, you are forbidden from accessing this page.'))
