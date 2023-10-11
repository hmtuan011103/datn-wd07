<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\UserService;
use App\Services\TypeUser\TypeUserService;

class BaseUserController extends Controller
{
    protected $userService;
    protected $typeUserService;

    public function __construct(UserService $userService, TypeUserService $typeUserService)
    {
        $this->userService = $userService;
        $this->typeUserService = $typeUserService;
    }
}
