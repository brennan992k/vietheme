@extends('frontend.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('public/frontend/') }}/content.css">
  
@endpush
@section('content')
<input type="text" hidden  class="id" value="{{ Auth::user()->id}}">
<input type="text" hidden  class="url" value="{{url('/') }}">
    <!-- banner-area start -->
        <div class="banner-area4">
            <div class="banner-area-inner">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-xl-6">
                            <div class="banner-info knowledge_title">
                                <h2>@lang('lang.upload_item')</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- banner-area end -->
    
        <!-- upload_area _start -->
        <div class="upload_area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 offset-xl-1">
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="upload_side_bar gray-bg">
                                    <form action="{{ route('author.contentSelect')}}" method="POST" id="select_content">
                                            @csrf
                                    <div class="upload_inner">
                                        <h3>@lang('lang.select_switch_ategories')</h3>
                                        <select class="wide" id="select_category" name="category">
                                            <option data-display="Select Category">@lang('lang.select_category')</option>
                                            @foreach ($category as $item)
                                            <option value="{{ @$item->id }}">{{ @$item->title }}</option>
                                            @endforeach
                                        </select>
                                        <button class="boxed-btn" type="submit">@lang('lang.select_category')</button>
                                        <a href="#" class="help">@lang('lang.help')</a>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-xl-8">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@push('js')
<script src="{{ asset('public/frontend/js/') }}/file_upload.js"></script>
@endpush