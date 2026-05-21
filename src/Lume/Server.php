<?php

namespace Lume;

class Server
{
    public function requestUri(): string {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    public function requestMethod(): HttpMethod {
        return HttpMethod::from($_SERVER['REQUEST_METHOD']);
    }

    public function requestData(): array {
        return $_POST;
    }

    public function requestParams(): array {
        return $_GET;
    }
}
