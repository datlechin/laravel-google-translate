<?php

declare(strict_types=1);

namespace Datlechin\GoogleTranslate;

use Illuminate\Support\Facades\Http;

class GoogleTranslateClient
{
    protected string $url = 'https://translate.google.com/translate_a/single';

    protected array $queryParams = [
        'client' => 'gtx',
        'hl' => 'en',
        'dt' => [
            't',
            'bd',
            'at',
            'ex',
            'ld',
            'md',
            'qca',
            'rw',
            'rm',
            'ss',
        ],
        'sl' => null,
        'tl' => null,
        'q' => null,
        'ie' => 'UTF-8',
        'oe' => 'UTF-8',
        'multires' => 1,
        'otf' => 0,
        'pc' => 1,
        'trs' => 1,
        'ssel' => 0,
        'tsel' => 0,
        'kc' => 1,
        'tk' => null,
    ];

    public function __construct(protected GoogleTokenGenerator $tokenGenerator)
    {
    }

    public function request(string $text, string $source, string $target): array
    {
        $this->queryParams = [
            ...$this->queryParams,
            'tk' => $this->tokenGenerator->generate($text),
            'sl' => $source,
            'tl' => $target,
            'q' => $text,
        ];

        $queryParams = preg_replace('/%5B\d+%5D=/', '=', http_build_query($this->queryParams));

        return Http::get($this->url, $queryParams)->json();
    }
}
