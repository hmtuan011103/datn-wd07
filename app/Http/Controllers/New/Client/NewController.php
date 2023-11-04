<?php

namespace App\Http\Controllers\New\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\NewPost;

class NewController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Trang tin tức';
        $data = NewPost::orderBy('created_at', 'DESC')->paginate(4);
        $currentPage = $data->currentPage();
        return view('client.pages.new.index', compact('title', 'data','currentPage'));
    }

    public function detail(Request $request)
    {
        $slug = $request->slug;
        if (isset($slug)) {
            $data = NewPost::where('id', $slug)->first();
            if ($data) {
                $title = $data->title;
                $random = NewPost::where('id','!=', $data->id)
                    ->inRandomOrder()
                    ->orderBy('created_at', 'DESC')
                    ->get();

                return view('client.pages.new.detail', compact('title', 'data', 'random'));
            }
        }
    }
}
