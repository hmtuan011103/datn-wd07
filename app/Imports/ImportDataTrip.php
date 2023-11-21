<?php

namespace App\Imports;

use App\Models\Trip;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportDataTrip implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Trip([
            'car_id' => $row[0],
            'drive_id' => $row[1],
            'assistantCar_id' => $row[2],
            // 'start_date' => $row[3],
            'start_date' =>  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[3]),
            'start_time' =>  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4]),
            'start_location' => $row[5],
            'status' => $row[6],
            'trip_price' => $row[7],
            'end_location' => $row[8],
            'interval_trip' =>  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[9]),
        ]);
    }
}
