<?php

namespace App\Http\Controllers\User\Admin;

use App\Http\Controllers\User\BaseUserController;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends BaseUserController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Quản lý người dùng';

        $query = $this->userService->getAllPaginate();

        $data = $query['data'];

        return view('admin.pages.user.index', compact('title', 'data'));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $title = 'Chi tiết người dùng';
        $pageViewInfo = 'admin.pages.user.show';

        $query = $this->userService->show($id);

        if ($query->getData()->status > 203) {
            toastr()->error('Không tồn tại!', 'Thất bại');

            return back();
        }

        $data = $query->getData()->data;

        $allTypeUserData = $this->typeUserService->getAll()->getData()->data;

        return view('admin.pages.user.index', compact('title', 'pageViewInfo', 'data', 'allTypeUserData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm mới người dùng';
        $pageViewInfo = 'admin.pages.user.create';
        $allTypeUserData = $this->typeUserService->getAll()->getData()->data;

        return view('admin.pages.user.index', compact('title', 'pageViewInfo', 'allTypeUserData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $query = $this->userService->create($request->validated());

        // error
        if ($query->getData()->status > 203) {
            toastr()->error('Tạo mới thất bại!', 'Thất bại');
        } else {
            $message = $query->getData()->message;

            toastr()->success($message, 'Thành công');
        }

        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $title = 'Cập nhật người dùng';
        $pageViewInfo = 'admin.pages.user.edit';

        $query = $this->userService->show($id);

        if ($query->getData()->status > 203) {
            toastr()->error('Không tồn tại!', 'Thất bại');

            return back();
        }

        $data = $query->getData()->data;

        $allTypeUserData = $this->typeUserService->getAll()->getData()->data;

        return view('admin.pages.user.index', compact('title', 'pageViewInfo', 'data', 'allTypeUserData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, int $id)
    {
        $query = $this->userService->update($request->validated(), $id);

        // error
        if ($query->getData()->status > 203) {
            toastr()->error('Tạo mới thất bại!', 'Thất bại');

            return back();
        }

        $message = $query->getData()->message;
        toastr()->success($message, 'Thành công');

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $this->userService->destroy($id);
            toastr()->success('Đã xóa!', 'Thành công');
        } catch (\Throwable $th) {
            // error
            toastr()->error('Xóa thất bại!', 'Thất bại');
        }

        return redirect()->route('users.index');
    }
}
