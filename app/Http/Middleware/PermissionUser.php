<?php

namespace App\Http\Middleware;

use Closure;

class PermissionUser
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
        if((auth()->user()->tipo === 'user') || (auth()->user()->tipo === 'admin') || (auth()->user()->tipo === 'fun') ){
            return $next($request);
        }
        return redirect()->route('painel.index');

    }
}
