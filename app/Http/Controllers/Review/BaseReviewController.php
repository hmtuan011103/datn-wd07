<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use App\Services\Review\ReviewService;
use Illuminate\Support\Facades\Log;

class BaseReviewController extends Controller
{
    protected $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

}