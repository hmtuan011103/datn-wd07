<?php

namespace App\Services\User;

use App\Models\Role;
use App\Models\User as UserModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
          $users = $this->model::with('roles')
               ->orderBy('updated_at', 'desc')
               ->orderBy('name', 'desc')
               ->get();

          $response['data'] = $users;
          $response['status'] = ResponseAlias::HTTP_OK;

          if ($users->isEmpty()) {
               $response['message'] = 'No data found';
               $response['status'] = ResponseAlias::HTTP_BAD_REQUEST;
          }
          foreach ($users as $user) {
               $user->user_type = $user->typeUser->name;
               $roles = [];
               foreach ($user->roles as $user_role) {
                    $roles[] = $user_role->name;
               }
               $user->role_name = $roles;
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
          $user->user_type = $user->typeUser->name;

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
          } catch (\Exception $e) {
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

          $user_collect = collect($user);
          $except_matching = count($user_collect['roles']);

          if ($except_matching > 0) {
               // kiem tra so luong role hien tai va so luong update = nhau khong
               $adminRoleId = null;
               if ($except_matching == count($data['roles'])) {
                    // Check each user role against input roles
                    foreach ($user_collect['roles'] as $user_role) {
                         if (in_array($user_role['id'], $data['roles'])) {
                              $except_matching--; // Decrease count for matched roles
                         };

                         if ($user_role['name'] == 'admin') {
                              $adminRoleId = $user_role['id'];
                         }
                    }
               }

               foreach ($user_collect['roles'] as $user_role) {
                    if ($user_role['name'] == 'admin') {
                         $adminRoleId = $user_role['id'];

                         break;
                    }
               }

               if ($adminRoleId) {
                    // kiểm tra số lượng tài khoản role admin > 1 thì cho phép update role tùy ý,
                    // nếu < 2 thì check xem có bỏ quyền admin không => nếu có thì fail update => cần ít nhất 1 account có role admin. 
                    $currentTotalAdminAccount = $this->model::with('roles')
                         ->whereHas('roles', function ($query) {
                              $query->where('name', 'admin');
                         })->count();

                    if ($currentTotalAdminAccount < 2) {
                         $checkUpdateHasAdminRole = in_array($adminRoleId, $data['roles']);

                         if (!$checkUpdateHasAdminRole) {
                              $response = [
                                   'message' => 'Không được bỏ vai trò admin',
                                   'status' => ResponseAlias::HTTP_BAD_GATEWAY
                              ];
                              return response()->json($response, $response['status']);
                         }
                    }
               }

               // If there are unmatched roles, an update is needed
               if ($except_matching > 0) {
                    $isUpdateRole = true;
               }
          } else {
               $isUpdateRole = true;
          }

          // Check if any data other than 'id', 'roles', 'created_at', 'deleted_at', and 'updated_at' has changed
          $formatRecord = $user_collect->except(['id', 'roles', 'created_at', 'updated_at', 'deleted_at']);
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
                         // Set updated_at to current timestamp
                         $user->update(['updated_at' => Carbon::now()]);
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
          } catch (\Exception $e) {
               // Handle other exceptions
               // Log the error and return an error response
               return response()->json(['message' => $e->getMessage(), 'status' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR]);
          }
     }

     public function destroy($id)
     {
          $user = $this->model->find($id);

          if ($user) {
               return $user->delete();
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

     public function getAllRoles()
     {
          $allRole = Role::orderBy('name')->get();

          return collect($allRole);
     }
}
