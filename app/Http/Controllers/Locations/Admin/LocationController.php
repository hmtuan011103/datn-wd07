<?php

namespace App\Http\Controllers\Locations\Admin;

use App\Http\Controllers\Locations\BaseLocationController;
use App\Http\Requests\Location\StoreLocationRequest;
use App\Http\Requests\Location\UpdateLocationRequest;
use App\Models\Location;
use Illuminate\Database\Eloquent\Model;

class LocationController extends BaseLocationController
{

    public function list_location()
    {
        $location = $this->locationService->list();
        return view('admin.pages.location.main', [
            'location' => $location,
            'title' => 'Danh sách địa điểm'
        ]);
    }

    public function form_create()
    {
        $location = $this->locationService->list();
        return view('admin.pages.location.create', [
            'location' => $location,
            'title' => 'Thêm địa điểm'
        ]);
    }
    public function create_location(StoreLocationRequest $request)
    {
        $this->locationService->create($request);
        toastr()->success('Thêm thành công.','Thành công');
        return redirect()->route('form_create');
    }

    public function edit_location($id)
    {
        $location = Location::find($id);
        $locations =  $this->locationService->list();
        return view('admin.pages.location.edit', compact('location', 'locations'), [
            'title' => 'Sửa địa điểm'
        ]);
    }

    public function save_edit_location(UpdateLocationRequest $request, $id)
    {
        $this->locationService->update($request, $id);
        toastr()->success('Sửa thành công.','Thành công');
        return redirect()->route('list_location');
    }

    public function delete_location($id)
    {
        Location::find($id)->delete();
        toastr()->success('Xóa thành công.','Thành công');
        return redirect()->route('list_location');
    }
}
