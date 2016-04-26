<?php

namespace Mark86092\Recaptcha\Facades;

use Illuminate\Support\Facades\Facade;

class RecaptchaChecker extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'recaptcha.checker';
    }
}
