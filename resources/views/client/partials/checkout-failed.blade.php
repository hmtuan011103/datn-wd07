@extends('client.layout.main')
@section('style')
    <link rel="stylesheet" href="{{ asset('client/assets/css/checkout.css') }}">
@endsection
@section('content')
    <div class="py-4 text-center">
        <div>
            <i class="fa-solid fa-circle-xmark" style="font-size: 64px; color: #8BE2D3;"></i>
        </div>
        <p class="fs-4 mb-1" style="color: #3C7054;">Mua vé xe thất bại</p>
        <p class="fs-6">Có một số lỗi xảy ra trong quá trình thanh toán! Vui lòng thử lại</p>
        <div class="row justify-content-center px-3">
            <div class="col-lg-3 col-md-6 col-xs-12 text-center">
                <a href="{{ route('trang_chu') }}" class="btn w-100 fw-medium button-important text-decoration-none d-flex justify-content-center">
                    <div>
                        <i class="fa-solid fa-house"></i>
                    </div>
                    <div class="ps-2">
                        Trang chủ
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
