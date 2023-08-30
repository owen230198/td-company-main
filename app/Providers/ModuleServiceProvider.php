<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        $dir = dirname(__DIR__).'/Modules';
        if (\File::exists($dir)) {
            $list_modules = array_map('basename', \File::directories($dir));
            $segments = $request->segments();
            foreach ($list_modules as $module) {
                if (@$segments[0] == $module) {
                    $path_view = $dir.'/'.$module.'/Views';
                    if (is_dir($path_view)) {
                        $this->loadViewsFrom($path_view, $module);
                    }
                    $path_helper = $dir.'/'.$module.'/helpers';
                    if(is_dir($path_helper)) {
                        foreach (glob($path_helper.'/*.php') as $helper) {
                            require_once($helper);
                        }
                    }
                }
            } 
        }
    }
}
