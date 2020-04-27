<?php

namespace App\Http\Middleware;

use Closure, Auth;

class CheckNullLoginAdmin
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
        if(!Auth::guard('admin')->check()){
            return redirect('quantri/dangnhap');
        }
        return $next($request);
    }
}
