<?php

namespace App\Weather\Connector;

use App\Weather\Config\OpenWeatherApiConfig;
use App\Weather\Request\Query;
use App\Weather\Request\QueryParamsBuilder;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class OpenWeatherConnector implements Connector
{
    public function __construct(
        private readonly OpenWeatherApiConfig $config,
        private readonly HttpClientInterface $httpClient
    ) {}

    /**
     * @throws TransportExceptionInterface
     */
    public function makeResponse(
        Query $params,
        string $method = 'GET'
    ): ResponseInterface
    {
        $queryParams = new QueryParamsBuilder(
            apiKey: $this->config->getApiKey(),
            city: $params->getCity(),
            temperatureFormat: $params->getTemperatureFormat() ?: $this->config->getTemperatureFormat(),
            language: $params->getLanguage() ?: $this->config->getLanguage()
        );

        return $this->httpClient->request(
            method: $method,
            url: $this->config->getUrl(),
            options: $queryParams->toArray()
        );
    }

    /**
     * @return OpenWeatherApiConfig
     */
    public function getConfig(): OpenWeatherApiConfig
    {
        return $this->config;
    }
}