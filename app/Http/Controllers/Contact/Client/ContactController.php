<?php

namespace App\Http\Controllers\Contact\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Contact\BaseContactController;
use App\Http\Requests\Contact\ContactRequest;
use Illuminate\Http\Request;

class ContactController extends BaseContactController
{
    public function store(ContactRequest $request)
    {
        $this->contactService->add($request);

        return redirect()->route('lien_he');

    }
}
