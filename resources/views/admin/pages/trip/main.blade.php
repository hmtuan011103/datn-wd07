@extends('admin.pages.trip.index')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-trips-center justify-content-between">
                        <h4 class="mb-sm-0">Danh sách chuyến đi</h4>
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
                        {{-- <div class="card-header">
                            <h4 class="card-title mb-0">List Trip</h4>
                            <h4 class="mb-sm-0">Danh sách chuyến đi</h4>

                        </div><!-- end card header --> --}}

                        <div class="card-body">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <a href="{{route('form_create_trip')}}"><button type="button" class="btn btn-success add-btn"
                                                data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i
                                                    class="ri-add-line align-bottom me-1"></i> Thêm</button></a>
                                            <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i
                                                    class="ri-delete-bin-2-line"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <div class="search-box ms-2">
                                                <input type="text" class="form-control search"
                                                    placeholder="Tìm kiếm...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="customerTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col" style="width: 50px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkAll"
                                                            value="option">
                                                    </div>
                                                </th>
                                                {{-- <th class="sort" data-sort="customer_name">ID</th> --}}
                                                <th class="sort" data-sort="email">Tên xe</th>
                                                <th class="sort" data-sort="email">Tên tài xế</th>
                                                <th class="sort" data-sort="phone">Ngày đi</th>
                                                <th class="sort" data-sort="date">Giờ đi</th>
                                                <th class="sort" data-sort="date">Giá vé</th>
                                                <th class="sort" data-sort="date">Điểm bắt đầu</th>
                                                <th class="sort" data-sort="date">Điểm kết thúc</th>
                                                <th class="sort" data-sort="action">Chức năng</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            @foreach ($trips as $trip)
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="chk_child" value="option1">
                                                        </div>
                                                    </th>
                                                    <td class="id" style="display:none;"><a
                                                            href="javascript:void(0);"
                                                            class="fw-medium link-primary">#VZ2101</a></td>
                                                    {{-- <td class="customer_name">{{ $trip->id }}</td> --}}
                                                    <td class="email">{{ $trip->car_name }}</td>
                                                    
                                                    <td class="email">{{ $trip->user_name }}</td>
                                                    <td class="phone">{{date('d-m-Y', strtotime($trip->start_date))}}</td>
                                                    <td class="phone">{{ $trip->start_time }}</td>
                                                    <td class="phone">{{ $trip->trip_price }}.000 VND</td>
                                                    <td class="phone">{{ $trip->start_location }}</td>
                                                    <td class="phone">{{ $trip->end_location }}</td>

                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            {{-- <div class="detail">
                                                                <button data-url = "{{route('show',['id'=>$trip->id])}}" class="btn btn-success btn-sm edit-item-btn btn-show" data-target="#show" data-toggle="modal" 
                                                                    >Xem chi tiết</button>
                                                            </div> --}}
                                                            <div class="edit">
                                                                <a href="{{route('edit_trip',['id'=>$trip->id])}}"><button class="btn btn-success btn-sm edit-item-btn"><i class="bx bx-edit"></i></button></a>
                                                            </div>
                                                            <div class="remove">
                                                               <a href="{{route('delete_trip',['id'=>$trip->id])}}" onclick="return confirm('Bạn có chắc chắn muốn xóa chuyến đi này')"><button class="btn btn-sm btn-danger btn-remove"><i class="bx bx-trash"></i></button></a> 
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="noresult" style="display: none">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                colors="primary:#121331,secondary:#08a88a"
                                                style="width:75px;height:75px">
                                            </lord-icon>
                                            <h5 class="mt-2">Xin lỗi! Không có kết quả nào</h5>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">
                                        <a class="page-trip pagination-prev disabled" href="javascript:void(0);">
                                            Trước
                                        </a>
                                        <ul class="pagination listjs-pagination mb-0"></ul>
                                        <a class="page-trip pagination-next" href="javascript:void(0);">
                                            Tiếp
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

            
            <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                id="btn-close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mt-2 text-center">
                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                    colors="primary:#f7b84b,secondary:#f06548"
                                    style="width:100px;height:100px"></lord-icon>
                                <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                    <h4>Are you Sure ?</h4>
                                    <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Record ?</p>
                                </div>
                            </div>
                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                <button type="button" class="btn w-sm btn-light"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn w-sm btn-danger " id="delete-record" >Yes, Delete
                                    It!</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end modal -->

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@include('admin.pages.trip.detail')

</div>    
@endsection
