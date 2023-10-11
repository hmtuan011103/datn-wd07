<?php

namespace App\Services\Locations;

use App\Models\Location;
use Illuminate\Support\Facades\Storage;

class LocationService
{
    public function list()
    {    
       return Location::all();
    }

    
    public function create( $request)
    {    
        if($request->isMethod('POST')) {
        $params = $request->all();
            unset($params['_token']);
            if($request->hasFile('image') && $request->file('image')->isValid()) {
                $params['image'] = uploadFile('hinh',$request->file('image'));
            }
        
        Location::create($params);   

        }
    }


    public function update( $request, $id) {
        $location = Location::find($id);
        if($request->isMethod('POST')) {
            $params = $request->except('_token','image','proengsoft_jsvalidation');
            if($request->hasFile('image') && $request->file('image')->isValid()) {
                Storage::delete('/public/'.$location->image);
                $params['image'] = uploadFile('hinh',$request->file('image'));
            }else {
                $params['image']= $location->image;
            }
           Location::where('id',$id)->update($params);
        }
    }
}
