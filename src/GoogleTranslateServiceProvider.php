<?php

declare(strict_types=1);

namespace Datlechin\GoogleTranslate;

use Illuminate\Support\ServiceProvider;

class GoogleTranslateServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(GoogleTranslateClient::class, function () {
            return new GoogleTranslateClient(new GoogleTokenGenerator());
        });

        $this->app->bind(GoogleTranslate::class, function () {
            return new GoogleTranslate(app(GoogleTranslateClient::class));
        });
    }
}
