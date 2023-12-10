@extends('admin.pages.order-ticket.index')
@section('style')
    @include('admin.pages.order-ticket.style')
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            @include('admin.pages.order-ticket.form-search')
            @include('admin.pages.order-ticket.filter-search')
            @include('admin.pages.order-ticket.show-filter-search')
        </div>
    </div>
@endsection
@section('script')
    @include('admin.pages.order-ticket.script')
@endsection
