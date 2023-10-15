<?php

namespace App\Services\TypeUser;

use App\Models\TypeUser as TypeUserModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TypeUserService
{
     protected $model;

     public function __construct(TypeUserModel $typeUserModel)
     {
          $this->model = $typeUserModel;
     }

     public function getAll()
     {
          $typeUsers = $this->model::orderBy('updated_at', 'desc')->get();

          $response['data'] = $typeUsers;
          $response['status'] = ResponseAlias::HTTP_OK;

          if ($typeUsers->isEmpty()) {
               $response['message'] = 'No data found';
               $response['status'] = ResponseAlias::HTTP_BAD_REQUEST;
          }

          return response()->json($response, $response['status']);
     }

     public function getAllPaginate($pageSize = 10)
     {
          $typeUsers = $this->model::orderBy('updated_at', 'desc')->paginate($pageSize);

          $response['data'] = $typeUsers;
          $response['status'] = ResponseAlias::HTTP_OK;

          if ($typeUsers->isEmpty()) {
               $response['message'] = 'No data found';
               $response['status'] = ResponseAlias::HTTP_BAD_REQUEST;
          }

          return $response;
     }

     public function show($id)
     {
          $typeUser = $this->model->find($id);
          $status = $typeUser ? ResponseAlias::HTTP_OK : ResponseAlias::HTTP_BAD_REQUEST;

          $response = [
               'data' => $typeUser,
               'status' => $status,
          ];

          if (!$typeUser) {
               $response['message'] = 'Không tìm thấy!';
          }

          return response()->json($response, $status);
     }

     public function create($data)
     {
          try {
               // Create a new TypeUser record
               $typeUser = $this->model->create($data);

               $response = [
                    'message' => 'Tạo mới thành công.',
                    'data' => $typeUser,
                    'status' => ResponseAlias::HTTP_CREATED,
               ];

               return response()->json($response, $response['status']);
          } catch (\Exception $e) {
               $response = [
                    'message' => 'Lỗi: ' . $e->getMessage(),
                    'status' => ResponseAlias::HTTP_BAD_REQUEST,
               ];

               return response()->json($response, $response['status']);
          }
     }

     public function update($data, $id)
     {
          $typeUser = $this->model->find($id);

          $response = [
               'message' => 'Vui lòng thử lại sau.',
               'status' => ResponseAlias::HTTP_BAD_GATEWAY
          ];

          if (!$typeUser) {
               $response = [
                    'message' => 'Không tìm thấy!',
                    'status' => ResponseAlias::HTTP_NOT_FOUND
               ];
               return response()->json($response, $response['status']);
          }

          // check if nothing change
          $formatRecord = collect($typeUser)->except(['id', 'created_at', 'updated_at', 'deleted_at']);
          if (count($formatRecord->diff($data)) == 0) {
               $response['message'] = 'Không có gì thay đổi để cập nhật.';
               return response()->json($response, $response['status']);
          }

          // Update the TypeUser record
          $updateAction = $typeUser->update($data);

          if ($updateAction) {
               $response = [
                    'message' => 'Cập nhật thành công.',
                    'data' => $typeUser,
                    'status' => ResponseAlias::HTTP_OK,
               ];
          }

          return response()->json($response, $response['status']);
     }

     public function destroy($id)
     {
          $typeUser = $this->model->find($id);

          if ($typeUser) {
               return $typeUser->delete();
          }

          return false;
     }

     public function destroyMultiple(array $idArray)
     {
          // Validate IDs before performing the delete operation
          $existingIds = $this->model::whereIn('id', $idArray)->pluck('id')->toArray();

          // Check if all IDs in $idArray exist in the database
          if (count($existingIds) !== count($idArray)) {
               // Not all IDs in $idArray exist in the database
               return response()->json(['message' => 'Invalid ID(s) provided.'], ResponseAlias::HTTP_BAD_REQUEST);
          }

          // Start a transaction
          DB::beginTransaction();

          try {
               // Soft delete records with the specified IDs
               $this->model::whereIn('id', $idArray)->delete();

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
