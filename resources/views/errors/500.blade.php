@extends('errors::illustrated-layout')

@section('code', '500')
@section('title', __('Error'))

<style>
	.back_image{
		background-image: url({{ asset('/svg/500.svg') }});
	}
</style>

@section('image')
    <div class="back_image absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message', __('Whoops, something went wrong on our servers.'))
