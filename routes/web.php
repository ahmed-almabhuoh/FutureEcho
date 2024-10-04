<?php

use Illuminate\Support\Facades\Route;


Route::get('test', function () {
    dd(generate2FA(1));
});
