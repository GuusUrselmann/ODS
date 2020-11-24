<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Option;
use App\Branch;

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
        Inertia::share('order_type', function () {
            return session('order_type');
        });
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
        Inertia::share('options', function() {
            return [
                'website_title' => Option::where('name', 'website_title')->first() ? Option::where('name', 'website_title')->first()->value : 'ODS',
                'header_title' => Option::where('name', 'header_title')->first() ? Option::where('name', 'header_title')->first()->value : ' ',
                'website_logo' => Option::where('name', 'website_logo')->first() ? Option::where('name', 'website_logo')->first()->value : ' ',
                'home_background' => Option::where('name', 'home_background')->first() ? Option::where('name', 'home_background')->first()->value : ' ',
            ];
        });
        Inertia::share('branch', function() {
            return Branch::with('contactInformation')->find(1);
        });
        return $next($request);
    }
}
