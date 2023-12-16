@extends('admin.layout.main')

@section('style')
    @include('admin.pages.statistic.style')
@endsection

{{-- @section('content')
    @if (isset($pageViewInfo))
        @include($pageViewInfo)
    @else
        @include('admin.pages.statistic.main')
    @endif
@endsection --}}

@section('script')
    @include('admin.pages.statistic.script')

@endsection
