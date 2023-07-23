<?php

namespace App\Weather\Connector;

use App\Weather\Request\Query;
use Symfony\Contracts\HttpClient\ResponseInterface;

interface Connector
{
    public function makeResponse(
        Query $params,
        string $method
    ): ResponseInterface;
}