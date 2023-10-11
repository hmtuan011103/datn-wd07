@extends('admin.pages.typecar.index')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Loại Xe</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Bảng</a></li>
                                    <li class="breadcrumb-item active">Loại Xe</li>
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
                                <h4 class="card-title mb-0">Thêm Mới Loại Xe</h4>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <form class="tablelist-form" autocomplete="off" action="{{route('store_typecar')}}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="customername-field" class="form-label">Loại Xe</label>
                                            <input type="text" name="name" id="customername-field" class="form-control" placeholder="Enter Name Permission"  />
                                            {{--                            <div class="invalid-feedback">Please enter a customer name.</div>--}}
                                        </div>

                                        <div class="mb-3">
                                            <label for="customername-field" class="form-label">Mô Tả</label>
                                            <input type="text" name="description" id="email-field" class="form-control" placeholder="Enter Description"  />
                                            {{--                            <div class="invalid-feedback">Please enter an email.</div>--}}
                                        </div>
                                        <div class="mb-3">
                                            <label for="total_seat" class="form-label">Số Lượng Ghế</label>
                                            <input type="text" name="total_seat" id="total_seat" class="form-control" placeholder="Enter Total_seat"  />
                                            {{--                            <div class="invalid-feedback">Please enter a Total_seat name.</div>--}}
                                        </div>
                                        <div class="modal-footer">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="button" class="btn btn-light"><a href="{{route('index_typecar')}}">Danh Sách</a></button>
                                                <button type="submit" class="btn btn-success" id="add-btn">Thêm Mới </button>
                                                <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end col -->
                </div>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>document.write(new Date().getFullYear())</script> © Velzon.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Design & Develop by Themesbrand
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection
@section('script')
    @include('admin.pages.typecar.script')
@endsection
