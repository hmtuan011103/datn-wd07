@extends('client.layout.main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <main class="w-full">
                    <div class="layout pt-4 pb-10">
                        <div class="text-left">
                            <h3 class="px-5 pt-5">{{ $data->title }}
                            </h3>
                            <div class="px-5 text-xs text-neutral-400">Ngày đăng:
                                {{ \Carbon\Carbon::parse($data->created_at)->format('d/m/y h:m:s') }}</div>
                            <div class="px-5 italic"></div>
                            <div class="content-editor px-5 py-2">
                                {!! $data->content !!}
                            </div>
                        </div>

                        <div class="row g-4 px-5 pb-5">
                            <div class="col-12 mt-4">
                                <div class="d-flex align-items-center">
                                    <h1 class="text-success h3 text-bold">Tin tức liên quan</h1>
                                    <div class="mt-1 flex-grow-1 bg-success" style="height: 2px;"></div>
                                    <a href="{{route('client.news')}}" class="d-flex align-items-center font-weight-medium text-warning text-decoration-none">
                                        <div class="d-flex align-items-center">
                                            <span class="ms-3 h5 text-decoration-none me-2" style="color: #EF5222;font-size: 1rem; line-height: 1.5rem;">Xem tất cả</span>
                                            <img src="https://futabus.vn/images/icons/ic_arrow_right.svg" alt="" style="font-size: 1rem; line-height: 1.5rem;">
                                        </div>
                                    </a>


                                </div>
                            </div>

                            @if(isset($random) && $random->isNotEmpty())
                            @foreach($random as $row)
                            <div class="col-12 col-md-6 mb-2">
                                <a href="{{route('client.news.detail')}}/{{$row->id}}"
                                    class="d-flex gap-4 text-decoration-none text-dark">
                                    <div class="aspect-ratio aspect-ratio-7x4">
                                        <img src="{{ asset($row->image) }}"
                                            class="img-fluid" alt="{{$row->title}}" style="width:262px;height:150px;border-radius:10px">
                                    </div>
                                    <div class="w-50">
                                        <h2 class="h4 font-weight-bold mb-1">{{$row->title}}</h2>
                                        <p class="text-gray my-1 ">{{ \Carbon\Carbon::parse($data->created_at)->format('d/m/y h:m:s') }}</p>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                            @else
                            <div class="col-12 col-md-6">
                               <p>Không có bài viết liên quan nào</p>
                            </div>
                            @endif

                        </div>

                    </div>
                </main>
            </div>
        </div>

    </div>
@endsection
