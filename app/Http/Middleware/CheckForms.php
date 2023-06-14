<?php

namespace App\Http\Middleware;

use Closure;

class CheckForms
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
        if(!$request->apogee && !$request->date){
            return redirect('/home');
        } 
        return $next($request);
    }
}
