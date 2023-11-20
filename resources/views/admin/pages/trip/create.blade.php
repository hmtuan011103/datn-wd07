

@extends('admin.pages.trip.index')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Thêm chuyến đi</h4>

                        {{-- <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Add Trip</li>
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
                            <form action="{{ route('create_trip') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
									<div class="col-md-6">
										<div class="form-group has-feedback">
										  <label class="control-label">Danh sách xe</label>
										  <select class="form-select"   name="car_id">
											  <option value="">Chọn xe</option>
											  @foreach ($cars as $car)
											  <option value="{{$car->id}}">{{$car->name}}</option>
											  @endforeach
										  </select>
										  <span  aria-hidden="true"></span> </div>
									  </div>

									  <div class="col-md-6">
										<div class="form-group has-feedback">
										  <label class="control-label">Tài xế</label>
										  <select class="form-select"   name="drive_id">
											  <option value="">Chọn tài xé</option>
											  @foreach ($users as $user)
											  <option value="{{$user->id}}">{{$user->name}}</option>
											  @endforeach
										  </select>
										  <span  aria-hidden="true"></span> </div>
									  </div>

									  <div class="col-md-6">
										<div class="form-group has-feedback">
										  <label class="control-label">Phụ xe</label>
										  <select class="form-select"   name="assistantCar_id">
											  <option value="">Chọn phụ xe</option>
											  @foreach ($users as $user)
											  <option value="{{$user->id}}">{{$user->name}}</option>
											  @endforeach
										  </select>
										  <span  aria-hidden="true"></span> </div>
									  </div>

									<div class="col-md-6">
									  <div class="form-group has-feedback">
										<label class="control-label">Ngày đi</label>
										<input class="form-control"  name="start_date" id="date-input" placeholder="dd/mm/yyy" type="text"  >

										<span  aria-hidden="true"></span> </div>
									</div>

									<div class="col-md-6">
										<div class="form-group has-feedback">
										  <label class="control-label">Giờ đi</label>
										  <input class="form-control" style="cursor: pointer"  name="start_time"  type="time">
										  <span  aria-hidden="true"></span> </div>
									  </div>

									  <div class="col-md-6">
										<div class="form-group has-feedback">
										  <label class="control-label">Thời gian hành trình</label>
										  <input class="form-control" id="timeInput" oninput="validateTime()" onblur="formatTime()"  placeholder="Nhập thời gian" name="interval_trip"  type="text">
										
										  <span  aria-hidden="true"></span> </div>
									  </div>

									 									
									  <div class="col-md-6">
										<div class="form-group has-feedback">
										  <label class="control-label">Điểm bắt đầu</label>
										  {{-- <input class="form-control" name="end_location" placeholder="Điểm kết thúc" type="text"> --}}
										  <select class="form-select" id="option1" name="start_location">
											<option value=""></option>
											@foreach ($locations as $location)
											<option value="{{$location->name}}">{{$location->name}}</option>
											@endforeach
										</select>
										  <span  aria-hidden="true"></span> </div>
									  </div>

									  <div class="col-md-6">
										<div class="form-group has-feedback">
										  <label class="control-label">Điểm kết thúc</label>
										  {{-- <input class="form-control" name="end_location" placeholder="Điểm kết thúc" type="text"> --}}
										  <select class="form-select" id="option2"   name="end_location">
											<option value=""></option>
											@foreach ($locations as $location)
											<option value="{{$location->name}}">{{$location->name}}</option>
											@endforeach
										</select>
										  <span  aria-hidden="true"></span> </div>
									  </div>

									  <div class="col-md-6">
										<div class="form-group has-feedback">
										  <label class="control-label">Giá vé</label>
										  <input class="form-control"  onChange="format_curency(this);"  name="trip_price" placeholder="VND" type="number">
										  <span  aria-hidden="true"></span> </div>
									  </div>

									  {{-- <div class="col-md-6">
										<div class="form-group has-feedback">
										  <label class="control-label">Trạng thái</label> --}}
										  <input class="form-control" name="status" placeholder="Mô tả" value="1" type="hidden">
										  {{-- <span  aria-hidden="true"></span> </div>
									  </div> --}}
									
								
									 </div> 
                                
                                    <div class="hstack gap-2 justify-content-end">
                                        <a href="{{route('list_trip')}}"><button type="button" class="btn btn-light"
                                            >Danh sách</button></a>
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