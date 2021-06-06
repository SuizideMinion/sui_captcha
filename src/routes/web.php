<?php

Route::group(['namespace' => 'Suizide\Captcha\Http\Controllers'], function () {

    Route::get('captcha', 'CaptchaController@index')->name('captcha');
});
