@extends('admin.pages.permission.index')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Form Edit Permission</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                <li class="breadcrumb-item active">Form Layout</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{ route('saveEditPermission', ['id' => $permission->id]) }}"
                                    method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="compnayNameinput" class="form-label">Name</label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Name Permission" value="{{ $permission->name }}">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="phonenumberInput" class="form-label">Description</label>
                                                <textarea class="form-control" name="description" id="" cols="10" rows="10">{{ $permission->description }}</textarea>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-12">
                                            <label for="email-field" class="form-label">Parent permission</label>
                                            <select class="form-select form-select-md" name="parent_id">
                                                <option value="0"></option>
                                                @foreach ($permissions as $per)
                                                    @if ($permission['parent_id'] == $per['id'])
                                                        <option value="{{ $per['id'] }}" selected>{{ $per['name'] }}</option>
                                                    @else
                                                        <option value="{{ $per['id'] }}">{{ $per['name'] }}</option>
                                                    @endif
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Edit Permission</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
