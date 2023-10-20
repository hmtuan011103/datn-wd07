@extends('client.layout.main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="text-center my-5 text-uppercase">Tin tức nổi bật</h2>
            </div>
        </div>
        <hr>
        <div class="row">
            @foreach($data as $item)
                <div class="col-md-6 mb-3">
                    <div class="row">
                        <div class="col">
                            <img src="{{ asset($item->image) }}" alt="" width="270" height="154px" class="rounded">
                        </div>
                        <div class="col">
                            <h5 style="font-size: 20px">{{ substr($item->title, 0, 50) . '...' }}</h5>
                            <span>{{
                                substr($item->content, 0, 30) . '...'
                             }}</span>
                            <br>
                            <span style="font-size: 12px">{{ date('d-m-Y', strtotime($item->created_at)) }}</span> <br>
                            {{-- <a href="" class="">Xem chi tiết</a> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            <div class="">
                {{$data->links()}}
            </div>
        </div>

    </div>
@endsection
