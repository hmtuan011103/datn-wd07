<?php

namespace App\Http\Controllers\Route;

use App\Http\Controllers\Controller;
use App\Services\Route\RouteService;
use Illuminate\Support\Facades\Log;

class BaseRouteController extends Controller
{
    protected $routeService;

    public function __construct(RouteService $routeService)
    {
        $this->routeService = $routeService;
    }

}