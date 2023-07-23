<?php

namespace App\Weather\Request;

class QueryParamsBuilder
{
    public function __construct(
        private readonly string $apiKey,
        private readonly string $city,
        private readonly string $temperatureFormat,
        private readonly string $language
    ) {}

    public function toArray(): array
    {
        return [
            'query' => [
                'q' => $this->city,
                'units' => $this->temperatureFormat,
                'appid' => $this->apiKey,
                'lang' => $this->language
            ]
        ];
    }
}