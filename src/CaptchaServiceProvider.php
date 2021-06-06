<?php

namespace Suizide\Captcha;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;


class CaptchaServiceProvider extends ServiceProvider
{


    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        Validator::extend('simple_captcha', function($attribute, $value, $parameters)
        {
            return $value == SimpleCaptcha::getAnswer();
        },'Invalid captcha answer');

    }

    public function register()
    {
      //
    }
}
