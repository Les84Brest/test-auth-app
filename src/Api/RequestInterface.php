<?php
declare(strict_types=1);

namespace TestApp\Api;

interface RequestInterface
{
    public function getPath(): string;
    public function getMethod(): string;
    public function getParam(string $param): mixed;
    public function getParams(): array;
    public function getQuery(): ?string;
    public function getQueryParams(): array;
    public function getRequestJSON(): array | null;
}
