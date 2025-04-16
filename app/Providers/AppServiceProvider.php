<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    View::composer('*', function ($view) {
        if (Auth::check()) {
            $unseenCount = DB::table('ch_messages')
                ->where('to_id', Auth::id())
                ->where('seen', 0)
                ->count();

            $view->with('unseenCounter', $unseenCount);
        } else {
            $view->with('unseenCounter', 0); // éviter les erreurs
        }
    });
}
}
