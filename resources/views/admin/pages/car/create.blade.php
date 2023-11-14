@extends('admin.pages.car.index')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Xe</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Bảng</a></li>
                                    <li class="breadcrumb-item active">Thêm Mới Xe</li>
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
                                <h4 class="card-title mb-0">Thêm Mới Xe</h4>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <form class="tablelist-form" autocomplete="off" action="{{route('store_car')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 pt-3 pb-3">
                                            <label for="name" class="form-label">Tên Xe *</label>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Nhập Tên Xe"  />
                                        </div>
                                        <div class="col-md-6 pt-3 pb-3">
                                            <label for="image" class="form-label">Ảnh </label>
                                            <input type="file" name="image" id="image" class="form-control" placeholder="Nhập File Ảnh"  />
                                        </div>
                                        <div class="col-md-6 pt-3 pb-3">
                                            <label for="color" class="form-label">Màu Xe *</label>
                                            <input type="color" name="color" id="color" class="form-control" />
                                        </div>
                                        <div class="col-md-6 pt-3 pb-3">
                                            <label for="license_plate" class="form-label">Biển Số Xe *</label>
                                            <input type="text" name="license_plate" id="license_plate" class="form-control" placeholder="Nhập Biển Số Xe"  />
                                        </div>
                                        <div class="col-md-6 pt-3 pb-3">
                                            <label for="id_type_car" class="form-label">Loại Xe *</label>
                                            <select class="form-control" aria-label="Default select example" name="id_type_car">
                                                @foreach($data as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 pt-3 pb-3">
                                            <label for="status" class="form-label">Trạng Thái</label>
                                            <select class="form-control" aria-label="Default select example" name="status" >
                                                <option value="0">Xe Đang Hoạt Động</option>
                                                <option value="1">Xe Đã Ngừng Hoạt Động</option>
                                            </select>
                                        </div>
                                        <div class="md-3">
                                            <label for="description" class="form-label">Mô Tả</label>
                                            <textarea id="description" name="description" style="height: 150px;margin-bottom: 50px"   class="form-control" placeholder="Nhập Mô Tả"></textarea>
                                        </div>

                                    </div>
                                    <div class="hstack gap-2 justify-content-end">
                                        <a href="{{route('index_car')}}"><button type="button" class="btn btn-light"
                                            >Danh sách</button></a>
                                        <button type="submit" class="btn btn-success" id="add-btn">Thêm Mới </button>
                                        <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
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
                        <script>document.write(new Date().getFullYear())</script> © Velzon.
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

