@extends('admin.pages.search-ticket.index')
@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">


                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">


                            <div class="card-body">
                                <div class="listjs-table" id="customerList">
                                    <div class="container ">
                                        <div class="form-ticket">
                                            <div class="title-search">
                                                <p style="color: #151529">TRA CỨU THÔNG TIN VÉ</p>
                                            </div>
                                            <form>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="phone_number"
                                                        name="phone_number" placeholder="Vui lòng nhập điện thoại">
                                                    <label for="phone" class="form-label">Số điện thoại</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="ticketCode"
                                                        name="ticketCode" placeholder="Vui lòng nhập mã vé">
                                                    <label for="ticketCode" class="form-label">Mã vé</label>
                                                </div>
                                                <div class="button">
                                                    <button type="submit" id="searchButton" class=" btn-search">Tra
                                                        cứu</button>

                                                </div>
                                            </form>
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




                <!--end modal -->

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

    </div>

    @include('admin.pages.search-ticket.detail-ticket')
@endsection
