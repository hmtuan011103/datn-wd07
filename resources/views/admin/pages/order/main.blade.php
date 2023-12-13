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
                                            {{-- <div class="d-flex justify-content-sm-end">
                                                <div class="search-box ms-2">
                                                    <input type="text" class="form-control search"
                                                        placeholder="Search...">
                                                    <i class="ri-search-line search-icon"></i>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="filter-container pt-3 pb-3">
                                        <div class="filter-group-inline">
                                            <input class="form-control" id="code_bill" type="text" placeholder="Nhập mã hóa đơn">
                                        </div>
                                        <div class="filter-group-inline">
                                            <input class="form-control" id="user_phone" type="text" placeholder="Nhập số điện thoại người mua">
                                        </div>
                                        <div class="filter-group-inline">
                                            <select class="form-control" id="route" >
                                                <option value="">-- Chọn tuyến đường --</option>
                                                @foreach ($routes as $route)
                                                    <option value="{{ strtolower($route->name) }}">{{ $route->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="filter-group-inline">
                                            <select class="form-control" id="type_pay">
                                                <option value="">-- Loại thanh toán --</option>
                                                <option value="VNPAY">VNPAY</option>
                                                <option value="MOMOPAY">MOMOPAY</option>
                                                <option value="Tại quầy">Tại quầy</option>
                                            </select>
                                        </div>

                                        <div class="filter-group-inline">
                                            <select class="form-control" id="status_pay">
                                                <option value="">-- Trạng thái thanh toán --</option>
                                                <option value="Đã thanh toán">Đã thanh toán</option>
                                                <option value="Chưa thanh toán">Chưa thanh toán</option>
                                            </select>
                                        </div>
                                        {{-- <div class="filter-group-inline">
                                            <select class="form-control" id="date">
                                                <option value="">-- Ngày mua --</option>
                                                <option value="{{ strtolower($carTypeName) }}">Hôm nay</option>
                                                <option value="{{ strtolower($carTypeName) }}">Hôm qua</option>
                                                <option value="{{ strtolower($carTypeName) }}">Tuần này</option>
                                                <option value="{{ strtolower($carTypeName) }}">Tháng này</option>
                                                <option value="{{ strtolower($carTypeName) }}">Hôm nay</option>
                                            </select>
                                        </div> --}}

                                    </div>
                                    <div class="table-responsive table-card mt-3 mb-1">
                                        <table class="table align-middle table-nowrap" id="customerTable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th >Mã hóa đơn</th>
                                                    <th >Chuyến</th>
                                                    <th >Người mua</th>
                                                    <th >Số điện thoại</th>
                                                    <th >Giá trị hóa đơn</th>
                                                    <th >Loại thanh toán</th>
                                                    <th >Trạng thái</th>
                                                    <th >Ngày tạo</th>
                                                    <th >Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">

                                                @foreach ($data as $item)
                                                    <tr id="row{{ $item->id }}" class="bill-row">
                                                        <td >{{ $item->code_bill }}</td>
                                                        <td class="trip_id">{{ $item->trip->route->name }}</td>
                                                        <td class="trip_id">{{ $item->user_name }}</td>
                                                        <td class="trip_id">{{ $item->user_phone }}</td>
                                                        <td class="trip_id">
                                                            {{ number_format($item->total_money_after_discount, 0, ',', '.') }}đ
                                                        </td>
                                                        <td class="trip_id">{{ $item->type_pay === 1 ? 'VNPAY' : ( $item->type_pay === 2 ? "MOMOPAY" : "Tại quầy" ) }}</td>
                                                        <td class="trip_id">{{ $item->status_pay === 1 ? 'Đã thanh toán' : 'Chưa thanh toán' }}</td>
                                                        <td class="trip_id">{{ helperFormatTime($item->created_at) }}</td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <div class="printf">
                                                                    <a href="{{ route('export_order', ['id' => $item->id]) }}"
                                                                        class="btn btn-info btn-sm edit-item-btn"><i
                                                                            class="fa-solid fa-print"></i></a>
                                                                </div>
                                                                <div class="detail">
                                                                    {{-- <button class="btn btn-sm btn-primary btn-details" onclick="showDetails({{$item->id}})"
                                                                        data-bs-toggle="modal" data-bs-target="#show"
                                                                            data-item-id="{{ $item->id }}"><i class="bx bx bx-show"></i></button> --}}
                                                                    <button
                                                                        data-url="{{ route('details_order', ['id' => $item->id]) }}"
                                                                        class="btn btn-primary btn-sm edit-item-btn btn-show"
                                                                        data-bs-target="#show" data-bs-toggle="modal">
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
    @include('admin.pages.order.detail')
@endsection
