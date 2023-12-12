@extends('admin.pages.route.index')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Danh sách tuyến đường</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Bảng</a></li>
                                    <li class="breadcrumb-item active">Danh sách tuyến đường</li>
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
                                <h4 class="card-title mb-0">Danh sách tuyến đường</h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <div class="listjs-table" id="customerList">
                                    <div class="row g-4 mb-3">
                                        <div class="col-sm-auto">
                                            <div>
                                                <a href="{{ route('create_route') }}"><button type="button"
                                                        class="btn btn-success add-btn" data-bs-toggle="modal"
                                                        id="create-btn" data-bs-target="#showModal"><i
                                                            class="ri-add-line align-bottom me-1"></i>Thêm mới</button></a>
                                                <button class="btn btn-soft-danger" onClick="deleteMultiples()"><i
                                                        class="ri-delete-bin-2-line"></i></button>
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
                                                    <th class="sort" data-sort="customer_name">ID</th>
                                                    <th class="sort" data-sort="email">Tên</th>
                                                    <th class="sort" data-sort="phone">Điểm bắt đầu</th>
                                                    <th class="sort" data-sort="date">Điểm kết thúc</th>
                                                    <th class="sort" data-sort="status">Giờ bắt đầu</th>
                                                    <th class="sort" data-sort="status">Giá vé</th>
                                                    <th class="sort" data-sort="status">Trạng thái</th>
                                                    <th class="sort" data-sort="action">Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                @foreach ($routes as $route)
                                                    <tr id="row{{ $route->id }}">
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="rowCheckbox" value="{{ $route->id }}">
                                                            </div>
                                                        </th>
                                                        <td class="id" style="display:none;"><a
                                                                href="javascript:void(0);"
                                                                class="fw-medium link-primary">#VZ2101</a></td>
                                                        <td class="customer_name">{{ $route->id }}</td>
                                                        <td class="email">{{ $route->name }} </td>
                                                        <td class="phone">
                                                            @foreach ($locations as $location)
                                                                @if ($route->start_location == $location->id)
                                                                    {{$location->name}}
                                                                @endif
                                                            @endforeach 
                                                            </td>
                                                        <td class="phone">
                                                        @foreach ($locations as $location)
                                                            @if ($route->end_location == $location->id)
                                                                {{$location->name}}
                                                            @endif
                                                        @endforeach 
                                                        </td>
                                                        <td class="date">{{ $route->start_time }}</td>
                                                        <td class="date">{{number_format($route->trip_price, 0, ',', '.')}}đ</td>
                                                        <td class="status">{{ $route->status == 1 ? 'Hoạt động' : 'Không hoạt động' }}</td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <div class="edit">
                                                                    <a href="{{ route('edit_route', ['id' => $route->id]) }}"><button
                                                                            class="btn btn-sm btn-success edit-item-btn"><i class="bx bx-edit"></i></button></a>
                                                                </div>
                                                                <div class="remove">
                                                                    {{-- <a href="{{ route('delete_role', ['id' => $role->id]) }}"
                                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa Vai trò này')"> </a> --}}
                                                                    <button class="btn btn-sm btn-danger btn-remove"
                                                                        {{-- data-bs-toggle="modal" data-bs-target="#modalDelete" data-role-id="{{ $role->id }}" --}}
                                                                        onclick="confirmDelete({{$route->id}})" ><i class="bx bx-trash"></i></button>
                                                                </div>
                                                                <div class="details">
                                                                    <button class="btn btn-sm btn-primary btn-details" onclick="showDetails({{$route->id}})"
                                                                    data-bs-toggle="modal" data-bs-target="#modalRole"
                                                                        data-role-id="{{ $route->id }}"><i class="bx bx bx-show"></i></button>
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
                                                <h5 class="mt-2">Xin lỗi! Không tìm thấy kết quả!</h5>
                                                <p class="text-muted mb-0">Chúng tôi không tìm thấy bất kỳ kết quả nào giống
                                                    với bạn tìm kiếm.</p>
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
                                    {{-- <div class="aiz-pagination">
                                        {{ $roles->appends(request()->input())->links() }}
                                    </div> --}}
                                </div>
                            </div><!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

                {{-- <div id="roleModal" class="rolemodal">
                    <h1>Thông tin chi tiết vai trò: <b id="modal_title"></b></h1>
                    <p></p>
                    <span>Vai trò:<span id="modal_role"></span></span>
                    <span class="pb-4">Các quyền: <span id="modal_permission"></span></span>
                    <button class="close">Đóng</button>
                </div> --}}
                <div class="modal fade" id="modalRole" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Thông tin tuyến đường</h4>
                                <p type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">X</p>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <p>Tên tuyến : <label id="name_detail"></label></p>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Điểm bắt đầu : <label id="start_location_detail"></label></p>
                                        <p>Giờ đi : <label id="start_time_detail"></label></p>
                                        <p>Giá vé : <label id="price_detail"></label></p>
                                        <p>Các tài xế: <label id="driver_detail"></label></p>
                                        <p>Các Xe: <label id="car_detail"></label></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Điểm kết thúc : <label id="end_location_detail"></label></p>
                                        <p>Thời gian đi : <label id="interval_detail"></label></p>
                                        <p>Trạng thái : <label id="status_detail"></label></p>
                                        <p>Các phụ xe : <label id="assistant_detail"></label></p>
            
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Đóng</button>
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
                <!--end modal -->

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

    </div>
@endsection
