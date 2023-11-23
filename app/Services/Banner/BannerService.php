<?php

namespace App\Services\Banner;

use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class BannerService
{
    public function store($request){

        $banner = new Banner;
        if ($request->hasFile('image')) {
            $banner->image = upload_file('banner', $request->file('image'));
        }
        $banner->status = $request->status;
        $banner->save();
        return $banner;
    }

    public function update_status($request,$id){
        $banner = Banner::findOrFail($id);
        $banner->status = (int)$request->status;
        $banner->save();
        return $banner;
    }

    public function update($request,$id){
        $banner = Banner::findOrFail($id);
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            Storage::delete(str_replace('storage', '', $banner->image));
            $banner->image = upload_file('banner', $request->file('image'));
        }
        $banner->status = (int)$request->status;
        $banner->save();
        return $banner;
    }

    public function delete($id)
    {
        $banner =  Banner::find($id);
        if ($banner) {
            Storage::delete(str_replace('storage', '', $banner->image));
            $result = $banner->delete();
            return $result;
        }
    }
}