<?php

declare(strict_types=1);

namespace Datlechin\GoogleTranslate;

use Illuminate\Support\ServiceProvider;

class GoogleTranslateServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            GoogleTranslateClient::class,
            fn() => new GoogleTranslateClient(new GoogleTokenGenerator())
        );

        $this->app->bind(
            GoogleTranslate::class,
            fn() => new GoogleTranslate(app(GoogleTranslateClient::class))
        );
    }
}
