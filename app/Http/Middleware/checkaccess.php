<?php

namespace App\Http\Middleware;

use Closure;

class checkaccess
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
        if (in_array(env('APP_ID'),explode(',',Auth::user()->access_app))) {
            return $next($request);
        }
        return response()->json(['status'=>'maaf anda tidak memiliki akses ke app ini'], 200);
       
    }
}
