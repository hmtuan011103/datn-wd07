<?php

namespace App\Services\Locations;

class LocationService
{
    public function index()
    {
        return response()->json([
            'data' => 1
        ]);
    }
}
