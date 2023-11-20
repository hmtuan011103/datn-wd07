<div class="auth-page-wrapper pt-5">
    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4">
                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Tạo mật khẩu mới</h5>
                                <p class="text-muted">
                                    Mật khẩu mới của bạn phải khác với mật khẩu hiện tại.
                                </p>
                            </div>

                            <div class="p-2">
                                <form action="{{ route('password.update') }}" method="POST" id="form-password-update">
                                    @csrf
                                    @method('POST')
                                    <input type="text" id="token-code" name="token" value="{{ Request()->token }}"
                                        hidden>
                                    <input type="email" id="email" name="email" value="{{ Request()->email }}"
                                        hidden>

                                    <div class="mb-3">
                                        <label class="form-label" for="password-input">Mật khẩu mới</label>
                                        <div class="position-relative auth-pass-inputgroup">
                                            <input type="password" class="form-control pe-5 password-input"
                                                placeholder="Mật khẩu mới" name="password" required>
                                            <button
                                                class="btn btn-link position-absolute end-0 top-0 text-decoration-none shadow-none text-muted password-addon"
                                                type="button" id="password-addon">
                                                <i class="ri-eye-fill align-middle"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="confirm-password-input">
                                            Xác nhận mật khẩu mới
                                        </label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" class="form-control pe-5 password-input"
                                                placeholder="Xác nhận mật khẩu mới" name="password_confirmation"
                                                required>
                                            <button
                                                class="btn btn-link position-absolute end-0 top-0 text-decoration-none shadow-none text-muted password-addon"
                                                type="button">
                                                <i class="ri-eye-fill align-middle"></i>
                                            </button>
                                        </div>
                                    </div>

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <p class="help-block error-help-block">Lỗi:</p>
                                            <ul class="m-0">
                                                @foreach ($errors->all() as $error)
                                                    <li class="help-block error-help-block">{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="mt-4">
                                        <button class="btn btn-success w-100" type="submit">
                                            Đặt lại mật khẩu
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="mt-4 text-center">
                        <p class="mb-0">
                            Đã có tài khoản...
                            <a href="{{ route('login.form') }}"
                                class="fw-semibold text-primary text-decoration-underline">
                                đến đăng nhập
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->
</div>
