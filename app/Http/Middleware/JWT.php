<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class JWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = JWTAuth::parseToken()->authenticate();

        echo json_encode($user->getRoleNames());
        echo json_encode($user->getPermissionsViaRoles());
        return $next($request);
    }
}
