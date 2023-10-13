@extends('admin.pages.role.index')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Thêm vai trò</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Bảng</a></li>
                                    <li class="breadcrumb-item active">Thêm vai trò</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Thêm Vai trò</h4>

                            </div><!-- end card header -->

                            <div class="card-body">
                                <form action="{{ route('post_add_role') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="customername-field" class="form-label">Tên*</label>
                                        <input type="text" class="form-control" name="name" />
                                        @error('name')
                                                <div class="ps-4 pb-3 fw-bold text-danger">{{ $message }}</div>
                                            @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="email-field" class="form-label">Mô tả</label>
                                        <textarea class="form-control" name="description" id="" cols="10" rows="10"></textarea>

                                    </div>
                                    <div>
                                        <label for="" class="pt-3 pb-3">Quyền*</label>
                                        <div id="treeview_container"
                                            class="hummingbird-treeview border border-dark rounded pt-3 mb-4">
                                            <ul  id="treeview" class="hummingbird-base mb-0">
                                                @foreach ($permission as $per)
                                                    <li data-id="0">
                                                        @if (App\Models\Permission::where(['parent_id' => $per->id])->count() == 0)
                                                            {{-- <i class="fa fa-minus"></i> --}}
                                                            <th>&nbsp;&nbsp;</th>
                                                        @else
                                                            {{-- <i class="fa fa-plus"></i> --}}
                                                            <i class="fa fa-angle-right fs-3" aria-hidden="true"></i>
                                                        @endif

                                                        <label>
                                                            <input id="xnode-0" data-id="custom-0" type="checkbox"
                                                                name="permission[]" value="{{ $per->id }}" />
                                                            {{ $per->name }}
                                                        </label>
                                                        <ul>
                                                            @foreach (App\Models\Permission::where(['parent_id' => $per->id])->get() as $permission)
                                                                <li data-id="1">
                                                                    <label>
                                                                        <input id="xnode-0-1" data-id="custom-0-1"
                                                                            type="checkbox" name="permission[]"
                                                                            value="{{ $permission->id }}" />
                                                                        {{ $permission->name }}
                                                                    </label>
                                                                    <ul>
                                                                        <li>
                                                                            <label>
                                                                                <input class="hummingbird-end-node"
                                                                                    id="xnode-0-2-1" data-id="custom-0-2-1"
                                                                                    type="checkbox" />
                                                                                node-0-2-1
                                                                            </label>
                                                                        </li>

                                                                    </ul>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endforeach

                                            </ul>
                                            @error('permission')
                                                <div class="ps-4 pb-3 fw-bold text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="hstack gap-2 justify-content-end">
                                        <a href="{{ route('list_role') }}"><button type="button" class="btn btn-light">Danh
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
