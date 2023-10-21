@extends('admin.layout.main')

@section('style')
    @include('admin.pages.auth.style')
@endsection

@section('content')
    @if (isset($pageViewInfo))
        @include($pageViewInfo)
    @else
        @include('admin.pages.auth.login')
    @endif
@endsection

@section('script')
    @include('admin.pages.auth.script')
@endsection
