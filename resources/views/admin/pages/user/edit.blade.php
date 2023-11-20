<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Cập nhật người dùng</h4>
                        </div>

                        <div class="card-body">
                            <form class="row g-3" method="POST"
                                action="{{ route('users.update', ['user' => $data->id]) }}" id="form-edit-user">
                                @csrf
                                @method('PATCH')

                                <div class="col-md-2">
                                    <label for="validationCustom01" class="form-label">*Tên người dùng</label>
                                    <input type="text" class="form-control" name="name" id="validationCustom01"
                                        placeholder="something" value="{{ $data->name }}" required>
                                    @error('name')
                                        <div class="help-block error-help-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="validationCustomEmail" class="form-label">*Email</label>
                                    <input type="email" class="form-control" name="email" id="validationCustomEmail"
                                        placeholder="something@something.something" value="{{ $data->email }}"
                                        required>
                                    @error('email')
                                        <div class="help-block error-help-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label for="validationCustomPhone" class="form-label">*Số điện thoại</label>
                                    <input type="text" class="form-control" name="phone_number"
                                        id="validationCustomPhone" placeholder="0342222222"
                                        value="{{ $data->phone_number }}" required>
                                    @error('phone_number')
                                        <div class="help-block error-help-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label for="validationTypeUserSelect" class="form-label">*Loại người dùng</label>
                                    <select class="form-select" id="validationTypeUserSelect" name="user_type_id"
                                        required>
                                        <option selected disabled value="">...</option>
                                        @foreach ($allTypeUserData as $item)
                                            <option value="{{ $item->id }}" @selected($item->id == $data->user_type_id)>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_type_id')
                                        <div class="help-block error-help-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="validationUserRoleSelect" class="form-label">*Vai trò</label>
                                    <select class="form-select" id="validationUserRoleSelect" name="roles[]"
                                        multiple="multiple" required>
                                        @foreach ($data->role_all as $item)
                                            @php
                                                $matching = in_array($item->id, $data->roles);
                                            @endphp
                                            <option class="text-center" value="{{ $item->id }}"
                                                @selected($matching)>{{ $item->name }}
                                                Mô tả: {{ $item->description }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('roles')
                                        <div class="help-block error-help-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col">
                                    <div class="d-flex flex-column">
                                        <label for="validationCustomDescription" class="form-label">Mô tả</label>
                                        <textarea name="description" id="validationCustomDescription" cols="30" rows="12">{{ $data->description }}</textarea>
                                        @error('description')
                                            <div class="help-block error-help-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="validationCustomAddress" class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" name="address"
                                        id="validationCustomAddress" placeholder="..." value="{{ $data->address }}">
                                    @error('address')
                                        <div class="help-block error-help-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mt-5">
                                    <h3>Tùy Chọn đổi mật khẩu:</h3>
                                </div>
                                <div class="col-md-2">
                                    <label for="validationCustomPassword" class="form-label">Mật khẩu mới</label>
                                    <input type="password" class="form-control" name="password"
                                        id="validationCustomPassword" placeholder="********" minlength="8"
                                        maxlength="16">
                                    @error('password')
                                        <div class="help-block error-help-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label for="validationCustomPasswordRe" class="form-label">
                                        Xác nhận mật khẩu mới
                                    </label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        id="validationCustomPasswordRe" placeholder="********" minlength="8"
                                        maxlength="16">
                                    @error('password_confirmation')
                                        <div class="help-block error-help-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-12 my-3">
                                    <a href="{{ route('users.index') }}" class="btn btn-soft-primary">
                                        Danh sách
                                    </a>
                                    <button class="btn btn-primary" type="submit">Cập nhật</button>
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
