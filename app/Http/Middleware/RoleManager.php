<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if(!Auth::check()){
            return ridirect()->route('login');
        }

        $getUserRole = Auth::user()->$role;

        switch($role){
            case 'admin':
                if($getUserRole == 0){
                    return $next($request);
                }
                break;
            case 'seller':
                if($getUserRole == 1){
                    return $next($request);
                }
                break;    
            case 'customer':
                if($getUserRole == 2){
                    return $next($request);
                }
                break;
        }

        switch($getUserRole){
            case 0:
                return redirect()->route('admin');
            case 1:
                return redirect()->route('seller');
            case 2:
                return redirect()->route('dashboard');
        }
        // If the user role does not match any of the specified roles, redirect to the login page
        return redirect()->route('login');

    }
}
