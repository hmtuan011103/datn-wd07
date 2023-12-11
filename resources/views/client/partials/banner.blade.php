@php
    $banners = \App\Models\Banner::query()->where('status',1)->get();
@endphp
<div class="container position-relative" style="top: -80px;">
    <div class="banner-index d-flex position-relative align-items-center rounded-4" id="banner-to-home">
        @foreach($banners as $banner)
            <div>
                <img src="{{ asset($banner->image) }}" alt="" class="w-100 rounded-4 d-block">
            </div>
        @endforeach
    </div>
    @if(!$banners)
        <div>
            <img src="{{ asset('client/assets/images/banner_index.png') }}" alt="" class="w-100 rounded-4 d-block">
        </div>
    @endif
</div>
