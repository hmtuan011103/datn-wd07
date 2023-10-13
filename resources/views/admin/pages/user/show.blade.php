<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Chi tiết người dùng</h4>
                        </div>

                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="validationCustom01" class="form-label">Tên người dùng</label>
                                    <input type="text" class="form-control" name="name" id="validationCustom01"
                                        placeholder="something" value="{{ $data->name }}" disabled>
                                    @error('name')
                                        <div class="invalid-feedback d-inline-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="validationCustomEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="validationCustomEmail"
                                        placeholder="something@something.something" value="{{ $data->email }}"
                                        disabled>
                                </div>

                                <div class="col-md-4">
                                    <label for="validationCustomPhone" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" name="phone_number"
                                        id="validationCustomPhone" placeholder="0342222222"
                                        value="{{ $data->phone_number }}" disabled>
                                </div>

                                <div class="col-md-2">
                                    <label for="validationTypeUserSelect" class="form-label">Loại người dùng</label>
                                    <select class="form-select" id="validationTypeUserSelect" name="user_type_id"
                                        disabled>
                                        <option selected disabled value="">...</option>
                                        @foreach ($allTypeUserData as $item)
                                            <option value="{{ $item->id }}" @selected($item->id == $data->user_type_id)>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-5">
                                    <label for="validationCustomAddress" class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" name="address"
                                        id="validationCustomAddress" placeholder="..." value="{{ $data->address }}"
                                        disabled>
                                </div>

                                <div class="col-md-5">
                                    <div class="d-flex flex-column">
                                        <label for="validationCustomDescription" class="form-label">Mô tả</label>
                                        <textarea name="description" id="validationCustomDescription" cols="30" rows="5" disabled>{{ $data->description }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <a href="{{ route('users.index') }}" class="btn btn-soft-primary">
                                        Danh sách
                                    </a>

                                    <a href="{{ route('users.edit', ['user' => $data->id]) }}" class="btn btn-success">
                                        Sửa
                                    </a>

                                    {{-- <form action="{{ route('users.destroy', ['user' => $data->id]) }}" method="POST"
                                        id="deleteForm{{ $data->id }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-destroy-item"
                                            onclick="confirmDelete({{ $data->id }})">
                                            Xóa
                                        </button>
                                    </form> --}}
                                </div>
                            </div>
                        </div><!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>
</div>
