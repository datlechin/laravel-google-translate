<?php

namespace Datlechin\GoogleTranslate\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Datlechin\GoogleTranslate\GoogleTranslate source(string $source)
 * @method static \Datlechin\GoogleTranslate\GoogleTranslate target(string $target)
 * @method static \Datlechin\GoogleTranslate\GoogleTranslate withSource(string $source)
 * @method static \Datlechin\GoogleTranslate\GoogleTranslate withTarget(string $target)
 * @method static \Datlechin\GoogleTranslate\GoogleTranslateResult translate(string $text, string|null $source = null, string|null $target = null)
 *
 * @see \Datlechin\GoogleTranslate\GoogleTranslate
 */
class GoogleTranslate extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Datlechin\GoogleTranslate\GoogleTranslate::class;
    }
}
