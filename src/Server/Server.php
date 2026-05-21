<?php

namespace Lume\Server;

use Lume\Http\HttpMethod;
use Lume\Http\Response;

interface Server
{
    public function requestUri(): string;

    public function requestMethod(): HttpMethod;

    public function requestData(): array;

    public function requestParams(): array;

    public function sendResponse( Response $response ); 
}
