<?php

declare(strict_types=1);

namespace TestApp\Routing;

use TestApp\Api\RequestInterface;

class Request implements RequestInterface
{
    private array $server;
    private array $params = [];

    public function __construct()
    {
        $this->server = $_SERVER;
        $this->addParams($this->getQueryParams());
        $this->addParams($_POST);
    }

    public function addParams(array $params): void
    {
        $this->params = array_merge($this->params, $params);
    }

    public function getServer(string $name): mixed
    {
        return $this->server[$name] ?? null;
    }

    public function getUri(): array
    {
        return parse_url($this->getServer('REQUEST_URI'));
    }

    public function getPath(): string
    {
        $uri = $this->getUri();
        return $uri['path'];
    }

    public function getMethod(): string
    {
        return $this->getServer('REQUEST_METHOD');
    }

    public function getParam(string $param): mixed
    {
        return $this->params[$param] ?? null;
    }
    public function getParams(): array
    {
        return $this->params ?? [];
    }
    public function getQuery(): ?string
    {
        $uri = $this->getUri();

        return $uri['query'] ?? null;
    }

    public function getQueryParams(): array
    {
        $query = $this->getQuery();
        $query = $query ?? '';
        $params = [];
        parse_str($query, $params);

        return $params;
    }
}
