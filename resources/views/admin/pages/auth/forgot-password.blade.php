<div class="auth-page-wrapper">
    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">
            <div class="row mx-auto justify-content-center mt-md-5">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4">
                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Quên mật khẩu?</h5>
                                <p class="text-muted">Đặt lại mật khẩu bằng email</p>

                                <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop"
                                    colors="primary:#0ab39c" class="avatar-xl">
                                </lord-icon>

                            </div>

                            <div class="alert border-0 alert-warning text-center mb-2 mx-2" role="alert">
                                Nhập email nhận mã xác thực. . .
                            </div>
                            <div class="p-2">
                                <form action="{{ route('forgot.password.submit') }}" method="POST"
                                    id="form-forgot-password">
                                    @csrf
                                    @method('POST')
                                    <div class="mb-4">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="Nhập Email" />
                                        @error('email')
                                            <div class="help-block error-help-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        @if (session('status'))
                                            <div class="alert alert-success">
                                                {{ session('status') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="text-center mt-4">
                                        <button class="btn btn-success w-100" type="submit">
                                            Gửi mã
                                        </button>
                                    </div>
                                </form><!-- end form -->
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
