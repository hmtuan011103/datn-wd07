<?php

namespace App\Http\Controllers\Trip\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Trip\BaseTripController;
use Illuminate\Http\Request;

class TripController extends BaseTripController
{
    //
    public function searchTrip(Request $request)
    {
        if ($request->type_ticket == 1) {
            $trips = $this->tripService->searchTrip($request);
            if ($trips == null) {
                return response()->json(['status' => 0,$trips], 200);
            } else {
                return response()->json(['status' => 1,$trips], 200);
            }
        } else {
            $trips = $this->tripService->searchTrip($request);
            if ($trips == null) {
                return response()->json(['status' => 0,$trips], 200);
            } else {
                return response()->json(['status' => 2,$trips], 200);
            }
            
        }
    }
}
