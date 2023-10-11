@extends('admin.pages.car.index')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Chuyến Xe</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Bảng</a></li>
                                <li class="breadcrumb-item active">Chuyến Xe</li>
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
                            <h4 class="card-title mb-0">Danh Sách Chuyến Xe</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="listjs-table" id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div class="col-sm-auto">
                                            <div>
                                                <a href="{{route('create_car')}}"><button type="button" class="btn btn-success add-btn"  a><i class="ri-add-line align-bottom me-1"></i> Thêm Mới</button></a>
                                                <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <div class="search-box ms-2">
                                                <input type="text" class="form-control search"
                                                       placeholder="Search...">
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
                                                    <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                                </div>
                                            </th>
                                            <th data-sort="customer_name">ID</th>
                                            <th data-sort="customer_name">Ảnh</th>
                                            <th data-sort="customer_name">Tên Chuyến Xe</th>
                                            <th data-sort="customer_name">Màu Xe</th>
                                            <th data-sort="customer_name">Biển Số Xe</th>
                                            <th data-sort="customer_name">Mô Tả</th>
                                            <th data-sort="customer_name">Trạng Thái</th>
                                            <th data-sort="customer_name">Loại Xe</th>
                                            <th data-sort="action">Chức Năng</th>

                                        </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                        @foreach($data as $item)
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                                    </div>
                                                </th>
                                                <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#VZ2101</a></td>
                                                <td class="customer_name">{{$item->id}}</td>
                                                <td class="customer_name"><img src="{{ asset($item->image) }}" alt="" width="100px"></td>
                                                <td class="customer_name">{{$item->name}}</td>
                                                <td class="customer_name">{{$item->color}}</td>
                                                <td class="customer_name">{{$item->license_plate}}</td>
                                                <td class="customer_name">{{$item->description}}</td>
                                                <td class="customer_name">{{$item->status}}</td>
                                                <td class="customer_name">{{$item->typeCar->name}}</td>

                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <div >
                                                            <button type="button" class="btn btn-sm btn-success edit-item-btn"
                                                                    data-bs-toggle="modal" id="create-btn"
                                                                    data-bs-target="#modal{{$item->id}}"> Add</button>
                                                        </div>
                                                        <div class="edit">
                                                            <a href="{{route('edit_car',['id'=>$item->id])}}" class="btn btn-success btn-sm edit-item-btn" >Edit</a>
                                                        </div>
                                                        <div class="remove">
                                                            <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteRecordModal"
                                                                    onclick="if(confirm('Are you sure?'))
                                                                   {document.getElementById('item-{{$item->id}}').submit()}">
                                                                Xóa
                                                            </button>
                                                            <form action="{{route('destroy_car',$item)}}" id="item-{{$item->id}}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </div>
                                                    </div>
                                                <td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="noresult" style="display: none">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json"
                                                       trigger="loop" colors="primary:#121331,secondary:#08a88a"
                                                       style="width:75px;height:75px">
                                            </lord-icon>
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                            <p class="text-muted mb-0">We've searched more than 150+ Orders We
                                                did not find any
                                                orders for you search.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">
                                        <a class="page-item pagination-prev disabled"
                                           href="javascript:void(0);">
                                            Previous
                                        </a>
                                        <ul class="pagination listjs-pagination mb-0"></ul>
                                        <a class="page-item pagination-next" href="javascript:void(0);">
                                            Next
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
            @foreach($data as $item)
            <div class="modal fade" id="modal{{$item->id}}" tabindex="-1"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-light p-3">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    id="close-modal"></button>
                        </div>
                       <table class="table align-middle table-nowrap" id="customerTable">
                                        <tbody class="list form-check-all">
                                            <tr>
                                                @foreach($item->seats as $pe)
                                                    <td class="customer_name">{{$pe->code_seat}}</td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                    </div>
                </div>
            </div>
            @endforeach

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
