@extends('errors::illustrated-layout')

@section('code', '429')
@section('title', __('Too Many Requests'))

<style>
	.back_image{
		background-image: url({{ asset('/svg/403.svg') }});
	}
</style>

@section('image')
    <div class="back_image absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message', __('Sorry, you are making too many requests to our servers.'))
