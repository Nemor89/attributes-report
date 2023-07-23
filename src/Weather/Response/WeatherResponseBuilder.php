<?php

namespace App\Weather\Response;

class WeatherResponseBuilder
{
    public static function build(string $content): ApiResponse
    {
        $content = json_decode($content, true);

        return new OpenWeatherApiResponse(
            city: $content['name'] ?? '',
            temperature: $content['main']['temp'] ?? 0,
            description: $content['weather'][0]['description'] ?? ''
        );
    }
}