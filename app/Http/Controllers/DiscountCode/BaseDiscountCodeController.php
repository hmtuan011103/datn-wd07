<?php

namespace App\Http\Controllers\DiscountCode;

use App\Http\Controllers\Controller;
use App\Services\DiscountCode\DiscountCodeService;
use Illuminate\Support\Facades\Log;

class BaseDiscountCodeController extends Controller
{
    protected $discountcodeService;

    public function __construct(DiscountCodeService $discountcodeService)
    {
        $this->discountcodeService = $discountcodeService;
    }

}