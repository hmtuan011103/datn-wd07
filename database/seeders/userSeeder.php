<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'user_type_id'=> 1,
            'email'=>'nam@gmail.com',
            'name'=>'ĐỖ Nam',
            'password'=>'nam20003',
            'phone_number'=>'09899999',
            'address'=>'Thanh Hóa',
            'description'=>'hihi'
        ]
       
    );
    }
}
