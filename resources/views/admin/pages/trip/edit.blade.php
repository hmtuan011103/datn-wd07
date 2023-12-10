@extends('admin.pages.trip.index')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Sửa chuyến đi</h4>

                            {{-- <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Update Trip</li>
                            </ol>
                        </div> --}}

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                {{-- <h4 class="card-title mb-0">Thêm Role</h4> --}}
                            </div><!-- end card header -->

                            <div class="card-body">
                                <form action="{{ route('save_edit_trip', ['id' => $trip->id]) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label class="control-label">Ngày đi</label>
                                                <input class="form-control" name="start_date"
                                                    value="{{ formatEditDateTrip($trip->start_date) }}" id="inputDate"
                                                    placeholder="dd/mm/yyyy" type="text">
                                                <span aria-hidden="true"></span>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label class="control-label">Tuyến</label>
                                                <select class="form-select" name="route_id" id="inputRoute">
                                                    <option value="">Chọn tuyến</option>
                                                    @foreach ($routes as $route)
                                                        <?php $selected = $route->id == $trip->route_id ? 'selected' : ''; ?>
                                                        <option {{ $selected }} value="{{ $route->id }}">
                                                            {{ $route->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span aria-hidden="true"></span>
                                            </div>
                                        </div>





                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label class="control-label">Danh sách xe</label>
                                                <select class="form-select" name="car_id" id="carEdit">                                             
                                                        <option selected  value="{{ $cars->id }}">
                                                            {{ $cars->name }}</option>
                                                </select>
                                                <span aria-hidden="true"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label class="control-label">Tài xế</label>
                                                <select class="form-select" name="drive_id" id="driverEdit">
                                                    <option selected  value="{{ $userDrive->id }}">
                                                        {{ $userDrive->name }}</option>
                                                </select>
                                                <span aria-hidden="true"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label class="control-label">Phụ xe</label>
                                                <select class="form-select" name="assistantCar_id" id="assistantEdit">
                                                    <option selected  value="{{ $assistantCar->id }}">
                                                        {{ $assistantCar->name }}</option>
                                                </select>
                                                <span aria-hidden="true"></span>
                                            </div>
                                        </div>

                                        <input id="tripId" type="hidden" value="{{ $trip->id }}">












                                        {{-- <div class="col-md-6">
										<div class="form-group has-feedback">
										  <label class="control-label">Trạng thái</label> --}}
                                        <input class="form-control" name="status" placeholder="Mô tả"
                                            value="{{ $trip->status }}" type="hidden">
                                        {{-- <span  aria-hidden="true"></span> </div>
									  </div> --}}


                                    </div>

                                    <div class="hstack gap-2 justify-content-end">
                                        <a href="{{ route('list_trip') }}"><button type="button"
                                                class="btn btn-light">Danh sách</button></a>
                                        <button type="submit" class="btn btn-success">Sửa</button>
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
