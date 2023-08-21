<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ... $roles)
    {
        foreach($roles as $role){
            if ($request->user()->role == $role) {
                return $next($request);
            }
        }
 
        if ($request->user()->role == 'administrasi' || $request->user()->role == 'pemiliktoko' || $request->user()->role == 'gudang' || $request->user()->role == 'pelayantoko'){
            return redirect()
                ->to(route('dashboard'));
        }

        else if ($request->user()->role == 'pelanggan'){
            return redirect()
                ->to(route('piutang'));
        }
    }
}
