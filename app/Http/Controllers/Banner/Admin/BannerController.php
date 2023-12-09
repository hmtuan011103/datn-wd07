<?php

namespace App\Http\Controllers\Banner\Admin;

use App\Http\Controllers\Banner\BaseBannerController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Banner\StoreBannerRequest;
use App\Http\Requests\Banner\UpdateBannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends BaseBannerController
{
    public function index(){
        $title = 'Quản lý banner';
        $banners = Banner::all();
        return view('admin.pages.banner.main',compact('banners','title'));
    }

    public function create(){
        $title = 'Thêm mới Banner';
        return view('admin.pages.banner.add', compact('title'));
    }

    public function store(StoreBannerRequest $request){
        $result = $this->BannerService->store($request);
        if ($result) {
            toastr()->success('Thành công','Thêm thành công!');
            return back();
        }
    }

    public function update_status(Request $request,$id){
        $result = $this->BannerService->update_status($request,$id);
        if ($result) {
            toastr()->success('Thành công','Trạng thái của banner đã được thay đổi!');
            return back();
        }
        return back();
    }

    public function edit($id){
        $title = 'Sửa banner';
        $banner = Banner::find($id);
        return view('admin.pages.banner.edit', compact('title','banner'));
    }

    public function update(UpdateBannerRequest $request,$id){
        $result = $this->BannerService->update($request,$id);
        if ($result) {
            toastr()->success('Thành công','Sửa banner thành công!');
            return redirect()->route('banner');
        }
        return redirect()->route('banner');
    }

    public function delete($id){
        $result = $this->BannerService->delete($id);
        if ($result) {
            return response()->json(["Xóa thành công!"],200);
        }
    }
}
