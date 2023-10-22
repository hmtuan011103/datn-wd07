<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-tabs-custom arrow-navtabs nav-success nav-justified mb-3"
                                role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#account-info" role="tab">
                                        Thông tin tài khoản
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#bill-list" role="tab">
                                        Danh sách hóa đơn
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#comment-histories" role="tab">
                                        Lịch sử bình luận
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content text-muted">
                                {{-- account info --}}
                                <div class="tab-pane active" id="account-info" role="tabpanel">
                                    <div class="card-header p-0 py-3 d-flex flex-wrap align-items-center gap-3">
                                        <h4 class="card-title mb-0">Chi tiết người dùng</h4>
                                        <a href="{{ route('users.edit', ['user' => $data->id]) }}"
                                            class="btn btn-sm btn-success edit-item-btn">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">Tên</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Số điện thoại</th>
                                                    <th scope="col">Loại tài khoản</th>
                                                    <th scope="col">Vai trò</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <span class="fw-semibold text-black text-capitalize">
                                                            {{ $data->name }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            {{ $data->email }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            {{ $data->phone_number }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="text-capitalize">
                                                            {{ $data->user_type }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div style="max-height: 200px;">
                                                            <ol class="list-group">
                                                                @foreach ($data->roles as $role)
                                                                    <li class="text-capitalize">
                                                                        <div class="d-flex flex-wrap">
                                                                            <div class="ms-2">
                                                                                <h6 class="fs-14 mb-0">
                                                                                    {{ $role->name }}
                                                                                </h6>
                                                                                <small class="text-muted">
                                                                                    {{ $role->description }}
                                                                                </small>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot class="table-light">
                                                <tr>
                                                    <td colspan="99">
                                                        <p>Địa chỉ:</p>
                                                        <span class="text-muted">
                                                            {{ $data->address ?? 'Trống' }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="99">
                                                        <p>Mô tả:</p>
                                                        <span class="text-muted">
                                                            {{ $data->description ?? 'Trống' }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <!-- end table -->
                                    </div>
                                    <!-- end table responsive -->
                                </div>

                                {{-- bill list --}}
                                <div class="tab-pane" id="bill-list" role="tabpanel">
                                    <div class="d-flex">
                                        <p>Chưa có đơn nào cả~</p>
                                    </div>
                                </div>

                                {{-- comment histories --}}
                                <div class="tab-pane" id="comment-histories" role="tabpanel">
                                    <div class="d-flex">
                                        <p>Chưa có bình luận nào cả~</p>
                                    </div>
                                </div>

                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div>
                <!--end col-->
            </div>

            <div class="row">
                <div class="col-12">
                    <a href="{{ route('users.index') }}" class="btn btn-soft-primary">
                        Danh sách
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
