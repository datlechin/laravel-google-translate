<?php

namespace Datlechin\GoogleTranslate\Facades;

use Illuminate\Support\Facades\Facade;

class GoogleTranslate extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Datlechin\GoogleTranslate\GoogleTranslate::class;
    }
}
