<?php

declare(strict_types=1);

namespace Datlechin\GoogleTranslate;

class GoogleTranslate
{
    protected string $source;

    protected string $target;

    public function __construct(protected GoogleTranslateClient $client)
    {
    }

    public function withSource(string $source): self
    {
        $this->source = $source;

        return $this;
    }

    public function withTarget(string $target): self
    {
        $this->target = $target;

        return $this;
    }

    public function translate(string $text, string $source = null, string $target = null): GoogleTranslateResult
    {
        if ($source) {
            $this->source = $source;
        }

        if ($target) {
            $this->target = $target;
        }

        $response = $this->client->request($text, $this->source, $this->target);

        return new GoogleTranslateResult($text, $response);
    }
}
