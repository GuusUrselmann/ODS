<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use App\Branch;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer('adminlte::page', function ($view) {
            $user_branches = Branch::all()->keyBy('id');
            foreach($user_branches as $user_branch) {
                if($user_branch->id == Auth::user()->admin_current_branch()->id) {
                    $user_branches->forget($user_branch->id);

                }
            }
            $view->with('user_branches', $user_branches);
        });
    }
}
