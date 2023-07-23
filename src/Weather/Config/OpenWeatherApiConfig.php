<?php

namespace App\Weather\Config;

class OpenWeatherApiConfig
{
    public function __construct(
        private readonly string $url,
        private readonly string $apiKey,
        private readonly string $temperatureFormat,
        private readonly string $language
    ) {}

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @return string
     */
    public function getTemperatureFormat(): string
    {
        return $this->temperatureFormat;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }
}