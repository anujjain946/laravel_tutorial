<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // age get (query ya form se)
        $age = $request->age;
        if($age < 18){
            return response('You are not allowed to access this page',403);
        }   
        
        return $next($request);
    }
}
