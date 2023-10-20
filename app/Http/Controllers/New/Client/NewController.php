<?php

namespace App\Http\Controllers\New\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\NewPost;

class NewController extends Controller
{
    public function index()
    {
        $title = 'Trang tin tức';
        $data = NewPost::paginate(4);
        return view('client.pages.new.index', compact('title', 'data'));
    }
}
