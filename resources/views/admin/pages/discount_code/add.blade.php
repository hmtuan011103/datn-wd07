@extends('admin.pages.discount_code.index')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Thêm mã giảm giá</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Bảng</a></li>
                                    <li class="breadcrumb-item active">Thêm mã giảm giá</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Thêm mã giảm giá</h4>

                            </div><!-- end card header -->

                            <div class="card-body">
                                <form action="{{ route('post_create_discount_code') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="customername-field" class="form-label mb-3 mt-3">Tên*</label>
                                            <input type="text" class="form-control" name="name" />

                                        </div>
                                        <div class="col-md-6">
                                            <label for="customername-field" class="form-label mb-3 mt-3">Loại mã*</label>
                                            <select class="form-select" name="id_type_discount_code">
                                                <option value="1">Giảm theo %</option>
                                                <option value="2">Giảm theo tiền</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="customername-field" class="form-label mb-3 mt-3">Số lượng*</label>
                                            <input type="number" class="form-control" name="quantity" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="customername-field" class="form-label mb-3 mt-3">Gía trị*</label>
                                            <input type="number" class="form-control" name="value" />
                                            @error('value')
                                                <div class="ps-4 pb-3 fw-bold text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="customername-field" class="form-label mb-3 mt-3">Mã*</label>
                                            <input type="text" class="form-control" name="code" />

                                        </div>
                                        <div class="col-md-6">
                                            <label for="customername-field" class="form-label mb-3 mt-3">Ngày bắt đầu*</label>
                                            <input class="form-control" name="start_time" id="start-date"
                                                placeholder="dd/mm/yyy" type="text">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="customername-field" class="form-label mb-3 mt-3">Ngày kết thúc*</label>
                                            <input class="form-control" name="end_time" id="end-date"
                                                placeholder="dd/mm/yyy" type="text">
                                        </div>
                                    </div>
                                    <div class="hstack gap-2 justify-content-end">
                                        <a href="{{ route('list_discount_code') }}"><button type="button" class="btn btn-light">Danh
                                                sách</button></a>
                                        <button type="submit" class="btn btn-success">Thêm mới</button>
                                        <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                    </div>

                                </form>
                            </div><!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

    </div>
@endsection
