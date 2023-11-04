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
            @foreach ($data as $item)
                <div class="col-md-6 mb-3 p-3">
                    <div class="d-flex" width="570px" style="margin-right: 10px">
                        <div class="col" style="padding-right: 10px"><a
                                href="{{ route('client.news.detail') }}/{{ $item->id }}">
                                <img src="{{ asset($item->image) }}" alt="" width="270" height="165px"
                                    class="rounded"></a>
                        </div>
                        <div class="col">
                            <a style="margin-right: 10px"
                                href="{{ route('client.news.detail') }}/{{ $item->id }}"class="text-decoration-none text-dark">
                                <div class="an">
                                    <h5 style="width:95%">{{ $item->title }}</h5>
                                </div>
                                <div class="bn">
                                    <p style="width:95%">{{ strip_tags($item->content) }}</p>
                                </div>
                                <span style="font-size: 12px">{{ date('d-m-Y', strtotime($item->created_at)) }}</span> <span
                                    style="font-size: 12px">
                                    {{ $item->created_at->format('H:i') }}
                                </span>

                            </a>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    @for ($i = 1; $i <= $data->lastPage(); $i++)
                        <li class="page-item {{$i == $currentPage ? 'active' : ''}}">
                            <a class="page-link" href="{{$data->url($i)}}" aria-label="Previous">
                                <span aria-hidden="true">{{$i}}</span>
                            </a>
                        </li>
                    @endfor

                    </li>
                </ul>
            </nav>
        </div>

    </div>
    <style>
        .an {
            display: block;
            display: -webkit-box;
            font-size: 16px;
            line-height: 1.3;
            -webkit-line-clamp: 3;
            /* số dòng hiển thị */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .bn {
            display: block;
            display: -webkit-box;
            height: 16px*1.3*3;
            font-size: 16px;
            line-height: 1.3;
            -webkit-line-clamp: 2;
            /* số dòng hiển thị */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
@endsection
