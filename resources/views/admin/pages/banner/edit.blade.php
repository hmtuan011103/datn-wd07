@extends('admin.pages.banner.index')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Sửa banner</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Bảng</a></li>
                                    <li class="breadcrumb-item active">Sửa banner</li>
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
                                <h4 class="card-title mb-0">Sửa banner</h4>

                            </div><!-- end card header -->

                            <div class="card-body">
                                <form action="{{ route('update_banner', ['id' => $banner->id]) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <label class="col-md-3 col-sm-4 control-label">Ảnh</label>
                                    <div class="col-md-9 col-sm-8">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <img id="anh_the_preview"
                                                    src="{{ $banner->image ? asset($banner->image) : 'https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg' }}"
                                                    alt="your image"
                                                    style="max-width: 500px; height:300px; margin: 50px 50px;"
                                                    class="img-fluid" />
                                                <input type="file" name="image" accept="image/*"
                                                    class="form-control @error('image') is-invalid @enderror" id="cmt_anh"
                                                    value="{{ $banner->image }}">
                                                @error('image')
                                                    <div class="pb-3 pt-3 fw-bold text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <label class="col-md-3 col-sm-4 control-label mt-5 mb-3">Trạng thái</label>
                                    <select class="form-select" name="status">
                                        <option value="0" {{ $banner->status == 0 ? 'selected' : '' }}>Không Kích hoạt
                                        </option>
                                        <option value="1" {{ $banner->status == 1 ? 'selected' : '' }}>Kích hoạt
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="pb-3 pt-3 fw-bold text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="hstack gap-2 justify-content-end mt-4">
                                        <a href="{{ route('banner') }}"><button type="button" class="btn btn-light">Danh
                                                sách</button></a>
                                        <button type="submit" class="btn btn-success">Cập nhật</button>
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
