<?php

namespace App\Weather\Response;

class OpenWeatherApiResponse implements ApiResponse
{
    public function __construct(
        private readonly string $city,
        private readonly float $temperature,
        private readonly string $description
    ) {}

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return float
     */
    public function getTemperature(): float
    {
        return $this->temperature;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}