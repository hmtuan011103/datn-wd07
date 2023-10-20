<?php

namespace App\Services\NewPost;

use App\Http\Requests\NewPost\StoreNewRequest;
use App\Http\Requests\NewPost\UpdateNewRequest;
use App\Models\NewPost;

class NewPostService {

    public function store(StoreNewRequest $request){
        $model = new NewPost();
        $model->fill($request->all());
        if ($request->hasFile('image')) {
            $model->image = upload_file('new', $request->file('image'));
        }
        $model->save();
    }
    public function update(UpdateNewRequest $request , string $id){
        $model = NewPost::query()->findOrFail($id);
        $model->fill($request->all());
        if ($request->hasFile('image')) {
            $model->image = upload_file('new', $request->file('image'));
        }
        $model->save();
    }
    public function destroy(string $id)
    {
        $model = NewPost::query()->findOrFail($id);
        $model->delete();

    }
}
