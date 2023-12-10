<?php

namespace App\Http\Controllers\RedisWork;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\Response;

class RedisController extends Controller
{
    public function getDataFromRedis()
    {
        $keys = Redis::keys('*seat-*');
        $data = [];
        foreach ($keys as $key) {
            $keyNew = str_replace("laravel_database_", '', $key);
            $data[$keyNew] = Redis::get($keyNew);
        }
        return response()->json([
            'data' => $data,
        ], Response::HTTP_OK);
    }
}
