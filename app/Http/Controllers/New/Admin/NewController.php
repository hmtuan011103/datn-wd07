<?php

namespace App\Http\Controllers\New\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\New\BaseNewController;
use App\Http\Requests\NewPost\StoreNewRequest;
use App\Http\Requests\NewPost\UpdateNewRequest;
use Illuminate\Http\Request;
// use App\Http\Requests\NewPost\StoreNewRequest;
use App\Models\NewPost;
use App\Models\User;


class NewController extends BaseNewController
{
    public function index()
    {
        $data = NewPost::orderBy('created_at', 'desc')->get();
        // $data = NewPost::query()->get();
        $title = 'Trang quản lý tin tức';
        return view('admin.pages.news.main', compact('title', 'data'));
    }

    public function create()
    {
        $title = 'Trang thêm tin tức';
        $users = User::all();
        return view('admin.pages.news.create', compact('title', 'users'));
    }

    public function store(StoreNewRequest $request)
    {
        toastr()->success('Thêm Thành Công!');

        $this->NewPostService->store($request);
        return redirect()->route('index_new');
    }

    public function destroy(string $id)
    {

        toastr()->success('Xóa Thành Công!');
       $this->NewPostService->destroy($id);
        return redirect()->route('index_new');
    }
    public function edit(string $id){
        $title = 'Chỉnh sửa';
        $model = NewPost::query()->findOrFail($id);
        $users = User::all();
        return view('admin.pages.news.edit',compact('title','model','users'));
    }
    public function update(Request $request, string $id){
        toastr()->success('Cập nhật thành công');
        $this->NewPostService->update($request, $id);
        return redirect()->route('index_new');
    }
    public function destroyMultiple(Request $request)
    {
        $data = $request->ids;

        return $this->NewPostService->destroyMultiple($data);
    }
}
