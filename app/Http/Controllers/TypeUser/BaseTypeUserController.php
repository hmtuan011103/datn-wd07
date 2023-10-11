<?php

namespace App\Http\Controllers\TypeUser;

use App\Http\Controllers\Controller;
use App\Services\TypeUser\TypeUserService;

class BaseTypeUserController extends Controller
{
    protected $typeUserService;

    public function __construct(TypeUserService $typeUserService)
    {
        $this->typeUserService = $typeUserService;
    }
}
