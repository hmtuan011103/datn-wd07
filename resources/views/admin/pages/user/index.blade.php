@extends('admin.layout.main')

@section('style')
    @include('admin.pages.user.style')
@endsection

@section('content')
    @if (isset($pageViewInfo))
        @include($pageViewInfo)
    @else
        @include('admin.pages.user.main')
    @endif
@endsection

@section('script')
    @include('admin.pages.user.script')
@endsection
