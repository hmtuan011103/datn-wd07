@extends('admin.pages.select-checkout-seat-admin.index')
@section('style')
    @include('admin.pages.select-checkout-seat-admin.style')
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            @include('admin.pages.select-checkout-seat-admin.detail-select-seat')
            @include('admin.pages.select-checkout-seat-admin.select-seat-info')
            @include('admin.pages.select-checkout-seat-admin.info-book-ticket')
        </div>
    </div>
@endsection
@section('script')
    @include('admin.pages.select-checkout-seat-admin.script')
@endsection


