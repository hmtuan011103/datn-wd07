<?php

namespace App\Services\User;

use App\Models\User as UserModel;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserService
{
     protected $model;

     public function __construct(UserModel $userModel)
     {
          $this->model = $userModel;
     }

     public function getAll()
     {
          $users = $this->model->all();

          $response['data'] = $users;
          $response['status'] = ResponseAlias::HTTP_OK;

          if ($users->isEmpty()) {
               $response['message'] = 'No data found';
               $response['status'] = ResponseAlias::HTTP_BAD_REQUEST;
          }

          return response()->json($response, $response['status']);
     }

     public function getAllPaginate($pageSize = 10)
     {
          $users = $this->model::orderBy('updated_at', 'desc')->paginate($pageSize);

          $response['data'] = $users;
          $response['status'] = ResponseAlias::HTTP_OK;

          if ($users->isEmpty()) {
               $response['message'] = 'No data found';
               $response['status'] = ResponseAlias::HTTP_BAD_REQUEST;
          }

          return $response;
     }

     public function show($id)
     {
          $user = $this->model->find($id);
          $status = $user ? ResponseAlias::HTTP_OK : ResponseAlias::HTTP_BAD_REQUEST;

          $response = [
               'data' => $user,
               'status' => $status,
          ];

          if (!$user) {
               $response['message'] = 'Không tìm thấy!';
          }

          return response()->json($response, $status);
     }

     public function create($data)
     {
          try {
               // Create a new User record
               $user = $this->model->create($data);

               $response = [
                    'message' => 'Tạo mới thành công.',
                    'data' => $user,
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
          $user = $this->model->find($id);

          $response = [
               'message' => 'Lỗi không dõ!',
               'status' => ResponseAlias::HTTP_BAD_GATEWAY
          ];

          if (!$user) {
               $response = [
                    'message' => 'Không tìm thấy!',
                    'status' => ResponseAlias::HTTP_NOT_FOUND
               ];
               return response()->json($response, $response['status']);
          }

          // Update the User record
          $updateAction = $user->update($data);

          if ($updateAction) {
               $response = [
                    'message' => 'Cập nhật thành công.',
                    'data' => $user,
                    'status' => ResponseAlias::HTTP_OK,
               ];
          }

          return response()->json($response, $response['status']);
     }

     public function destroy($id)
     {
          $user = $this->model->find($id);

          if ($user) {
               return $user->delete();
          }
          return false;
     }
}
