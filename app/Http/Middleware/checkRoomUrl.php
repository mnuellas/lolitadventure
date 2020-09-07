<?php

namespace App\Http\Middleware;

use Closure;

class checkRoomUrl
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
        if (!isset($request->url)) {
            return redirect('chooseRoom');
        }
        return $next($request);
    }
}
