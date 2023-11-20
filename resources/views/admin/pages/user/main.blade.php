<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Danh sách người dùng</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="listjs-table" id="idTableContainer">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <a href="{{ route('users.create') }}" class="btn btn-success add-btn">
                                                <i class="ri-add-line align-bottom me-1"></i>
                                                Thêm mới
                                            </a>

                                            <button class="btn btn-soft-danger ms-2" onClick="deleteMultiple()">
                                                <i class="ri-delete-bin-2-line"></i>
                                            </button>
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
                                    <table class="table align-middle table-nowrap" id="idTagTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col" style="width: 50px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkAll"
                                                            value="option">
                                                    </div>
                                                </th>
                                                <th class="sort" data-sort="name">Tên</th>
                                                <th class="sort" data-sort="user_type">Phân loại</th>
                                                <th class="sort" data-sort="email">Email</th>
                                                <th class="sort" data-sort="created_at">Ngày tạo</th>
                                                <th class="sort" data-sort="updated_at">Chỉnh sửa lần cuối</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            @if (count($data) < 1)
                                                <tr>
                                                    <td colspan="99">
                                                        <div class="noresult">
                                                            <div class="text-center">
                                                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json"
                                                                    trigger="loop"
                                                                    colors="primary:#121331,secondary:#08a88a"
                                                                    style="width:75px;height:75px">
                                                                </lord-icon>
                                                                <h5 class="mt-2">Rất tiếc! Không tìm thấy kết quả
                                                                    nào
                                                                </h5>
                                                                <p class="text-muted mb-0">
                                                                    Chúng tôi đã tìm kiếm cẩn thận nhưng không thấy có
                                                                    kết quả nào cả, vui lòng thử lại sau.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif

                                            @foreach ($data as $item)
                                                <tr>
                                                    @if (!in_array('admin', $item->role_name))
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="chk_child" value="option{{ $item->id }}">
                                                            </div>
                                                        </th>
                                                        {{-- delete multiple will catch this id --}}
                                                        <td class="id" style="display:none;">
                                                            <a href="javascript:void(0);"
                                                                class="fw-medium link-primary">
                                                                {{ $item->id }}
                                                            </a>
                                                        </td>
                                                    @else
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" disabled>
                                                            </div>
                                                        </th>
                                                    @endif
                                                    <td class="name">{{ $item->name }}</td>
                                                    <td class="user_type">{{ $item->user_type }}</td>
                                                    <td class="email">{{ $item->email }}</td>
                                                    <td class="created_at">
                                                        {{ helperFormatTime($item->created_at) ?? 'Trống' }}</td>
                                                    <td class="updated_at">
                                                        {{ helperFormatTime($item->updated_at) ?? 'Trống' }}</td>

                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <div class="view-detail">
                                                                <a href="{{ route('users.show', ['user' => $item->id]) }}"
                                                                    class="btn btn-sm btn-secondary">
                                                                    <i class="bx bx bx-show"></i>
                                                                </a>
                                                            </div>

                                                            <div class="edit">
                                                                <a href="{{ route('users.edit', ['user' => $item->id]) }}"
                                                                    class="btn btn-sm btn-success edit-item-btn">
                                                                    <i class="bx bx-edit"></i>
                                                                </a>
                                                            </div>

                                                            @if (!in_array('admin', $item->role_name))
                                                                <div class="remove">
                                                                    <form
                                                                        action="{{ route('users.destroy', ['user' => $item->id]) }}"
                                                                        method="POST"
                                                                        id="deleteForm{{ $item->id }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-danger btn-destroy-item"
                                                                            onclick="confirmDelete({{ $item->id }})">
                                                                            <i class="bx bx-trash"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    {{-- no result found --}}
                                    <div class="noresult" style="display: none">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                colors="primary:#121331,secondary:#08a88a"
                                                style="width:75px;height:75px">
                                            </lord-icon>
                                            <h5 class="mt-2">Rất tiếc! Không tìm thấy kết quả nào</h5>
                                            <p class="text-muted mb-0">
                                                Chúng tôi đã tìm kiếm cẩn thận nhưng không thấy có kết quả nào cả,
                                                vui lòng thử lại sau.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                {{-- paginate --}}
                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">
                                        <a class="page-item pagination-prev disabled" href="javascript:void(0);">
                                            &lsaquo;
                                        </a>
                                        <ul class="pagination listjs-pagination mb-0"></ul>
                                        <a class="page-item pagination-next" href="javascript:void(0);">
                                            &rsaquo;
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
        </div>
    </div>
</div>
