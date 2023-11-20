@extends('admin.pages.trip.index')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-trips-center justify-content-between">
                            <h4 class="mb-sm-0">Danh sách chuyến đi</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="listjs-table" id="customerList">
                                    <div class="row g-4 mb-3">
                                        <div class="col-sm-auto">
                                            <div>
                                                <a href="{{ route('form_create_trip') }}"><button type="button"
                                                        class="btn btn-success add-btn" data-bs-toggle="modal"
                                                        id="create-btn" data-bs-target="#showModal"><i
                                                            class="ri-add-line align-bottom me-1"></i> Thêm</button></a>
                                                <button class="btn btn-soft-danger" onClick="deleteMultiples()"><i
                                                        class="ri-delete-bin-2-line"></i></button>
                                            </div>
                                        </div>
                                        {{-- import data trip  --}}
                                        <div class="col-sm-auto">
                                            <div>
                                                <button class="btn btn-primary submit-data-trip" data-bs-toggle="modal"
                                                    data-bs-target="#modalImportTrip">Nhập dữ liệu</button>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="d-flex justify-content-sm-end">
                                                <div class="search-box ms-2">
                                                    <input type="text" class="form-control search"
                                                        placeholder="Tìm kiếm...">
                                                    <i class="ri-search-line search-icon"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter-container">
                                        <div class="filter-group-inline">
                                            <label for="departure-date">Ngày đi:</label>
                                            <input type="date" id="departure-date">
                                        </div>

                                        <div class="filter-group-inline">
                                            <label for="driver">Tài xế:</label>
                                            <select id="driver">
                                                <option value="">-- Chọn tài xế --</option>
                                            </select>
                                        </div>

                                        <div class="filter-group-inline">
                                            <label for="assistant">Phụ xe:</label>
                                            <select id="assistant">
                                                <option value="">-- Chọn phụ xe --</option>
                                            </select>
                                        </div>

                                        <div class="filter-group-inline">
                                            <label for="destination">Điểm đi:</label>
                                            <select id="depature_point">
                                                <option value="">-- Chọn địa điểm--</option>
                                            </select>
                                        </div>
                                        <div class="filter-group-inline">
                                            <label for="destination">Điểm đến:</label>
                                            <select id="destination">
                                                <option value="">-- Chọn địa điểm--</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="table-responsive table-card mt-3 mb-1">
                                        <table class="table align-middle table-nowrap" id="customerTable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col" style="width: 50px;">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="checkAll"
                                                                value="option">
                                                        </div>
                                                    </th>
                                                    <th class="sort" data-sort="customer_name">Điểm bắt đầu</th>
                                                    <th class="sort" data-sort="email">Điểm kết thúc</th>
                                                    <th class="sort" data-sort="phone">Ngày đi</th>
                                                    <th class="sort" data-sort="date">Giờ đi</th>
                                                    <th class="sort" data-sort="status">Giá vé</th>
                                                    <th class="sort" data-sort="action">Chức năng</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all resultFilter">
                                            </tbody>
                                        </table>
                                        <div class="noresult" style="display: none">
                                            <div class="text-center">
                                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                    colors="primary:#121331,secondary:#08a88a"
                                                    style="width:75px;height:75px">
                                                </lord-icon>
                                                <h5 class="mt-2">Xin lỗi! Không có kết quả nào</h5>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <div class="pagination-wrap hstack gap-2">
                                            <a class="page-trip pagination-prev disabled" href="javascript:void(0);">
                                                Trước
                                            </a>
                                            <ul class="pagination listjs-pagination mb-0"></ul>
                                            <a class="page-trip pagination-next" href="javascript:void(0);">
                                                Tiếp
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->


    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                            colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Xác nhận xóa ?</h4>
                            <span id="role-id" hidden></span>
                            <p class="text-muted mx-4 mb-0">Bạn có chắc chắn muốn xóa chuyến đi này ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Đóng</button>
                        <button type="button" class="btn w-sm btn-danger " id="delete-record">Xóa</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end modal -->

    <div class="modal fade" id="modalImportTrip" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="btn-close"></button>
                </div>
                <form action="{{ route('import-trip') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mt-2 text-center">
                            <h5>Nhập dữ liệu chuyến đi từ Excel</h5>
                            <lord-icon src="https://cdn.lordicon.com/muxyivho.json" trigger="loop"
                                colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px">
                            </lord-icon><br>
                            <label for="file" class="btn btn-success"><i class="fa-solid fa-file-arrow-up"></i> Chọn
                                file excel</label>
                            <input type="file" id="file" class="inputfile" name="file-trip-excel"
                                accept=".xlsx">
                        </div>
                        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                            <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal"><i
                                    class="fa-solid fa-xmark"></i> Đóng</button>
                            <button class="btn btn-primary submit-data-trip" type="submit" name="import-trip"><i
                                    class="fa-solid fa-check"></i> Xác nhận</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>
    <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    @include('admin.pages.trip.detail')


    </div>
@endsection
