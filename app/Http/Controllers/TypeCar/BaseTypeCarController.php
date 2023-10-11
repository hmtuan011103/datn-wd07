<?php

namespace App\Http\Controllers\TypeCar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Typecar\TypeCarService;


class BaseTypeCarController extends Controller
{
    protected $typecarService;

    public function __construct(TypeCarService $typecarService)
    {
        $this->typecarService = $typecarService;
    }
}
