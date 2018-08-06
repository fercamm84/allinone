<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::user();
            $user = User::find($user->id);

            foreach($user->roleUsers as $roleUser){
                if($roleUser->role_id == 1){
                    return redirect('/admin');
                }
            }

            return redirect('/');
        }

        return $next($request);
    }
}
