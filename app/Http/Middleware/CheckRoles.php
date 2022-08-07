<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRol
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $rol)
    {
        if ($rol == 'ADMINISTRADOR' && auth()->user()->id_rol != 1) {
            abort(403);
        }

        if ($rol == 'PROFESIONISTA' && auth()->user()->id_rol != 2) {
            abort(403);
        }

        if ($rol == 'CLIENTE' && auth()->user()->id_rol != 3) {
            abort(403);
        }
        
        return $next($request);
    }
}
