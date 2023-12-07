@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">{{$title}}</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Bảng</a></li>
                                    <li class="breadcrumb-item active">{{$title}}</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">{{$title}}</h4>
                                <button class="btn btn-primary float-end"><a class="text-light" href="{{route('export_trip')}}">Xuất file pdf</a></button>
                            </div>
                            <div class="card-body">
                                
                                <div id='calendar'></div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
@endsection
