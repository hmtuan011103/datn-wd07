<?php

namespace App\Http\Controllers\Review\client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Review\BaseReviewController;
use App\Http\Requests\Review\StoreReviewRequest;
use App\Models\Comments;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ReviewController extends BaseReviewController
{
    //z
    public function create($trip_id,$user_id){
        $abc = env('APP_URL');
        $currentEnv = App::environment();
        $userInfo = User::query()->find($user_id);
        $tripInfo = Trip::query()->find($trip_id);
        $check_comment = Comments::query()->where('trip_id',$trip_id)
            ->where('user_id',$user_id)
            ->exists();
        if($check_comment){
            toastr()->error('Đánh Giá Thất Bại','Bạn Đã Đánh Giá Chuyến Đi Này Rồi!');
            return redirect()->route('trang_chu');
        }else{
            return view("client.pages.review.index",compact("tripInfo","userInfo"));
        }
    }

    public function store(StoreReviewRequest $request){
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $content = $request->content_evaluate;
        $trip_id = $request->trip_id;
        $user_id = $request->user_id;
        $data = [
            'name' => $name,
            'email'=> $email,
            'phone'=> $phone,
            'content'=> $content,
            'user_id'=>$user_id,
            'trip_id'=>$trip_id,
        ];
        if (isset($request->stars)) {
           $result = $this->reviewService->store($request);
        }else{
            toastr()->error('Không thành công','Bạn chưa chọn số sao!');
            return redirect()->back();
        }

        if ($result->id) {
            toastr()->success('Thành công','Bạn Đã Đánh Giá Thành Công!');
            return redirect()->route('trang_chu');
        }
    }
}
