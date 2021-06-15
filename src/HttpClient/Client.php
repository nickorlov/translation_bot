<?php

namespace App\HttpClient;

use GuzzleHttp\Client as GuzzleClient;
use Psr\Http\Message\ResponseInterface;

class Client
{
    /** @var GuzzleClient */
    private $client;

    public function __construct(array $config = [])
    {
        $this->setClient($config);
    }

    private function setClient(array $config): void
    {
        if (!isset($this->client)) {
            $this->client = new GuzzleClient($config);
        }
    }

    public function request(string $method, $uri = '', array $options = []): ResponseInterface
    {
        return $this->client->request($method, $uri, $options);
    }
}
