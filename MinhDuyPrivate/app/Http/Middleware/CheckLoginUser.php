<?php

namespace App\Http\Middleware;

use Closure, Auth;

class CheckLoginUser
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
        if(Auth::guard('web')->check()){
            return redirect('trang-chu.html');
        }
        return $next($request);
    }
}
