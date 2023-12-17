<?php

namespace App\Services\Review;

use App\Http\Requests\Review\StoreReviewRequest;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Models\Comments;
use Illuminate\Support\Facades\Session;

class ReviewService
{
    public function store($request){
        // dd($request->all());
        if ($request->method() == "POST") {
            $comment = new Comments;
            $comment->user_id = $request->user_id;
            $comment->trip_id = $request->trip_id;
            $comment->stars = $request->stars;
            $comment->name = $request->name;
            $comment->email = $request->email;
            $comment->phone = $request->phone;
            $comment->content = $request->content_evaluate;
            $comment->save();
            return $comment;
        }
    }
}
