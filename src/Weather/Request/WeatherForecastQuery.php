<?php

namespace App\Weather\Request;

class WeatherForecastQuery implements Query
{
    public function __construct(
        private readonly string $city = '',
        private readonly ?string $temperatureFormat = null,
        private readonly string $language ='',
    ) {}

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string|null
     */
    public function getTemperatureFormat(): ?string
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