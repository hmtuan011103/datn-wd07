<?php

namespace App\Services\Contact;

use App\Http\Requests\Contact\ContactRequest;
// use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Contact;

class ContactService
{
    public function add(ContactRequest $request)
    {
        if ($request->isMethod('POST')) {
            $params = $request->all();
            //Alert::success('Success Title', 'Success Message');
             toastr()->success('Cảm ơn bạn đã liên hệ với chúng tôi!', 'Thành Công');
            return Contact::create($params);
        }
    }
}
