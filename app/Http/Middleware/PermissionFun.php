<?php

namespace App\Http\Middleware;

use Closure;

class PermissionFun
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
        if(!(auth()->user()->tipo === 'fun') || !(auth()->user()->tipo === 'admin') ){
            return redirect()->route('painel.index');
        }
        return $next($request);
    }
}
