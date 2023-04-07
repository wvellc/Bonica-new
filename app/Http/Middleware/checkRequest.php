<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkRequest
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
        if($request->segment(1)){
            //if($request->segment(1) == 'admin'){ return redirect()->route('admin.login'); }
            //if($request->segment(1) == 'logout'){ return redirect()->route('frontend.logout'); }

        }
        return $next($request);
    }
}
