<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->handleAppConfig();
        Paginator::useBootstrap();
    }

    private function handleAppConfig()
    {
        $config = $this->app['config'];
        $this->configAppData($config);
        $this->configMailData($config);
        $this->app['config'] = $config;
    }

    private function configAppData(&$config)
    {
        $app = $config['app'];
        $app['name'] = getDataConfig('Config', 'APP_NAME', 'Laravel');
        $app['timezone'] =  getDataConfig('Config', 'TIMEZONE', 'Asia/Ho_Chi_Minh');
        $config['app'] = $app;
    }
    
    private function configMailData(&$config)
    {
        $mail = $config['mail'];
        $mail['mailers']['smtp']['host'] = getDataConfig('Config', 'MAIL_HOST', @$mail['host']);
        $mail['mailers']['smtp']['port'] = getDataConfig('Config', 'MAIL_PORT', @$mail['port']);
        $mail['mailers']['smtp']['username'] = getDataConfig('Config', 'MAIL_USERNAME', @$mail['username']);
        $mail['mailers']['smtp']['password'] = getDataConfig('Config', 'MAIL_PASSWORD', @$mail['password']);
        $mail['mailers']['smtp']['encryption'] = getDataConfig('Config', 'MAIL_ENCRYPTION', @$mail['encryption']);
        $config['mail'] = $mail;
    }
}
