<?php

namespace App\Weather;

use App\Attribute\Cacheable;
use App\Cache\Enum\CacheEngine;
use App\Cache\Enum\CacheStrategy;
use App\Weather\Connector\Connector;
use App\Weather\Request\WeatherForecastQuery;
use App\Weather\Response\ApiResponse;
use App\Weather\Response\WeatherResponseBuilder;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Throwable;

class OpenWeatherGateway
{
    public function __construct(
        private readonly Connector $connector
    ) {}

    /**
     * @throws TransportExceptionInterface
     */
    #[Cacheable(
        cacheEngine: CacheEngine::Redis,
        strategy: CacheStrategy::ReadWrite,
        namespace: 'weather',
        lifeTime: 30,
    )]
    public function getWeatherForecastByCity(string $city): ApiResponse
    {
        $query = new WeatherForecastQuery($city);

        $response = $this->connector->makeResponse($query);

        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw new HttpException(
                statusCode: $response->getStatusCode(),
                message: "Не удалось получить актуальный прогноз погоды для города - $city"
            );
        }

        try {
            return WeatherResponseBuilder::build($response->getContent());
        } catch (Throwable) {
            throw new HttpException(
                statusCode: Response::HTTP_INTERNAL_SERVER_ERROR,
                message: 'Не удалось обработать ответ от погодной службы'
            );
        }
    }
}