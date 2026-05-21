<?php

namespace Lume\Server;

use Lume\Http\HttpMethod;

interface Server
{
    public function requestUri(): string;

    public function requestMethod(): HttpMethod;

    public function requestData(): array;

    public function requestParams(): array;
}
