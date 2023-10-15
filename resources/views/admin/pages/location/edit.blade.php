
@extends('admin.pages.location.index')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Sửa địa điểm</h4>


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
                                <form action="{{ route('save_edit_location', ['id' => $location->id]) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label class="control-label">Tên địa điểm</label>
                                                <input class="form-control" name="name" placeholder="Tên địa điểm "
                                                    value="{{ $location->name }}" type="text">
                                                <span aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label class="control-label">Ảnh</label> <br>
                                             <img id="image_preview"
                                                        src="{{ Storage::url($location->image) }}" alt="Customer image"
                                                        style="max-width: 200px; max-height: 100px"></label> <br> <br>
                                                <input class="form-control" name="image" value="{{$location->image}}" placeholder="Last Name"
                                                    type="file">
                                                <span aria-hidden="true"></span>         
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label class="control-label">Địa điểm cha</label>
                                                <select class="form-control" name="parent_id">
                                                    @if ($location['parent_id'] == '')
                                                    <option value="" selected>Trống</option>
                                                    @else
                                                    @endif

                                                    @foreach ($locations as $locat)
                                                    @if ($location['parent_id'] == $locat['id'])
                                                        <option value="{{ $locat['id'] }}" selected>{{ $locat['name'] }}</option>
                                                    @else                                                                                                     
                                                        <option value="{{ $locat['id'] }}">{{ $locat['name'] }}</option>
                                                    @endif                                                 
                                                @endforeach

                                              

                                                </select>
                                                <span aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label class="control-label">Mô tả</label>
                                                    <textarea class="form-control" style="height: 130px" name="description"   placeholder="Mô tả...">{{$location->description }}</textarea>
                                                <span aria-hidden="true"></span>
                                            </div>
                                        </div>


                                    </div> 

                                    <div class="hstack gap-2 justify-content-end">
                                        <a href="{{route('list_location')}}"><button type="button" class="btn btn-light">Danh
                                                sách</button></a>
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
@section('validateRequest')
{!! JsValidator::formRequest('App\Http\Requests\Location\UpdateLocationRequest') !!}
@endsection
