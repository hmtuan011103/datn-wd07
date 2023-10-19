<?php

namespace App\Http\Controllers\Locations\Client;

use App\Http\Controllers\Locations\BaseLocationController;

class LocationController extends BaseLocationController
{
    //
    public function list_client_location()
    {
        $location = $this->locationService->listClient();
        return response()->json([$location],200);
    }
}
