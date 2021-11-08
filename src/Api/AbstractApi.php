<?php
declare(strict_types=1);

namespace SmartEmailing\Api;


use GuzzleHttp\Client;
use JetBrains\PhpStorm\Pure;
use Psr\Http\Message\ResponseInterface;
use SmartEmailing\SmartEmailing;
use SmartEmailing\Util\Helpers;
use function rawurlencode;

abstract class AbstractApi
{
    public const METHOD_GET = 'GET';
    public const METHOD_POST = 'POST';
    public const METHOD_PUT = 'PUT';
    public const METHOD_PATCH = 'PATCH';
    public const METHOD_DELETE = 'DELETE';

    protected int $chunkLimit = 500;
    protected const URI_PREFIX = '/api/v3/';

    private Client $client;

    #[Pure]
    public function __construct(SmartEmailing $smartEmailing)
    {
        $this->client = $smartEmailing->getClient();
    }

    protected function get(string $uri, array $params = []): ResponseInterface
    {
        return $this->queryRequest(self::METHOD_GET, $uri, $params);
    }

    protected function post(string $uri, array $params = []): ResponseInterface
    {
        return $this->jsonRequest(self::METHOD_POST, $uri, $params);
    }

    protected function put(string $uri, array $params = []): ResponseInterface
    {
        return $this->jsonRequest(self::METHOD_PUT, $uri, $params);
    }

    protected function patch(string $uri, array $params = []): ResponseInterface
    {
        return $this->jsonRequest(self::METHOD_PATCH, $uri, $params);
    }

    protected function delete(string $uri, array $params = []): ResponseInterface
    {
        return $this->queryRequest(self::METHOD_DELETE, $uri, $params);
    }

    protected function queryRequest(string $method, string $uri, array $params = []): ResponseInterface
    {
        return $this->request($method, $uri, ['query' => $params]);
    }

    protected function jsonRequest(string $method, string $uri, array $params = []): ResponseInterface
    {
        return $this->request($method, $uri, ['json' => $params]);
    }

    protected function request(string $method, string $uri, array $options = []): ResponseInterface
    {
        return $this->getClient()->request(
            $method,
            self::URI_PREFIX . $uri,
            $options
        );
    }

    protected function replaceUrlParameters(string $uri, array $parameters): string
    {
        return Helpers::replaceUrlParameters($uri, $parameters);
    }

    #[Pure]
    protected static function encodePath(string $uri): string
    {
        return rawurlencode($uri);
    }

    protected function getClient(): Client
    {
        return $this->client;
    }

}
