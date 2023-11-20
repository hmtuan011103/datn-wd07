<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $requiredPermissions
     * @return mixed
     */
    public function handle($request, Closure $next, ...$requiredPermissions)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $userPermissions = collect();
            if ($user->roles->isNotEmpty()) {
                foreach ($user->roles as $role) {
                    $filteredPermissions = $role->permissions->where('parent_id', '!=', 0)->sortBy('name')->pluck('name');

                    $userPermissions = $userPermissions->merge($filteredPermissions);
                }
            }

            $userPermissions = $userPermissions->toArray();

            // Check if the user has all the specified permissions
            if (count(array_diff($requiredPermissions, $userPermissions)) < 1) {
                return $next($request);
            }
        }

        toastr()->error('Không có quyền truy cập', 'Lỗi');
        return back();
    }
}
