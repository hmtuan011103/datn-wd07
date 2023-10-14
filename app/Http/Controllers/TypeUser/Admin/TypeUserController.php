<?php

namespace App\Http\Controllers\TypeUser\Admin;

use App\Http\Controllers\TypeUser\BaseTypeUserController;
use App\Http\Requests\TypeUser\StoreTypeUserRequest;
use Illuminate\Http\Request;

class TypeUserController extends BaseTypeUserController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Quản lý loại người dùng';

        $query = $this->typeUserService->getAll();

        $data = $query->getData()->data;

        return view('admin.pages.type_user.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm mới loại người dùng';
        $pageViewInfo = 'admin.pages.type_user.create';
        $allTypeUserData = $this->typeUserService->getAll()->getData()->data;

        return view('admin.pages.type_user.index', compact('title', 'pageViewInfo', 'allTypeUserData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeUserRequest $request)
    {
        $query = $this->typeUserService->create($request->validated());
        $message = $query->getData()->message;

        // error
        if ($query->getData()->status > 203) {
            toastr()->error($message, 'Thất bại');
        } else {

            toastr()->success($message, 'Thành công');
        }

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $title = 'Cập nhật loại người dùng';
        $pageViewInfo = 'admin.pages.type_user.edit';

        $query = $this->typeUserService->show($id);

        if ($query->getData()->status > 203) {
            toastr()->error('Không tồn tại!', 'Thất bại');

            return back();
        }

        $data = $query->getData()->data;

        $allTypeUserData = $this->typeUserService->getAll()->getData()->data;

        return view('admin.pages.type_user.index', compact('title', 'pageViewInfo', 'data', 'allTypeUserData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTypeUserRequest $request, int $id)
    {
        $query = $this->typeUserService->update($request->validated(), $id);
        $message = $query->getData()->message;

        // error
        if ($query->getData()->status > 203) {
            toastr()->error($message, 'Thất bại');

            return back();
        }

        $message = $query->getData()->message;
        toastr()->success($message, 'Thành công');

        return redirect()->route('type_users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $this->typeUserService->destroy($id);
            toastr()->success('Đã xóa!', 'Thành công');
        } catch (\Throwable $th) {
            // error
            toastr()->error('Xóa thất bại!', 'Thất bại');
        }

        return redirect()->route('type_users.index');
    }

    /**
     * Remove multiple the specified resource from storage.
     */
    public function destroyMultiple(Request $request)
    {
        $data = $request->ids;

        return $this->typeUserService->destroyMultiple($data);
    }
}
