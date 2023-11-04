@extends('admin.pages.news.index')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Bài viết</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Bảng</a></li>
                                    <li class="breadcrumb-item active">Bài viết</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Thêm Mới Bài viết</h4>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <form class="tablelist-form" autocomplete="off"
                                    action="{{ route('update_new', $model->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 pt-3">
                                                <label for="customername-field" class="form-label">Tiêu đề *</label>
                                                <input type="text" name="title" id="customername-field"
                                                    value="{{ $model->title }}" class="form-control"
                                                    placeholder="Nhập Tên Tiêu Đề" />
                                            </div>

                                            <div class="col-md-6 pt-3">
                                                <label for="total_seat" class="form-label">Người tạo *</label>
                                                <select class="form-control" name="user_id" id="total_seat">
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}"
                                                            {{ $model->user_id == $user->id ? 'selected' : '' }}>
                                                            {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 pt-3">
                                                <label for="customername-field" class="form-label">Ảnh </label>

                                                <input type="file" value="{{ $model->image }}" name="image1"
                                                    id="image" class="form-control" placeholder="Nhập File Ảnh" />
                                                    <br>
                                                    <img style="padding-bottom: 10px" src="{{ asset($model->image) }}" alt="" width="100"
                                                    height="100">
                                            </div>
                                            <div class="mb-3">
                                                <label for="email-field" class="form-label">Nội dung </label>
                                                <textarea style="height: 100px" name="content" id="editor" class="form-control" placeholder="Nhập Mô Tả">{{ $model->content }}</textarea>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="button" class="btn btn-light"><a
                                                        href="{{ route('index_new') }}">Danh Sách</a></button>
                                                <button type="submit" class="btn btn-success" id="add-btn">Cập Nhật
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end col -->
                </div>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © Velzon.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Design & Develop by Themesbrand
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection
@section('script')
    @include('admin.pages.news.script')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
