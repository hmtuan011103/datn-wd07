<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if ($request->hasHeader('Authorization')) {
            $authorizationHeader = $request->header('Authorization');
            if (preg_match('/Bearer\s+(.*)$/i', $authorizationHeader, $matches)) {
                $requestToken = $matches[1];

                // Kiểm tra đăng nhập dựa trên requestToken
                $user = JWTAuth::toUser($requestToken);

                if ($user) {
                    // Người dùng đã đăng nhập, tiếp tục xử lý yêu cầu
                    return $next($request);
                }
            }
        }

        return response()->json(['message' => 'Unauthorized.'], 401);
    }
}
