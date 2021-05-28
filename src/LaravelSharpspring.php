<?php

namespace Bitpiler\LaravelSharpspring;

use Illuminate\Support\Facades\Facade;

class LaravelSharpspring extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-sharpspring';
    }
}
