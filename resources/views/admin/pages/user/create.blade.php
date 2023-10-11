<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Thêm mới người dùng</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <form class="row g-3 needs-validation was-validated" action="{{ route('users.store') }}"
                                method="POST">
                                @csrf
                                @method('POST')

                                <div class="col-md-4">
                                    <label for="validationCustom01" class="form-label">Tên người dùng</label>
                                    <input type="text" class="form-control" name="name" id="validationCustom01"
                                        placeholder="something" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback d-inline-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="validationCustomEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="validationCustomEmail"
                                        placeholder="something@something.something" value="{{ old('email') }}"
                                        required>
                                    @error('email')
                                        <div class="invalid-feedback d-inline-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="validationCustomPhone" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" name="phone_number"
                                        id="validationCustomPhone" placeholder="0342222222"
                                        value="{{ old('phone_number') }}" required>
                                    @error('phone_number')
                                        <div class="invalid-feedback d-inline-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label for="validationTypeUserSelect" class="form-label">Loại người dùng</label>
                                    <select class="form-select" id="validationTypeUserSelect" name="user_type_id"
                                        required>
                                        <option selected disabled value="">...</option>
                                        @foreach ($allTypeUserData as $item)
                                            <option value="{{ $item->id }}" @selected($item->id == old('user_type_id'))>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_type_id')
                                        <div class="invalid-feedback d-inline-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-5">
                                    <label for="validationCustomPassword" class="form-label">Mật khẩu</label>
                                    <input type="password" class="form-control" name="password"
                                        id="validationCustomPassword" placeholder="********" minlength="8"
                                        maxlength="16" required>
                                    @error('password')
                                        <div class="invalid-feedback d-inline-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-5">
                                    <label for="validationCustomPasswordRe" class="form-label">Xác nhận mật khẩu</label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        id="validationCustomPasswordRe" placeholder="********" minlength="8"
                                        maxlength="16" required>
                                    @error('password_confirmation')
                                        <div class="invalid-feedback d-inline-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-5">
                                    <label for="validationCustomAddress" class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" name="address"
                                        id="validationCustomAddress" placeholder="..." value="{{ old('address') }}"
                                        required>
                                    @error('address')
                                        <div class="invalid-feedback d-inline-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-5">
                                    <div class="d-flex flex-column">
                                        <label for="validationCustomDescription" class="form-label">Mô tả</label>
                                        <textarea name="description" id="validationCustomDescription" cols="30" rows="5">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback d-inline-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <a href="{{ route('users.index') }}" class="btn btn-soft-primary">
                                        Trở lại danh sách
                                    </a>
                                    <button class="btn btn-primary" type="submit">Tạo mới</button>
                                </div>
                            </form>
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
