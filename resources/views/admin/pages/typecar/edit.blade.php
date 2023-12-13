@extends('admin.pages.typecar.index')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Loại Xe</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Bảng</a></li>
                                    <li class="breadcrumb-item active">Cập Nhật Loại Xe</li>
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
                                <h4 class="card-title mb-0">Cập nhật Loại Xe</h4>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <form class="tablelist-form" autocomplete="off" action="{{route('update_typecar',$model->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 pt-3 pb-3">
                                                <label for="customername-field" class="form-label">Loại Xe *</label>
                                                <input type="text" name="name" value="{{$model->name}}" id="customername-field" class="form-control" placeholder="Nhập Tên Loại Xe"/>
                                            </div>
                                            <div class="col-md-6 pt-3 pb-3">
                                                <label for="total_seat" class="form-label">Số Lượng Ghế *</label>
                                                <input type="text" name="total_seat" value="{{$model->total_seat}}"  id="total_seat" class="form-control" placeholder="Nhập Số Lượng Ghế"/>
                                            </div>
                                            <div class="col-md-6 pb-3">
                                                <label for="type_seats" class="form-label">Loại ghế</label>
                                                <select class="form-control" id="type_seats--choosing" aria-label="Default select example" name="type_seats">
                                                    <option value="1" @if ($model->type_seats == 1) selected @endif>Ghế Ngồi</option>
                                                    <option value="2" @if ($model->type_seats == 2) selected @endif>Giường Nằm</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 pb-3" id="number_floors--choosing">
                                                <label for="number_floors" class="form-label">Số tầng *</label>
                                                <select class="form-control" name="number_floors" >
                                                    <option value="1" @if ($model->number_floors == 1) selected @endif>1</option>
                                                    <option value="2" @if ($model->number_floors == 2) selected @endif>2</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 pb-3">
                                                <label for="customername-field" class="form-label">Mô Tả </label>
                                                <textarea style="height: 100px" name="description" id="email-field" class="form-control"  placeholder="Nhập Mô Tả"  >{{$model->description}}</textarea>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="button" class="btn btn-light"><a href="{{route('index_typecar')}}">Danh Sách</a></button>
                                                <button type="submit" class="btn btn-success" id="add-btn">Cập Nhật</button>
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
@section('script')
    @include('admin.pages.typecar.script')
@endsection
