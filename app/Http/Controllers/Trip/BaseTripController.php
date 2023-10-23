<?php

namespace App\Http\Controllers\Trip;

use App\Http\Controllers\Controller;
use App\Services\Trips\TripService;

class BaseTripController extends Controller
{
    protected $tripService;

    public function __construct(TripService $tripService)
    {
        $this->tripService = $tripService;
    }
}
