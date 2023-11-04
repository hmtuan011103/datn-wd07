<?php

namespace App\Http\Controllers\New;

use App\Http\Controllers\Controller;
use App\Services\NewPost\NewPostService;
use Illuminate\Http\Request;

class BaseNewController extends Controller
{
    protected $NewPostService;
    public function __construct(NewPostService $NewPostService){
        $this->NewPostService = $NewPostService;
    }
    
}
