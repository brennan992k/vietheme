@extends('errors::illustrated-layout')

@section('code', '401')
@section('title', __('Unauthorized'))

<style>
	.back_image{
		background-image: url({{ asset('/svg/403.svg') }});
	}
</style>


@section('image')
    <div class="back_image absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message', __('Sorry, you are not authorized to access this page.'))
