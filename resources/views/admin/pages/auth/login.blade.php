<div class="auth-page-wrapper pt-5">
    <!-- auth page bg -->
    <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
        <div class="bg-overlay"></div>

        <div class="shape">
            {{-- <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 1440 120">
                <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
            </svg> --}}
        </div>
    </div>

    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">
            <div class="row justify-content-center my-5">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Mừng quay lại !</h5>
                                <p class="text-muted">Đăng nhập để quản trị website.</p>
                            </div>
                            <div class="p-2 mt-4">
                                <form class="was-validated" action="{{ route('login.submit') }}" method="POST"
                                    id="form-login">
                                    @csrf
                                    @method('POST')

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Nhập email" required>
                                        @error('email')
                                            <div class="help-block error-help-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="form-label" for="password-input">Mật khẩu</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" class="form-control pe-5 password-input"
                                                placeholder="Nhập mật khẩu" id="password-input" name="password"
                                                minlength="8" required>
                                        </div>
                                        @error('password')
                                            <div class="help-block error-help-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        @error('wrong-info')
                                            <div class="help-block error-help-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mt-4 mb-3">
                                        <button class="btn btn-success w-100" type="submit">Đăng nhập</button>
                                    </div>

                                    <div class="text-end user-select-none">
                                        <a href="{{ route('forgot.password.form') }}">
                                            <span class="text-muted">Quên mật khẩu?</span>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="mt-4 text-center row mx-auto">
                        <p class="mb-0 user-select-none">
                            Về trang chủ?
                            <a href="/" class="fw-semibold text-primary text-decoration-underline">
                                Bấm vào đây!
                            </a>
                        </p>
                        <div class="row mx-auto">
                            <div class="col col-md-6 p-3">
                                <button class="btn btn-primary" id="admin-account">Sử dụng tài khoản admin</button>
                            </div>
                            <div class="col col-md-6 p-3">
                                <button class="btn btn-primary" id="staff-account">Sử dụng tài khoản nhân viên</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->
</div>
