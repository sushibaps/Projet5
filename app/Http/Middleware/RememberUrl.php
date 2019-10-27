<?php

namespace App\Http\Middleware;

use Closure;

class RememberUrl
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->session()->has('url')){
            $url = $request->session()->get('url');
            $request->session()->forget('url');
            return response()->redirectTo($url);
        } else {
            return $next($request);
        }
    }
}
