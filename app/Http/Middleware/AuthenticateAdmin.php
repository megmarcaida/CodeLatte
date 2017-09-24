<?php

namespace App\Http\Middleware;

use Closure;


use Auth;
class AuthenticateAdmin
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
        if (! Auth::guard('web_admin')->check()) {
            return redirect('/admin/login');
        }

        return $next($request);
    }
}
