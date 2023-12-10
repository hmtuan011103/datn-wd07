@extends('admin.pages.select-checkout-type-info.index')
@section('style')
    @include('admin.pages.select-checkout-type-info.style')
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            @include('admin.pages.select-checkout-type-info.choose-type-payment')
        </div>
    </div>
@endsection
@section('script')
    @include('admin.pages.select-checkout-type-info.script')
@endsection
