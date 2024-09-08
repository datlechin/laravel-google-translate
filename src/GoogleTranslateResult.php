<?php

declare(strict_types=1);

namespace Datlechin\GoogleTranslate;

use Illuminate\Support\Arr;

class GoogleTranslateResult
{
    protected string $translatedText;

    protected string $sourceLanguage;

    protected array $alternativeTranslations = [];

    public function __construct(protected string $sourceText, protected array $response)
    {
        $this->translatedText = Arr::get($this->response, '0.0.0');
        $this->sourceLanguage = Arr::get($this->response, '2');

        foreach (Arr::get($this->response, '5.0.2', []) as $alternative) {
            $this->alternativeTranslations[] = Arr::get($alternative, '0');
        }
    }

    public function getSourceText(): string
    {
        return $this->sourceText;
    }

    public function getTranslatedText(): string
    {
        return $this->translatedText;
    }

    public function getSourceLanguage(): string
    {
        return $this->sourceLanguage;
    }

    public function getAlternativeTranslations(): array
    {
        return $this->alternativeTranslations;
    }
}
