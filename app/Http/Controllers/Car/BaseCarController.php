<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\Controller;
use App\Services\Car\CarService;
use App\Services\Typecar\TypeCarService;
use Illuminate\Http\Request;

class BaseCarController extends Controller
{
    protected $CarService;
    public function __construct(CarService $CarService)
    {
        $this->CarService = $CarService;
    }
}
