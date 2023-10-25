@extends('admin.pages.discount_code.index')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Sửa mã giảm giá</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Bảng</a></li>
                                    <li class="breadcrumb-item active">Sửa mã giảm giá</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Sửa mã giảm giá</h4>

                            </div><!-- end card header -->

                            <div class="card-body">
                                <form action="{{ route('post_edit_discount_code',['id'=>$discount_code->id]) }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="customername-field" class="form-label">Tên*</label>
                                            <input type="text" class="form-control" name="name" value="{{$discount_code->name}}"/>

                                        </div>
                                        <div class="col-md-6">
                                            <label for="customername-field" class="form-label">Loại mã*</label>
                                            <select class="form-select" name="id_type_discount_code">
                                                <option value="1" {{$discount_code->id_type_discount_code == 1 ? 'selected' : ''}}>Giảm theo %</option>
                                                <option value="2" {{$discount_code->id_type_discount_code == 2 ? 'selected' : ''}}>Giảm theo tiền<option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="customername-field" class="form-label">Số lượng*</label>
                                            <input type="text" class="form-control" name="quantity" value="{{$discount_code->quantity}}"/>

                                        </div>
                                        <div class="col-md-6">
                                            <label for="customername-field" class="form-label">Gía trị*</label>
                                            <input type="text" class="form-control" name="value" value="{{$discount_code->value}}"/>

                                        </div>
                                        <div class="col-md-6">
                                            <label for="customername-field" class="form-label">Mã*</label>
                                            <input type="text" class="form-control" name="code" value="{{$discount_code->code}}"/>

                                        </div>
                                        <div class="col-md-6">
                                            <label for="customername-field" class="form-label">Ngày bắt đầu*</label>
                                            <input class="form-control" name="start_time" id="start-date"
                                                placeholder="dd/mm/yyy" type="text" value="{{formatEditDateTrip($discount_code->start_time)}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="customername-field" class="form-label">Ngày kết thúc*</label>
                                            <input class="form-control" name="end_time" id="end-date"
                                                placeholder="dd/mm/yyy" type="text" value="{{formatEditDateTrip($discount_code->end_time)}}">
                                        </div>
                                    </div>
                                    <div class="hstack gap-2 justify-content-end">
                                        <a href="{{ route('list_discount_code') }}"><button type="button" class="btn btn-light">Danh
                                                sách</button></a>
                                        <button type="submit" class="btn btn-success">Cập nhật</button>
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
