@extends('admin.pages.order.index')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Danh sách hóa đơn</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Hóa Đơn</a></li>
                                    <li class="breadcrumb-item active">Danh sách</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="listjs-table" id="customerList">
                                    <div class="row g-4 mb-3">
                                        <div class="col-sm">
                                            <div class="d-flex justify-content-sm-end">
                                                <div class="search-box ms-2">
                                                    <input type="text" class="form-control search"
                                                           placeholder="Search...">
                                                    <i class="ri-search-line search-icon"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive table-card mt-3 mb-1">
                                        <table class="table align-middle table-nowrap" id="customerTable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="sort" data-sort="code_bill">Mã hóa đơn</th>
                                                    <th class="sort" data-sort="trip_id">Chuyến</th>
                                                    <th class="sort" data-sort="phone">Giá trị hóa đơn</th>
                                                    <th class="sort" data-sort="phone">Loại thanh toán</th>
                                                    <th class="sort" data-sort="phone">Trạng thái</th>
                                                    <th class="sort" data-sort="action">Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                @foreach ($data as $item)
                                                    <tr id="row{{ $item->id }}">
                                                        <td class="code_bill">{{ $item->code_bill }}</td>
                                                        <td class="trip_id">{{ $item->trip->start_location }} - {{ $item->trip->end_location }}</td>
                                                        <td class="trip_id">{{ number_format($item->total_money_after_discount, 0, ',', '.') }}đ</td>
                                                        <td class="trip_id">{{ $item->type_pay === 1 ? "VNPAY" : "" }}</td>
                                                        <td class="trip_id">{{ $item->status_pay === 1 ? "Đã thanh toán" : "" }}</td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <div class="printf">
                                                                    <a href="{{ route('edit_permission', ['id' => $item->id]) }}"
                                                                       class="btn btn-info btn-sm edit-item-btn"><i class="fa-solid fa-print"></i></a>
                                                                </div>
                                                                <div class="detail">
                                                                    <button data-url="" class="btn btn-primary btn-sm edit-item-btn btn-show" data-target="#show" data-toggle="modal">
                                                                        <i class="bx bx bx-show"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="noresult" style="display: none">
                                            <div class="text-center">
                                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                           colors="primary:#121331,secondary:#08a88a"
                                                           style="width:75px;height:75px">
                                                </lord-icon>
                                                <h5 class="mt-2">Không tìm thấy</h5>
                                                <p class="text-muted mb-0">Hiện tại không có kết quả tìm kiếm nào phù hợp
                                                    với yêu cầu của bạn.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <div class="pagination-wrap hstack gap-2">
                                            <a class="page-item pagination-prev disabled" href="javascript:void(0);">
                                                Trước
                                            </a>
                                            <ul class="pagination listjs-pagination mb-0"></ul>
                                            <a class="page-item pagination-next" href="javascript:void(0);">
                                                Sau
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                        id="btn-close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mt-2 text-center">
                                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                               colors="primary:#f7b84b,secondary:#f06548"
                                               style="width:100px;height:100px"></lord-icon>
                                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                        <h4>Xác nhận xóa ?</h4>
                                        <span id="role-id" hidden></span>
                                        <p class="text-muted mx-4 mb-0">Bạn có chắc chắn muốn xóa vai trò này ?</p>
                                    </div>
                                </div>
                                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                    <button type="button" class="btn w-sm btn-light"
                                            data-bs-dismiss="modal">Đóng</button>
                                    <button type="button" class="btn w-sm btn-danger " id="delete-record">Xóa</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © Chiến Thắng Bus.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Công ty TNHH Chiến Thắng
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection
