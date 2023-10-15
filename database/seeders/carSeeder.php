<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class carSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cars')->insert([
            'color'=>'Xanh',
            'description'=>'xe uy tín',
            'id_type_car'=>1,
            'image'=>'car.jpg',
            'license_plate'=>'30A 99999',
            'name'=>'Xe Vip1',
            'status'=>'1'
        ]);
    }
}
