<?php

namespace App\Services\TypeUser;

use App\Models\TypeUser as TypeUserModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TypeUserService
{
     protected $typeUser;

     public function __construct(TypeUserModel $typeUserModel)
     {
          $this->typeUser = $typeUserModel;
     }

     public function getAll()
     {
          $typeUsers = $this->typeUser->all();

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
          $typeUsers = $this->typeUser::orderBy('updated_at', 'desc')->paginate($pageSize);

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
          $typeUser = $this->typeUser->find($id);
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
               $typeUser = $this->typeUser->create($data);

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
          $typeUser = $this->typeUser->find($id);

          $response = [
               'message' => 'Lỗi không dõ!',
               'status' => ResponseAlias::HTTP_BAD_GATEWAY
          ];

          if (!$typeUser) {
               $response = [
                    'message' => 'Không tìm thấy!',
                    'status' => ResponseAlias::HTTP_NOT_FOUND
               ];
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
          $typeUser = $this->typeUser->find($id);

          if ($typeUser) {
               return $typeUser->delete();
          }

          return false;
     }
}
