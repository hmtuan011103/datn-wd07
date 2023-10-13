<?php

namespace App\Services\User;

use App\Models\Role;
use App\Models\User as UserModel;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
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
          $users = $this->model::orderBy('updated_at', 'desc')->get();

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
          $user = $this->model::with('roles')->find($id);
          $status = $user ? ResponseAlias::HTTP_OK : ResponseAlias::HTTP_BAD_REQUEST;
          $response['status'] = $status;

          if (!$user) {
               $response['message'] = 'Không tìm thấy!';

               return response()->json($response, $status);
          }

          $allRole = $this->getAllRoles();

          $user->role_all = $allRole;

          $roles = [];

          foreach ($user->roles as $role) {
               $roles[] = $role->id;
          }

          $user->role_actived = $roles;

          $response['data'] = $user;

          return response()->json($response, $status);
     }

     public function create($data)
     {
          try {
               // Use a Laravel transaction to ensure data consistency
               DB::transaction(function () use ($data) {
                    // Create a new User record
                    $user = $this->model->create($data);

                    // Attach roles to the newly created user
                    if (isset($data['roles'])) {
                         $user->roles()->attach($data['roles']);
                    }
               });

               $response = [
                    'message' => 'Tạo mới thành công.',
                    'status' => ResponseAlias::HTTP_CREATED,
               ];

               // If the transaction is successful, return a success response
               return response()->json($response, $response['status']);
          } catch (QueryException $e) {
               // Handle database query exception
               // Log the error, rollback the transaction, and return an error response
               DB::rollBack();

               return response()->json(['message' => 'Database error occurred.', 'status' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR]);
          } catch (\Exception $e) {
               // Handle other exceptions
               // Log the error and return an error response
               return response()->json(['message' => $e->getMessage(), 'status' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR]);
          }
     }

     public function update($data, $id)
     {
          $user = $this->model::with('roles')->find($id);

          // Default response data
          $response = [
               'message' => 'Vui lòng thử lại sau.',
               'status' => ResponseAlias::HTTP_BAD_GATEWAY
          ];

          // If the user is not found, return a not found response
          if (!$user) {
               $response = [
                    'message' => 'Không tìm thấy!',
                    'status' => ResponseAlias::HTTP_NOT_FOUND
               ];
               return response()->json($response, $response['status']);
          }

          // format email to lower case
          $data['email'] = strtolower($data['email']);

          // Flags to track if an update is needed
          $isUpdate = false;
          $isUpdateRole = false;

          // Convert user's roles and input roles to collections and compare lengths
          $user_collect = collect($user);
          $user_role_length = count($user_collect['roles']);
          $data_role_length = count($data['roles']);

          // Check if the number of roles has changed
          if ($user_role_length != $data_role_length) {
               $isUpdateRole = true; // If roles count is different, an update is needed
          }

          // If roles count is the same, compare role IDs to identify specific role changes
          if (!$isUpdateRole) {
               $except_matching = $user_role_length;

               // Check each user role against input roles
               foreach ($user_collect['roles'] as $user_role) {
                    if (in_array($user_role['id'], $data['roles'])) {
                         $except_matching--; // Decrease count for matched roles
                    };
               }

               // If there are unmatched roles, an update is needed
               if ($except_matching > 0) {
                    $isUpdateRole = true;
               }
          }

          // Check if any data other than 'id', 'roles', 'created_at', and 'updated_at' has changed
          $formatRecord = $user_collect->except(['id', 'roles', 'created_at', 'updated_at']);
          $formatData = collect($data)->except(['roles']);

          // If there are differences, an update is needed
          if (count($formatRecord->diff($formatData)) > 0) {
               $isUpdate = true;
          }

          // If no update is needed, return a response indicating no changes
          if (!$isUpdate && !$isUpdateRole) {
               $response['message'] = 'Không có gì thay đổi để cập nhật.';

               return response()->json($response, $response['status']);
          }

          // If an update is needed
          try {
               // Use a Laravel transaction to ensure data consistency
               DB::transaction(function () use ($data, $user, $isUpdate, $isUpdateRole) {
                    // Update user roles
                    if ($isUpdateRole) {
                         $user->roles()->sync($data['roles']);
                    }

                    // Update user data
                    if ($isUpdate) {
                         $user->update($data);
                    }
               });

               $response = [
                    'message' => 'Cập nhật thành công.',
                    'status' => ResponseAlias::HTTP_OK,
               ];

               // If the transaction is successful, return a success response
               return response()->json($response, $response['status']);
          } catch (QueryException $e) {
               // Handle database query exception
               // Log the error, rollback the transaction, and return an error response
               DB::rollBack();

               return response()->json(['message' => 'Database error occurred.', 'status' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR]);
          } catch (\Exception $e) {
               // Handle other exceptions
               // Log the error and return an error response
               return response()->json(['message' => $e->getMessage(), 'status' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR]);
          }
     }

     // public function destroy($id)
     // {
     //      $user = $this->model->find($id);

     //      if ($user) {
     //           return $user->delete();
     //      }

     //      return false;
     // }

     public function getAllRoles()
     {
          $allRole = Role::orderBy('name')->get();

          return collect($allRole);
     }
}
