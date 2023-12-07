<?php

namespace App\Http\Controllers\Review\client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Review\BaseReviewController;
use App\Http\Requests\Review\StoreReviewRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ReviewController extends BaseReviewController
{
    //z
    public function create(){
        $abc = env('APP_URL');
        $currentEnv = App::environment();
        return view("client.pages.review.index");
    }

    public function store(StoreReviewRequest $request){
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $content = $request->content;
        $data = [
            'name' => $name,
            'email'=> $email,
            'phone'=> $phone,
            'content'=> $content
        ];
        if (isset($request->stars)) {
           $result = $this->reviewService->store($request);
        }else{
            toastr()->error('Không thành công','Bạn chưa chọn số sao!');
            return view('client.pages.review.index', compact('data'));
        }

        if ($result->id) {
            toastr()->success('Thành công','Thêm đánh giá mới thành công!');
            return redirect()->route('review');
        }
    }
}
