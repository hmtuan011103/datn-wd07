<?php

namespace App\Http\Controllers\TypeCar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Typecar\TypeCarService;


class BaseTypeCarController extends Controller
{
    protected $TypeCarService;

    public function __construct(TypeCarService $TypeCarService)
    {
        $this->TypeCarService = $TypeCarService;
    }
}
