<?php

namespace App\Http\Controllers\Trip\Admin;

use App\Exports\ScheduleExport;
use App\Exports\UserExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Trip\BaseTripController;
use App\Http\Requests\Trip\StoreTripRequest;
use App\Models\Car;
use App\Models\Role;
use App\Models\Trip;
use App\Models\TypeUser;
use App\Models\User;
use App\Models\UserRole;
use Barryvdh\DomPDF\Facade\Pdf;
use DateInterval;
use DateTime;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TripController extends BaseTripController
{
    public function list_trip()
    {
        // $trips = Trip::all();
        $trips = $this->tripService->list_desc();
        return view('admin.pages.trip.main',  compact('trips'), [
            'title' => 'Danh sách chuyến đi'
        ]);
    }

    public function form_create_trip()
    {
        $cars = $this->tripService->getCar();
        $userDrive = $this->tripService->getDrive();
        $assistantCar = $this->tripService->assistantCar();
        $locations = $this->tripService->get_parent_id();
        return view('admin.pages.trip.create', compact('cars', 'userDrive', 'assistantCar', 'locations'), [
            'title' => 'Thêm chuyến đi '
        ]);
    }

    public function create_trip(StoreTripRequest $request)
    {

        $this->tripService->create($request);
        // dd($trip);
        toastr()->success('Thêm thành công.', 'Thành công');
        return redirect()->route('form_create_trip');
    }

    public function edit_trip($id)
    {

        $trip = Trip::find($id);
        $cars = $this->tripService->getCar();
        $userDrive = $this->tripService->getDrive();
        $assistantCar = $this->tripService->assistantCar();
        $locations = $this->tripService->get_parent_id();
        return view('admin.pages.trip.edit', compact('trip', 'userDrive', 'assistantCar', 'cars', 'locations'), [
            'title' => 'Sửa chuyến đi'
        ]);
    }

    public function save_edit_trip(StoreTripRequest $request, $id)
    {
        $this->tripService->edit_trip($request, $id);
        toastr()->success('Sửa thành công.', 'Thành công');
        return redirect()->route('list_trip');
    }

    public function delete_trip($id)
    {
        Trip::find($id)->delete();
        // toastr()->success('Xóa thành công.','Thành công');
        return redirect()->route('list_trip');
    }

    public function show($id)
    {
        $trip = array();
        $trip[] = Trip::find($id);
        $trip[] = Trip::select('trips.*', 'users.name as drive_name')->join('users', 'users.id', '=', 'trips.drive_id')->where('trips.id', '=', $id)->get();
        $trip[] = Trip::select('trips.*', 'users.name as assistantCar_name')->join('users', 'users.id', '=', 'trips.assistantCar_id')->where('trips.id', '=', $id)->get();
        $trip[] = Trip::select('trips.*', 'cars.name as car_name')->join('cars', 'cars.id', '=', 'trips.car_id')->where('trips.id', '=', $id)->get();


        return response()->json(['data' => $trip], 200); // 200 là mã lỗi
    }

    public function schedule()
    {
        $id_user = Auth::user()->id;
        $id_type_user = Auth::user()->user_type_id;
        $type_user = TypeUser::where('id', $id_type_user)->first();
        if ($type_user->name == 'Tài xế') {
            $title = 'Lịch trình dành cho ' . $type_user->name;
            $trip = Trip::select('id', 'start_date', 'start_time', 'start_location', 'end_location', 'interval_trip')->where('drive_id', '=', $id_user)->get();
        }
        if ($type_user->name == 'Phụ xe') {
            $title = 'Lịch trình dành cho ' . $type_user->name;
            $trip = Trip::select('id', 'start_date', 'start_time', 'start_location', 'end_location', 'interval_trip')->where('assistantCar_id', '=', $id_user)->get();
        }
        return view('admin.pages.schedule.index', compact('title', 'trip', 'type_user'));
    }

    public function export()
    {
        if (Auth::user()->id) {
            $id_user = Auth::user()->id;
            $id_type_user = Auth::user()->user_type_id;
            $type_user = TypeUser::where('id', $id_type_user)->first();
            // $trip = Trip::select('id', 'start_date', 'start_time', 'start_location', 'end_location', 'interval_trip')->where('drive_id', '=', $id_user)->get();
            // $title = 'Lịch trình dành cho ' . $type_user->name;
            if ($type_user->name == 'Tài xế') {
                $title = 'Lịch trình dành cho ' . $type_user->name;
                $trip = Trip::select('id', 'start_date', 'start_time', 'start_location', 'end_location', 'interval_trip')->where('drive_id', '=', $id_user)->get();
            }
            if ($type_user->name == 'Phụ xe') {
                $title = 'Lịch trình dành cho ' . $type_user->name;
                $trip = Trip::select('id', 'start_date', 'start_time', 'start_location', 'end_location', 'interval_trip')->where('assistantCar_id', '=', $id_user)->get();
            }
            for ($i = 0; $i < count($trip); $i++) {
                $start_time = new DateTime($trip[$i]->start_time);
                $interval_parts = explode(':', $trip[$i]->interval_trip);
                $interval = new DateInterval('PT' . $interval_parts[0] . 'H' . $interval_parts[1] . 'M' . $interval_parts[2] . 'S');
                $result = $start_time->add($interval);
                $end_time = $result->format('H:i:s');
                $trip[$i]->start_date = date('d/m/Y', strtotime($trip[$i]->start_date));
                $trip[$i]->end_time = $end_time;
            }
        } else {
        }
        // return view('admin.pages.schedule.excel', compact('trip'));
        $dompdf = new Dompdf();
        $html = view('admin.pages.schedule.excel', compact('title','trip','type_user'))->render();
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream('example.pdf');
    }
}
