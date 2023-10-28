<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Services\Contact\ContactService;
use Illuminate\Http\Request;

class BaseContactController extends Controller
{
    protected $contactService;

    public function __construct(ContactService $contactService) {
        $this->contactService = $contactService;
    }
}
