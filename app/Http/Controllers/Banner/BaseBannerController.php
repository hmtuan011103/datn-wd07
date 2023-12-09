<?php

namespace App\Http\Controllers\Banner;

use App\Http\Controllers\Controller;
use App\Services\Banner\BannerService;
use Illuminate\Http\Request;

class BaseBannerController extends Controller
{
    protected $BannerService;
    public function __construct(BannerService $BannerService)
    {
        $this->BannerService = $BannerService;
    }
}
