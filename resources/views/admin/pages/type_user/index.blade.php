@extends('admin.layout.main')

@section('style')
    @include('admin.pages.type_user.style')
@endsection

@section('content')
    @if (isset($pageViewInfo))
        @include($pageViewInfo)
    @else
        @include('admin.pages.type_user.main')
    @endif
@endsection

@section('script')
    @include('admin.pages.type_user.script')
@endsection
