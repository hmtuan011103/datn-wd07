<?php

namespace App\Services\NewPost;

use App\Http\Requests\NewPost\StoreNewRequest;
use App\Http\Requests\NewPost\UpdateNewRequest;
use App\Models\NewPost;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class NewPostService
{

    public function store(StoreNewRequest $request)
    {
        $model = new NewPost();
        $model->fill($request->all());
        if ($request->hasFile('image')) {
            $model->image = upload_file('new', $request->file('image'));
        }
        $model->save();
        $model->update(['created_at' => now()]);
    }
    public function update( $request, string $id)
    {
        $model = NewPost::query()->findOrFail($id);
        $olbImg = $model->image;
        if ($request->hasFile('image1')) {
            $model->image = upload_file('new', $request->file('image1'));
            delete_file($olbImg);
        }else{
            $model->image = $olbImg;
        }
        $model->fill($request->except('image1'));
        $model->save();
    }
    public function destroy(string $id)
    {
        $model = NewPost::query()->findOrFail($id);
        $model->delete();
    }
    public function destroyMultiple(array $idArray)
    {
        // Validate IDs before performing the delete operation
        $existingIds = NewPost::whereIn('id', $idArray)->pluck('id')->toArray();

        // Check if all IDs in $idArray exist in the database
        if (count($existingIds) !== count($idArray)) {
            // Not all IDs in $idArray exist in the database
            return response()->json(['message' => 'Invalid ID(s) provided.'], ResponseAlias::HTTP_BAD_REQUEST);
        }

        // Start a transaction
        DB::beginTransaction();

        try {
            // Soft delete records with the specified IDs
            NewPost::whereIn('id', $idArray)->delete();

            // Commit the transaction
            DB::commit();

            return response()->json(['message' => 'Type users deleted successfully.'], ResponseAlias::HTTP_OK);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollback();

            // Log the error
            Log::error('Error: ' . $e->getMessage());

            // Return an error response
            return response()->json(['message' => 'An error occurred while deleting type users.'], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
