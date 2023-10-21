<?php

namespace App\Http\Controllers\Trip\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Trip\BaseTripController;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TripController extends BaseTripController
{
    public function lich_trinh()
    {
        return view('client.pages.trip.index');
    }

    public function getData()
    {
        $data = $this->tripService->getData();
        return response()->json($data);
        // return view('client.pages.trip.main', compact('trips'));
    }

    public function search_start_trip(Request $request)
    {   
      
        $trip = $this->tripService->search($request);      
        return response()->json($trip);
        
    }

    // public function search_end_trip(Request $request)
    // {
       
    //     $trip = $this->tripService->search_end($request);
    //     return response()->json($trip);
    // }

}
