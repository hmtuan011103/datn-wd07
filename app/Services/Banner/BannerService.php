<?php

namespace App\Services\Banner;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerService
{
    public function index()
    {
        $banners = Banner::all();
        return $banners;
    }

    public function create(Request $request)
    {
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = "uploads/" . Storage::put('banners', $request->file('image'));
        }
        return Banner::query()->create($data);
    }

    public function update(Request $request, Banner $banner)
    {
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = Storage::put('banners', $request->file('image'));
        }
        $oldPath = $banner->image;
        if ($request->hasFile('image')) {
            Storage::delete($oldPath);
        }
        return $banner->update($data);
    }

    public function destroy(Banner $banner)
    {
        if (Storage::exists($banner->image)) {
            Storage::delete($banner->image);
        }
        return $banner->delete();
    }
}
