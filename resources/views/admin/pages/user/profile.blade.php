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
                                    <a class="nav-link {{ $errors->any() ? '' : 'active' }}" data-bs-toggle="tab"
                                        href="#account-info" role="tab">
                                        Thông tin tài khoản
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ $errors->any() ? 'active' : '' }}" data-bs-toggle="tab"
                                        href="#password-change" role="tab">
                                        Đổi mật khẩu
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content text-muted">
                                {{-- account info --}}
                                <div class="tab-pane {{ $errors->any() ? '' : 'active' }}" id="account-info"
                                    role="tabpanel">
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

                                {{-- change password --}}
                                <div class="tab-pane {{ $errors->any() ? 'active' : '' }}" id="password-change"
                                    role="tabpanel">
                                    <form class="row g-3" method="POST"
                                        action="{{ route('users.profile.change.password', ['user' => $data->id]) }}"
                                        id="form-user-profile-change-password">
                                        @csrf
                                        @method('PATCH')
                                        <div class="col-md-12 mt-5">
                                            <h3>Đổi mật khẩu:</h3>
                                        </div>
                                        <div class="col">
                                            <label for="validationCustomPasswordcur"
                                                class="form-label d-flex align-items-center gap-2">
                                                Mật khẩu hiện tại
                                                <i class="mdi mdi-eye-off fs-4 cursor-pointer"
                                                    onclick="showPasswordToggle(this.classList, 'validationCustomPasswordcur')">
                                                </i>
                                            </label>
                                            <input type="password" class="form-control pe-4" name="password_current"
                                                id="validationCustomPasswordcur" placeholder="********" minlength="8"
                                                maxlength="16">
                                        </div>
                                        <br>
                                        <div class="col">
                                            <label for="validationCustomPassword"
                                                class="form-label d-flex align-items-center gap-2">
                                                Mật khẩu mới
                                                <i class="mdi mdi-eye-off fs-4 cursor-pointer"
                                                    onclick="showPasswordToggle(this.classList, 'validationCustomPassword')">
                                                </i>
                                            </label>
                                            <input type="password" class="form-control" name="password"
                                                id="validationCustomPassword" placeholder="********" minlength="8"
                                                maxlength="16">
                                        </div>

                                        <div class="col">
                                            <label for="validationCustomPasswordRe"
                                                class="form-label d-flex align-items-center gap-2">
                                                Xác nhận mật khẩu mới
                                                <i class="mdi mdi-eye-off fs-4 cursor-pointer"
                                                    onclick="showPasswordToggle(this.classList, 'validationCustomPasswordRe')">
                                                </i>
                                            </label>
                                            <input type="password" class="form-control" name="password_confirmation"
                                                id="validationCustomPasswordRe" placeholder="********" minlength="8"
                                                maxlength="16">
                                        </div>

                                        <div class="col-12 my-4">
                                            <button class="btn btn-primary" type="submit">Cập nhật</button>
                                        </div>
                                    </form>
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

@if (session('result-change-password'))
    <script>
        setTimeout(function() {
            location.reload();
        }, 1000);
    </script>
    @php
        toastr()->success('Cập nhật thành công', 'Thành công');
    @endphp
@endif
