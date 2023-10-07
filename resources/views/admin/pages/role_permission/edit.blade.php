@extends('admin.pages.role.index')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Sửa Role</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Sửa Roles</li>
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
                            <h4 class="card-title mb-0">Sửa Role</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <form action="{{ route('edit_role',['id' => $role->id]) }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="customername-field" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" value=" {{$role->name}} "/>
                                    </div>
                            
                                    <div class="mb-3">
                                        <label for="email-field" class="form-label">Description</label>
                                        <input type="text" class="form-control" name="description" value=" {{$role->description}} "/>
                                    </div>
                            
                            
                                </div>
                                
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light"
                                            >Danh sách</button>
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


