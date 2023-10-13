

@extends('admin.pages.location.index')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Thêm địa điểm</h4>

                      

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
                            <form action="{{ route('create_location') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
									<div class="col-md-6">
									  <div class="form-group has-feedback input group">
										<label class="control-label">Tên địa điểm</label>
										<input class="form-control" name="name" placeholder="Tên địa điểm " type="text">
										<span aria-hidden="true"></span> </div>
									</div>
									<div class="col-md-6">
									  <div class="form-group has-feedback ">
										<label class="control-label">Ảnh</label>
										<input class="form-control" name="image" placeholder="Last Name" type="file">
										<span  aria-hidden="true"></span> </div>
									</div>
									<div class="col-md-6">
									  <div class="form-group has-feedback">
										<label class="control-label">Địa điểm cha</label>
										<select class="form-select"  name="parent_id">
											{{-- <option value="" style="color:rgb(168, 168, 168)">Chọn địa điểm</option> --}}
											<option value="" selected>Trống</option>
											
											@foreach ($location as $item)
											<option value="{{$item->id}}">{{$item->name}}</option>
											@endforeach
									
										</select>
										<span  aria-hidden="true"></span> </div>
									</div>
									<div class="col-md-6">
									  <div class="form-group has-feedback">
										<label class="control-label">Mô tả</label>
										<textarea class="form-control" style="height: 130px" name="description" placeholder="Mô tả..."></textarea>
										<span  aria-hidden="true"></span> </div>
									</div>
									
								
									
								
									 </div> 
                                
                                    <div class="hstack gap-2 justify-content-end">
                                        <a href="{{route('list_location')}}"><button type="button" class="btn btn-light"
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
@section('validateRequest')
{!! JsValidator::formRequest('App\Http\Requests\Location\StoreLocationRequest') !!}
@endsection


