@php 
$homepage = Modules\Pages\Entities\InfixHomePage::where('active_status', 1)->first();
@endphp 

<div class="banner-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 offset-xl-2">
                    <div class="banner-info text-center">
                        <h2>{{@$homepage->homepage_title}}</h2>
                        {{-- <p>{{@$homepage->homepage_description}}</p> --}}
                        <h4>{{@$homepage->homepage_description}}</h4>
                    </div>
                    <div class="row">
                        <div class="col-xl-10 offset-xl-1 col-lg-10 offset-lg-1">
                            <div class="search-field">
                                <div class="search-field-inner">
                                    <form class="search-relative" action="{{ route('_by_search')}}" method="POST">
                                        @csrf
                                        <input type="text" placeholder="@lang('lang.search_your_product')" onkeyup="SearchItem(this.value)" name="key">  {{-- filter.js --}}
                                        <button type="submit"> <i class="ti-search"></i> </button>
                                    </form>
                                </div>
                            </div>
                            <div class="list-group" id="livesearch"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>