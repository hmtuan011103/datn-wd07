@extends('admin.pages.route.index')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Thêm tuyến đường</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Bảng</a></li>
                                    <li class="breadcrumb-item active">Thêm tuyến đường</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Thêm tuyến đường</h4>

                            </div><!-- end card header -->

                            <div class="card-body">
                                <form action="{{ route('store_route') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label class="control-label">Điểm bắt đầu</label>
                                                <select class="form-control selectpicker" id="option1" name="start_location">
                                                    <option value="" selected>Điểm bắt đầu</option>
                                                    @foreach ($locations as $location)
                                                        <option value="{{ $location->id }}">{{ $location->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span aria-hidden="true"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label class="control-label">Điểm kết thúc</label>
                                                <select class="form-control selectpicker" id="option2" name="end_location">
                                                    <option value="" selected>Điểm kết thúc</option>
                                                    @foreach ($locations as $location)
                                                        <option value="{{ $location->id }}">{{ $location->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label class="control-label">Giờ đi</label>
                                                <input class="form-control" style="cursor: pointer" id="start_time"
                                                    name="start_time" type="time">
                                                <span id="time" style="color: red; font-weight:500"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label class="control-label">Thời gian hành trình</label>
                                                <input class="form-control" id="timeInput" oninput="validateTime()"
                                                    onblur="formatTime()" placeholder="Nhập thời gian" name="interval_trip"
                                                    type="text">

                                                <span id="interval" style="color: red ; font-weight:500"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group has-feedback">
                                                <label class="control-label">Danh sách xe</label>
                                                <select class="form-control selectpicker" name="car_id[]" multiple 
                                                     data-style="btn-light"  data-size="5">
                                                    {{-- <option value="" selected>Chọn xe</option> --}}
                                                    @foreach ($cars as $car)
                                                        <option value="{{ $car->id }}">{{ $car->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label class="control-label">Tài xế</label>
                                                <select class="form-control selectpicker" multiple name="driver_id[]"
                                                    data-style="btn-light"  data-size="5">
                                                    {{-- <option value="" selected>Chọn tài xế</option> --}}
                                                    @foreach ($drivers as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span aria-hidden="true"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label class="control-label">Phụ xe</label>
                                                <select class="form-control selectpicker" multiple name="assistantCar_id[]"
                                                    data-style="btn-light"  data-size="5">
                                                    {{-- <option value="" selected>Chọn phụ xe</option> --}}
                                                    @foreach ($assistants as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label class="control-label">Trạng thái</label>
                                                <select class="form-control selectpicker" multiple name="status"
                                                    data-style="btn-light"  data-size="5">
                                                    <option value="0" >Không hoạt động</option>
                                                    <option value="1" selected>Hoạt động</option>
                                                </select>
                                                <span aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label class="control-label">Giá vé</label>
                                                <input class="form-control" onChange="format_curency(this);"
                                                    name="trip_price" placeholder="VND" type="number">
                                                <span aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="customername-field" class="form-label">Mô tả</label>
                                            <textarea class="form-control" name="description" id="" cols="10" rows="10"></textarea>
                                        </div>
                                    </div>
                                    <div class="hstack gap-2 justify-content-end">
                                        <a href="{{ route('list_route') }}"><button type="button"
                                                class="btn btn-light">Danh
                                                sách</button></a>
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
