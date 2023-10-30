<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Services\Home\HomeService;
use Illuminate\Support\Facades\Log;

class BaseHomeController extends Controller
{
    protected $homeservice;

    public function __construct(HomeService $homeservice)
    {
        $this->homeservice = $homeservice;
    }

}