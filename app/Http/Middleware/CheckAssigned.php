<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAssigned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth('staff')->user()->bank_id) {
            return redirect()->route('assigned');
        }
        
        return $next($request);
    }


}
