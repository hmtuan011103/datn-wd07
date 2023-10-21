<?php

namespace App\Services\Locations;

use App\Models\Location;
use App\Models\Trip;
use Illuminate\Support\Facades\Storage;

class LocationService
{
    public function list()
    {    
       return Location::all();
    }

    public function get_desc_edit() {
        return Location::orderBy('updated_at', 'DESC')->where('parent_id',Null)->get();
    }

    public function get_parent_id() {
        return Location::select('locations.name','locations.id')->where('locations.parent_id',Null)->get();
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

    public function delete($id){
        // Permission::find($id)->delete();
        $location = Location::find($id) ;
        Storage::delete('/public/'.$location->image);
        $delete = Location::where('id', $id)
        ->orWhere('parent_id', $id)
        ->delete();     
        return $delete;
}

    public function listClient(){
        $locations = Location::where(['parent_id' => null])->get();
        return $locations;
    }
    
}
