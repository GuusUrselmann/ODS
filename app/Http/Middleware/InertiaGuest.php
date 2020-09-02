<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class InertiaGuest
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
        Inertia::setRootView('layouts.guest.layout');
        Inertia::share('paths', function () {
            return [
                'url' => url(''),
                'asset' => asset('')
            ];
        });
        Inertia::share('user', function() {
            if(Auth::user()) {
                return Auth::user();
            }
            return false;
        });
        return $next($request);
    }
}
