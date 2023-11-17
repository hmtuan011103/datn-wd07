@extends('admin.pages.car.index')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Danh Sách Xe</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Bảng</a></li>
                                <li class="breadcrumb-item active">Xe</li>
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
                            <h4 class="card-title mb-0">Danh Sách Xe</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div class="col-sm-auto">
                                            <div>
                                                <a href="{{route('create_car')}}"><button type="button" class="btn btn-success add-btn"  a><i class="ri-add-line align-bottom me-1"></i> Thêm Mới</button></a>
                                                <button class="btn btn-soft-danger" onClick="deleteMultiples()"><i class="ri-delete-bin-2-line"></i></button>
                                            </div>
                                        </div>
                                    </div>
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
                                <div class="filter-container">
                                    <div class="filter-group-inline">
                                        <label for="carType">Loại Xe</label>
                                        <select id="carType" onchange="filterTable()">
                                            <option value="">-- Chọn Loại Xe --</option>
                                            @foreach ($carTypeNames as $carTypeName)
                                                <option value="{{ strtolower($carTypeName) }}">{{ $carTypeName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="filter-group-inline">
                                        <label for="carStatus">Trạng Thái</label>
                                        <select id="carStatus" onchange="filterTable()">
                                            <option value="">-- Chọn Trạng Thái --</option>
                                            @foreach ($carStatuses as $status)
                                                <option value="{{ $status }}">
                                                    @if ($status == '0')
                                                        Xe Đang Hoạt Động
                                                    @elseif ($status == '1')
                                                        Xe Đã Ngừng Hoạt Động
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

{{--                                    <div class="filter-group-inline">--}}
{{--                                        <label for="carColor">Màu Xe</label>--}}
{{--                                        <div class="custom-dropdown">--}}
{{--                                            <span class="selected-color"></span>--}}
{{--                                            <select id="carColor">--}}
{{--                                                <option value="">-- Chọn Màu Xe --</option>--}}
{{--                                                @foreach ($carColors as $color)--}}
{{--                                                    <option value="{{ $color }}" style="background-color: {{ $color }}">--}}
{{--                                                        {{ $color }}--}}
{{--                                                    </option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>

                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="customerTable">
                                        <thead class="table-light">
                                        <tr>
                                            <th scope="col" style="width: 50px;">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                                </div>
                                            </th>
                                            <th data-sort="customer_name">Ảnh</th>
                                            <th data-sort="customer_name">Tên Xe</th>
                                            <th data-sort="customer_name">Loại Xe</th>
                                            <th data-sort="customer_name">Trạng Thái</th>
                                            <th data-sort="customer_name">Màu Xe</th>
                                            <th data-sort="customer_name">Biển Số Xe</th>
                                            <th data-sort="action">Chức Năng</th>

                                        </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                        @foreach($data as $item)
                                            <tr class="car-row" data-car-type="{{ strtolower($item->typecar_name) }}">
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="rowCheckbox" value="{{$item->id}}">
                                                    </div>
                                                </th>
                                                <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#VZ2101</a></td>
                                                <td class="customer_name" style="width: 110px"><img src="{{ asset($item->image) }}" alt="" style="width: 100%"></td>
                                                <td class="customer_name">{{$item->name}}</td>
                                                <td class="customer_name">{{$item->typecar_name}}</td>
                                                <td class="customer_name">
                                                    @if ($item->status == 0)
                                                         Xe Đang Hoạt Động
                                                    @elseif ($item->status == 1)
                                                         Xe Đã Ngừng Hoạt Động
                                                    @endif
                                                </td>
                                                <td class="customer_name" >
                                                    <p style="border: 1px solid {{$item->color}};width: 40px;height: 20px; background-color: {{$item->color}};margin-top: 20px">
                                                    </p>
                                                </td>
                                                <td class="customer_name">{{$item->license_plate}}</td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <div >
                                                            <button type="button" class="btn btn-sm btn-secondary"
                                                                    data-bs-toggle="modal" id="create-btn"
                                                                    data-bs-target="#modal{{$item->id}}">
                                                                <i class="bx bx bx-show"></i>
                                                            </button>
                                                        </div>
                                                        <div class="edit">
                                                            <a href="{{route('edit_car',['id'=>$item->id])}}"
                                                               class="btn btn-success btn-sm edit-item-btn" >
                                                                <i class="bx bx-edit"></i>
                                                            </a>
                                                        </div>
                                                        <div class="remove">
                                                            <button class="btn btn-sm btn-danger btn-remove"
                                                                    data-bs-toggle="modal" data-bs-target="#modalDelete"
                                                                    data-role-id="{{ $item->id }}"><i
                                                                    class="bx bx-trash"></i></button>
                                                        </div>
                                                    </div>
                                                <td>

                                            </tr>
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
                                                                    <p class="text-muted mx-4 mb-0">Bạn có chắc chắn muốn xóa loại xe này ?</p>
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
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="noresult" style="display: none">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json"
                                                       trigger="loop" colors="primary:#121331,secondary:#08a88a"
                                                       style="width:75px;height:75px">
                                            </lord-icon>
                                            <h5 class="mt-2">Không có bản ghi nào</h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">
                                        <a class="page-item pagination-prev disabled"
                                           href="javascript:void(0);">
                                            Trước
                                        </a>
                                        <ul class="pagination listjs-pagination mb-0"></ul>
                                        <a class="page-item pagination-next" href="javascript:void(0);">
                                            Sau
                                        </a>
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
            @foreach($data as $item)
            <div class="modal fade" id="modal{{$item->id}}" tabindex="-1"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-light p-3">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    id="close-modal"></button>
                        </div>
                        <div class="boldbold">
                            Danh Sách Ghế Ngồi Của Xe
                        </div>
                        <div class="seating-chart">
                            <div class="row mx-auto">
                                @if($item->typecar_total_seat > 0)
                                    <div class="col">
                                        @if ($item->typecar_total_seat > 24)
                                            <div class="custom-style">Tầng 1</div>
                                        @endif

                                        <div class="row row1">
                                            @foreach ($item->seats as $index => $pe)
                                            @if ($index < 24)
                                                <div class="col-6 ">
                                                    {{ $pe->code_seat }}
                                                </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                          @if($item->typecar_total_seat >24)
                                        <div class="col">
                                            <div class="custom-style">Tầng 2</div>
                                            <div class="row">
                                                @foreach ($item->seats as $index => $pe)
                                                @if ($index > 23 )
                                                    <div class="col-6">
                                                        {{ $pe->code_seat }}
                                                    </div>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                          @endif
                            </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
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

