<?php
/**
 * Created by PhpStorm.
 * User: RCJ
 * Date: 2017/11/15
 * Time: 17:08
 */

namespace whistle\ocr;

use Illuminate\Support\ServiceProvider;
use whistle\BaseOcr;

class OcrProvider extends ServiceProvider
{
    /**
     * 服务提供者加是否延迟加载.
     *
     * @var bool
     */
    protected $defer = true;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //配置
        $this->publishes([
            __DIR__ . '\src\ocrConfig.php' => config_path('ocrConfig.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Ocr', function ($app) {
            $className = 'whistle\driver\\'.config('ocrConfig.DEFAULT');
            $config = config('ocrConfig.'.config('ocrConfig.DEFAULT'));
            require __DIR__.'/vendor/autoload.php';
            return new BaseOcr(new $className($config));
        });
    }

    public function provides()
    {
        return array('Ocr');
    }
}
