@extends('admin.pages.order-ticket.index')
@section('style')
    @include('admin.pages.order-ticket.style-second')
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            @include('admin.pages.order-ticket.form-search')
        </div>
    </div>
@endsection
@section('script')
    @include('admin.pages.order-ticket.script-second')
@endsection
