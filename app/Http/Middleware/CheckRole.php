<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $roles = [
            'admin',
            'operator',
            'plts',
            'user'
        ];
        // $roles = array_slice(func_get_args(),3);

        foreach ($roles as $role) {
            $user = Auth::user()->roles;
            if (!$user == Auth::check() || $user == $role && Auth::user()->is_active){
                return $next($request);
            }
        }
        abort(403, 'Unauthorized action.');
    }
}
