@extends('client.layout.main')

@section('style')
    @include('client.pages.select-seat.style')
@endsection

@section('content')
    @include('client.pages.select-seat.main')
@endsection

@section('script')
    @include('client.pages.select-seat.script')
@endsection

