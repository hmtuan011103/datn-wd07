@extends('admin.pages.permission.index')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Danh sách phân quyền</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Phân quyền</a></li>
                                    <li class="breadcrumb-item active">Danh sách</li>
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
                                <h4 class="card-title mb-0">Danh sách phân quyền</h4>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="listjs-table" id="customerList">
                                    <div class="row g-4 mb-3">
                                        <div class="col-sm-auto">
                                            <div>
                                                <a class="btn btn-success add-btn" href="{{ route('add_permission') }}"><i class="ri-add-line align-bottom me-1"></i> Thêm
                                                    mới </a>
                                                    <button class="btn btn-soft-danger" onClick="deleteMultiples()"><i
                                                        class="ri-delete-bin-2-line"></i></button>
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
                                                    <th data-sort="customer_name">ID</th>
                                                    <th data-sort="email">Tên</th>
                                                    <th data-sort="phone">Mô tả</th>
                                                    <th data-sort="phone">Phân quyền con</th>
                                                    <th data-sort="action">Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                @foreach ($permissions as $per)
                                                    <tr  id="row{{ $per->id }}">
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="rowCheckbox" value="{{ $per->id }}">
                                                            </div>
                                                        </th>
                                                        <td class="id" style="display:none;"><a
                                                                href="javascript:void(0);"
                                                                class="fw-medium link-primary">#VZ2101</a></td>
                                                        <td class="phone">{{ $per->id }}</td>
                                                        <td class="date">{{ $per->name }}</td>
                                                        <td class="email">{{ $per->description }}</td>
                                                        <td>
                                                            <?php foreach($permissions as $pers) : ?>
                                                            <?php if($per['parent_id'] == $pers['id']) : ?>
                                                            <?= $pers['name'] ?>
                                                            <?php endif ?>
                                                            <?php endforeach ?>
                                                        </td>

                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <div class="edit">
                                                                    {{-- <button class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal" data-bs-target="#showModal">Edit</button> --}}
                                                                    <a href="{{ route('edit_permission', ['id' => $per->id]) }}"
                                                                        class="btn btn-warning btn-sm edit-item-btn"><i class="bx bx-edit"></i></a>
                                                                </div>
                                                                {{-- <div class="remove">
                                                                    <a href="{{ route('delete_permission', ['id' => $per->id]) }}"
                                                                        OnClick='return confirm("Bạn có chắc muốn xóa không ?")'
                                                                        class="btn btn-sm btn-danger remove-item-btn">Xóa</a>
                                                                </div> --}}
                                                                <div class="remove">
                                                                    <button class="btn btn-sm btn-danger btn-remove"
                                                                        data-bs-toggle="modal" data-bs-target="#modalDelete"
                                                                        data-role-id="{{ $per->id }}"><i class="bx bx-trash"></i></button>
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
                                                <h5 class="mt-2">Sorry! No Result Found</h5>
                                                <p class="text-muted mb-0">We've searched more than 150+ Orders We did not
                                                    find any
                                                    orders for you search.</p>
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
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © Velzon.
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
