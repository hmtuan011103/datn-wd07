@extends('admin.pages.banner.index')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Danh sách banner</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Bảng</a></li>
                                    <li class="breadcrumb-item active">Danh sách banner</li>
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
                                <h4 class="card-title mb-0">Danh sách banner</h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <div class="listjs-table" id="customerList">
                                    <div class="row g-4 mb-3">
                                        <div class="col-sm-auto">
                                            <div>
                                                <a href="{{ route('create_banner') }}"><button type="button"
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
                                                    <th class="sort" data-sort="email">Banner</th>
                                                    <th class="sort" data-sort="phone">Trạng thái</th>
                                                    <th class="sort" data-sort="date">Ngày tạo</th>
                                                    <th class="sort" data-sort="status">Ngày cập nhật</th>
                                                    <th class="sort" data-sort="action">Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                @foreach ($banners as $banner)
                                                    <tr id="row{{ $banner->id }}">
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="rowCheckbox" value="{{ $banner->id }}">
                                                            </div>
                                                        </th>
                                                        <td class="id" style="display:none;"><a
                                                                href="javascript:void(0);"
                                                                class="fw-medium link-primary">#VZ2101</a></td>
                                                        <td class="customer_name">{{ $banner->id }}</td>
                                                        <td class="email"><img src="{{ asset( $banner->image ) }}" alt="" width="200px"> </td>
                                                        <td>
                                                            <label class="form-check form-switch">
                                                                <input class="form-check-input fs-3" name="status" type="checkbox" role="switch" value="{{ $banner->status }}"
                                                                    @if ($banner->status == 1) checked @endif
                                                                    onchange="event.preventDefault(); document.getElementById('update-status-form-{{ $banner->id }}').submit();">
                                                                <span></span>
                                                            </label>
                                                            <form id="update-status-form-{{ $banner->id }}" action="{{route('update_status_banner',['id' => $banner->id])}}" method="POST" style="display: none;">
                                                                @csrf
                                                                @method('POST')
                                                                <input type="hidden" name="status" value="{{ $banner->status == 1 ? 0 : 1 }}">
                                                            </form>
                                                        </td>
                                                        <td class="date">{{ helperFormatTime($banner->created_at) }}</td>
                                                        <td class="status">{{ helperFormatTime($banner->updated_at) }}</td>

                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <div class="edit">
                                                                    <a href="{{ route('edit_banner', ['id' => $banner->id]) }}"><button
                                                                            class="btn btn-sm btn-success edit-item-btn"><i class="bx bx-edit"></i></button></a>
                                                                </div>
                                                                <div class="remove">
                                                                    <button class="btn btn-sm btn-danger btn-remove"
                                                                        onclick="confirmDelete({{$banner->id}})" ><i class="bx bx-trash"></i></button>
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
                                        {{ $banners->appends(request()->input())->links() }}
                                    </div> --}}
                                </div>
                            </div><!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

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
                                        <span id="banner-id" hidden></span>
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
