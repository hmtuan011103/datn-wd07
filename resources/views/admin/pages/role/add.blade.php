@extends('admin.pages.role.index')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Thêm vai trò</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                    <li class="breadcrumb-item active">Thêm vai trò</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Thêm Vai trò</h4>

                            </div><!-- end card header -->

                            <div class="card-body">
                                <form action="{{ route('add_role') }}" method="POST">
                                    @csrf
                                    
                                        <div class="mb-3">
                                            <label for="customername-field" class="form-label">Tên</label>
                                            <input type="text" class="form-control" name="name" />
                                            @if ($errors->has('name'))
                                                <div class="text-danger">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <label for="email-field" class="form-label">Mô tả</label>
                                            <input type="text" class="form-control" name="description" />
                                            @if ($errors->has('description'))
                                                <div class="text-danger">
                                                    {{ $errors->first('description') }}
                                                </div>
                                            @endif
                                        </div>


                                    

                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light">Danh sách</button>
                                        <button type="submit" class="btn btn-success">Thêm mới</button>
                                        <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
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
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

    </div>
@endsection
