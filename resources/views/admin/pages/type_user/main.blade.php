<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Danh sách loại người dùng</h4>
                        </div>

                        <div class="card-body">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <a href="{{ route('type_users.create') }}" class="btn btn-success add-btn">
                                                <i class="ri-add-line align-bottom me-1"></i>
                                                Thêm mới
                                            </a>
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
                                    @if (count($data) > 0)
                                        <table class="table align-middle table-nowrap" id="customerTable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col" style="width: 50px;">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="checkAll" value="option">
                                                        </div>
                                                    </th>
                                                    <th>Loại người dùng</th>
                                                    <th>Ngày tạo</th>
                                                    <th>Chỉnh sửa lần cuối</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                @foreach ($data as $item)
                                                    <tr id="row{{ $item->id }}">
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="rowCheckbox" value="{{ $item->id }}">
                                                            </div>
                                                        </th>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ helperFormatTime($item->created_at) ?? 'Trống' }}</td>
                                                        <td>{{ helperFormatTime($item->updated_at) ?? 'Trống' }}</td>

                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <div class="edit">
                                                                    <a href="{{ route('type_users.edit', ['type_user' => $item->id]) }}"
                                                                        class="btn btn-sm btn-success edit-item-btn">
                                                                        Sửa
                                                                    </a>
                                                                </div>

                                                                <div class="remove">
                                                                    <form
                                                                        action="{{ route('type_users.destroy', ['type_user' => $item->id]) }}"
                                                                        method="POST"
                                                                        id="deleteForm{{ $item->id }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-danger btn-destroy-item"
                                                                            onclick="confirmDelete({{ $item->id }})">
                                                                            Xóa
                                                                        </button>
                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    @else
                                        <div class="noresult">
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
                                    @endif
                                </div>

                                {{-- paginate --}}
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
                                {{-- {{ $data->links() }} --}}

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
