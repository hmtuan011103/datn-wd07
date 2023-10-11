<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('trips')->insert([
            'car_id'=>1,
            'user_id'=>1,
            'start_date'=>'2023-11-03',
            'start_time'=>'7:00',
            'start_location'=>'Hà Nội',
            'status'=>'bình thường',
            'trip_price'=>'200.000',
            'end_location'=>'Thanh Hóa',

        ]);
    }
}
