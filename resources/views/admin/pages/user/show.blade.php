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
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">Chi tiết người dùng</h4>
                                    </div>

                                    <div class="card-body">
                                        <form class="row g-3">
                                            <div class="col-md-2">
                                                <label for="validationCustom01" class="form-label">Tên người
                                                    dùng</label>
                                                <input type="text" class="form-control" value="{{ $data->name }}"
                                                    disabled>
                                            </div>

                                            <div class="col-md-3">
                                                <label for="validationCustomEmail" class="form-label">Email</label>
                                                <input type="email" class="form-control" value="{{ $data->email }}"
                                                    disabled>
                                            </div>

                                            <div class="col-md-2">
                                                <label for="validationCustomPhone" class="form-label">Số điện
                                                    thoại</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $data->phone_number }}" disabled>
                                            </div>

                                            <div class="col-md-2">
                                                <label for="validationTypeUserSelect" class="form-label">Loại người
                                                    dùng</label>
                                                <select class="form-select" name="user_type_id" disabled>
                                                    <option selected disabled value="">...</option>
                                                    @foreach ($allTypeUserData as $item)
                                                        <option value="{{ $item->id }}"
                                                            @selected($item->id == $data->user_type_id)>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="validationUserRoleSelect" class="form-label">*Vai
                                                    trò</label>
                                                <select class="form-select" id="validationUserRoleSelect"
                                                    multiple="multiple" disabled>
                                                    @foreach ($data->role_all as $item)
                                                        @php
                                                            $matching = in_array($item->id, $data->role_actived);
                                                        @endphp
                                                        <option class="text-center" value="{{ $item->id }}"
                                                            @selected($matching)>{{ $item->name }}
                                                            Mô tả: {{ $item->description }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col">
                                                <div class="d-flex flex-column">
                                                    <label for="validationCustomDescription" class="form-label">
                                                        Mô tả</label>
                                                    <textarea name="description" id="validationCustomDescription" cols="30" rows="12" disabled>{{ $data->description }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label for="validationCustomAddress" class="form-label">Địa chỉ</label>
                                                <input type="text" class="form-control" id="validationCustomAddress"
                                                    placeholder="..." value="{{ $data->address }}" disabled>
                                            </div>

                                            <div class="col-12 mb-3 mt-5">
                                                <a href="{{ route('users.edit', ['user' => $data->id]) }}"
                                                    class="btn btn-success">
                                                    <i class="bx bx-edit"></i>
                                                </a>

                                                <form action="{{ route('users.destroy', ['user' => $data->id]) }}"
                                                    method="POST" id="deleteForm{{ $data->id }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-destroy-item"
                                                        onclick="confirmDelete({{ $data->id }})">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </form>
                                    </div><!-- end card -->
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
