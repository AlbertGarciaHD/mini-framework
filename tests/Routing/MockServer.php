<?php

namespace Lume\Tests\Routing;

use Lume\Http\HttpMethod;
use Lume\Server\Server;

class MockServer implements Server
{
    public function __construct(
        public string $uri,
        public  HttpMethod $method
    )
    {
        $this->uri = $uri;
        $this->method = $method;
    }

    public function requestUri(): string {
        return $this->uri;
    }

    public function requestMethod(): HttpMethod {
        return $this->method;
    }

    public function requestData(): array {
        return [];
    }

    public function requestParams(): array {
        return [];
    }
}
