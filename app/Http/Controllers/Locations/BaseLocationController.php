<?php

namespace App\Http\Controllers\Locations;

use App\Http\Controllers\Controller;
use App\Services\Locations\LocationService;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class BaseLocationController extends Controller
{
    // Chứa các hàm chung cho cả admin và client controller
    // Ví dụ code bên dưới:
    // Logic code bên Service
    protected $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
      
    }

    private function successResponse($data, $message)
    {
        return response()->json([
            'data' => $data,
            'message' => $message
        ], ResponseAlias::HTTP_OK);
    }

    private function emptyResponse($message)
    {
        return response()->json([
            'data' => null,
            'message' => $message
        ], ResponseAlias::HTTP_NO_CONTENT);
    }

    private function errorResponse($message)
    {
        return response()->json([
            'message' => $message
        ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
    }

    private function logError($exception, $errorMessage)
    {
        Log::error($errorMessage . ': ' . $exception->getMessage());
    }

    // public function index($data)
    // {
    //     try {
    //         $result = $this->locationService->index();
    //         if ($result) {
    //             return $this->successResponse($result, 'Lấy dữ liệu địa điểm thành công');
    //         }

    //         return $this->emptyResponse('Dữ liệu đang bị trống');
    //     } catch (\Exception $exception) {
    //         $this->logError($exception, 'Có lỗi xảy ra trong phương thức index');
    //         return $this->errorResponse('Xảy ra lỗi khi lấy dữ liệu');
    //     }
    // }


}
