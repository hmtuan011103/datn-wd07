<?php

namespace App\Http\Controllers\Trip\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Trip\BaseTripController;
use Illuminate\Http\Request;

class TripController extends BaseTripController
{
    //
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

    public function get_type_car(){
        $type_car = $this->tripService->get_all_type_car();
        return response()->json($type_car,200);
    }
}
