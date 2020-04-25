<?php

namespace App\Providers;

use App\Page;
use App\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        //MENU
        $frontMenu = [
            '/' => 'Home'
        ];
        $pages = Page::all();
        foreach ($pages as $page) {
            $frontMenu[$page['slug']] = $page['title'];
        }
        View::share('front_menu', $frontMenu);

        //CONFIGURAÇÕES
        $config = [];
        $settings = Setting::all();
        foreach ($settings as $setting) {
            $config[$setting['name']] = $setting['content'];
        }
        View::share('front_config', $config);
    }
}
