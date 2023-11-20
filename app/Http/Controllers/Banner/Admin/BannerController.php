<?php

namespace App\Http\Controllers\Banner\Admin;

use App\Http\Controllers\Banner\BaseBannerController;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends BaseBannerController
{
    public function index()
    {
        $title = 'Banners';
        $data = $this->BannerService->index();
        return view('admin.pages.banners.main', compact('data', 'title'));
    }

    public function store(Request $request)
    {
        $title = 'Banners';
        if ($request->getMethod() === 'POST') {
            $this->BannerService->create($request);
        }
        return view('admin.pages.banners.create', compact('title'));
    }

    public function update(Request $request, Banner $banner)
    {
        $title = 'Banners';
        if ($request->getMethod() === 'PATCH') {
            $this->BannerService->update($request, $banner);
        }
        return view('admin.pages.banners.update', compact('banner', 'title'));
    }
}
