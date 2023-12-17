<?php

namespace App\Http\Controllers\Trip\Admin;

use App\Imports\ImportDataTrip;
use App\Http\Controllers\Trip\BaseTripController;
use App\Http\Requests\Trip\StoreTripRequest;
use App\Models\Trip;
use App\Models\TypeUser;
use DateInterval;
use DateTime;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Comments;

class TripController extends BaseTripController
{
    public function list_trip(Request $request)
    {
        // $trips = Trip::all();
        $trips = $this->tripService->list_desc($request);
        return view('admin.pages.trip.main',  compact('trips'), [

            'title' => 'Danh sách chuyến đi'
        ]);
    }

    public function form_create_trip(Request $request)
    {
        $routes = $this->tripService->getRoute();
        // $data = $this->tripService->getcarDriveAssistant($request);
        // dd($data);
        return view('admin.pages.trip.create', [
            'routes' => $routes, // Bạn cần đưa biến $routes vào trong mảng này
            'userDrive' => [],
            'cars' => [],
            'assistantCar' => [],
            'title' => 'Thêm chuyến đi'
        ]);
    }

    public function create_trip(StoreTripRequest $request)
    {
        $this->tripService->create($request);
        toastr()->success('Thêm thành công.', 'Thành công');
        return redirect()->route('form_create_trip');
    }

    public function edit_trip($id)
    {

        $trip = Trip::find($id);
        $cars = $this->tripService->getCar($id);
        // dd($cars);
        $userDrive = $this->tripService->getDrive($id);
        $assistantCar = $this->tripService->assistantCar($id);
        $routes = $this->tripService->getRoute();

        $locations = $this->tripService->get_parent_id();
        return view('admin.pages.trip.edit', compact('trip', 'routes', 'cars', 'userDrive', 'assistantCar'), [
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

    public function import_trip(Request $request)
    {
        $path = $request->file('file-trip-excel')->getRealPath();
        Excel::import(new ImportDataTrip, $path);
        toastr()->success('Thêm dữ liệu thành công.', 'Thành công');
        return back();
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
    public function show_comment($id)
    {
        $comments = Comments::where('trip_id', $id)->get();
        return response()->json(['comments' => $comments]);
    }

    public function schedule()
    {
        $id_user = Auth::user()->id;
        $id_type_user = Auth::user()->user_type_id;
        $type_user = TypeUser::where('id', $id_type_user)->first();
        if ($type_user->id === 4) {
            $title = 'Lịch trình dành cho ' . $type_user->name;
            $trip = Trip::select('id', 'start_date', 'start_time', 'start_location', 'end_location', 'interval_trip')->where('drive_id', '=', $id_user)->get();
        }
        if ($type_user->id === 5) {
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
            if ($type_user->id === 4) {
                $title = 'Lịch trình dành cho ' . $type_user->name;
                $trip = Trip::select('id', 'start_date', 'start_time', 'start_location', 'end_location', 'interval_trip')->where('drive_id', '=', $id_user)->get();
            }
            if ($type_user->id === 5) {
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
        $html = view('admin.pages.schedule.excel', compact('title', 'trip', 'type_user'))->render();
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream('example.pdf');
    }

    public function getCarDriver(Request $request)
    {
        $data = $this->tripService->getcarDriveAssistant($request);
        return response()->json([
            'cars' => $data['cars'],
            'userDrive' => $data['drivers'],
            'assistantCar' => $data['assistants'],
        ]);
    }

    public function get_available_drivers(Request $request)
    {
        $data = $this->tripService->getcarDriveAssistant($request);
        return response()->json([
            'car' => $data['cars'],
            'userDriver' => $data['drivers'],
            'assistantCars' => $data['assistants'],
        ]);
    }

}
