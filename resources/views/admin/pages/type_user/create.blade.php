<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Thêm mới loại người dùng</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <form class="row g-3 was-validated" action="{{ route('type_users.store') }}" method="POST"
                                id="form-create-typeuser">
                                @csrf
                                @method('POST')

                                <div class="col-md-4" style="min-height:7rem">
                                    <label for="validationCustom01" class="form-label">Tên loại người dùng</label>
                                    <input type="text" class="form-control" name="name" id="validationCustom01"
                                        placeholder="Nhân viên..." value="{{ old('name') }}" required minlength="2"
                                        maxlength="125">
                                    @error('name')
                                        <div class="help-block error-help-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <a href="{{ route('type_users.index') }}" class="btn btn-soft-primary">
                                        Danh sách
                                    </a>
                                    <button class="btn btn-primary" type="submit">Tạo mới</button>
                                </div>

                                <div class="row g-3">
                                    <label class="form-label">Danh sách hiện tại:</label>
                                    @foreach ($allTypeUserData as $item)
                                        <div class="col text-center btn btn-warning m-2">
                                            {{ $item->name }}
                                        </div>
                                    @endforeach
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
