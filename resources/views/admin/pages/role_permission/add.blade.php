@extends('admin.pages.role.index')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Thêm Role</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Add Roles</li>
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
                            <h4 class="card-title mb-0">Thêm Role</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <form action="{{ route('add_role') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <select class="form-select rounded-pill mb-3" aria-label="Default select example">
                                        <option selected>Search for services</option>
                                        <option value="1">Information Architecture</option>
                                        <option value="2">UI/UX Design</option>
                                        <option value="3">Back End Development</option>
                                    </select>
                                    <div id="tree">
                                        <ul>
                                          <li>
                                            <label>
                                              <input type="checkbox" value="1"> Parent 1
                                            </label>
                                            <ul>
                                              <li>
                                                <label>
                                                  <input type="checkbox" value="1.1"> Child 1.1
                                                </label>
                                              </li>
                                              <li>
                                                <label>
                                                  <input type="checkbox" value="1.2"> Child 1.2
                                                </label>
                                              </li>
                                            </ul>
                                          </li>
                                          <li>
                                            <label>
                                              <input type="checkbox" value="2"> Parent 2
                                            </label>
                                            <ul>
                                              <li>
                                                <label>
                                                  <input type="checkbox" value="2.1"> Child 2.1
                                                </label>
                                              </li>
                                              <li>
                                                <label>
                                                  <input type="checkbox" value="2.2"> Child 2.2
                                                </label>
                                              </li>
                                            </ul>
                                          </li>
                                        </ul>
                                      </div>
                                    <div class="mb-3">
                                        <label for="email-field" class="form-label">Description</label>
                                        <input type="text" class="form-control" name="description"/>
                                    </div>
                            
                            
                                </div>
                                
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light"
                                            >Danh sách</button>
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


