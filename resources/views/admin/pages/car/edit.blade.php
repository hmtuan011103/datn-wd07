@extends('admin.pages.car.index')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <form class="tablelist-form" autocomplete="off" action="{{route('update_car',$model->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Tên Chuyến Xe</label>
                                    <input type="text" name="name" value="{{ $model->name }}" id="customername-field" class="form-control" placeholder="Enter Name Permission"  />
                                </div>
                                <div class="mb-3">
                                    <label for="email-field" class="form-label">Ảnh</label>
                                    <input type="file" name="image" value="{{ $model->image }}" id="image" class="form-control" placeholder="Enter Total_seat"  />
                                </div>
                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Màu Xe</label>
                                    <input type="text" name="color" value="{{ $model->color }}" class="form-control" placeholder="Enter Name Permission"  />
                                </div>
                                <div class="mb-3">
                                    <label for="email-field" class="form-label">Biển Số Xe</label>
                                    <input type="text" name="license_plate" value="{{ $model->license_plate }}" class="form-control" placeholder="Enter Total_seat"  />
                                </div>
                                <div class="mb-3">
                                    <label for="email-field" class="form-label">Mô Tả</label>
                                    <input type="text" name="description" value="{{ $model->description }}" class="form-control" placeholder="Enter Description"  />
                                </div>
                                <div class="mb-3">
                                    <label for="email-field" class="form-label">Loại Xe</label>
                                    <select class="form-control" aria-label="Default select example" name="id_type_car">
                                        @foreach($data as $item)
                                            <option value="{{ $item->id }}"
                                                @selected($item->id == $model->id_type_car)
                                            >
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="email-field" class="form-label">Trạng Thái</label>
                                    <select class="form-control" aria-label="Default select example" name="status" >

                                        <option value="0">Tạo</option>
                                        <option value="1">Đi</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success" id="add-btn">Add </button>
                                        <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                    </div>
                                </div>
                            </div>
                        </form>
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

