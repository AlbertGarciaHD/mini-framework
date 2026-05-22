<?php

namespace Lume\Server;

use Lume\Http\HttpMethod;
use Lume\Http\Request;
use Lume\Http\Response;

/**
 * SERVER de PHP NATIVO
 */
class PhpNativeServer implements Server
{
    /**
     * @inheritDoc
     */
    // public function requestUri(): string
    // {
    //     return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    // }
    /**
     * @inheritDoc
     */
    // public function requestMethod(): HttpMethod
    // {
    //     return HttpMethod::from($_SERVER['REQUEST_METHOD']);
    // }
    /**
     * @inheritDoc
     */
    // public function requestData(): array
    // {
    //     return $_POST;
    // }
    /**
     * @inheritDoc
     */
    // public function requestParams(): array
    // {
    //     return $_GET;
    // }

    /**
     * @inheritDoc
     */
    public function getRequest(): Request 
    {
        return (new Request())
            ->setUri(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))
            ->setMethod(HttpMethod::from($_SERVER['REQUEST_METHOD']))
            ->setPostData($_POST)
            ->setQueryParameters($_GET);

    }
    /**
     * @inheritDoc
     */
    public function sendResponse(Response $response)
    {
        header("Content-Type: None");
        header_remove("Content-Type");

        $response->prepare();
        http_response_code($response->status());
        foreach ($response->headers() as $header => $value) {
            header("$header: $value");
        }
        print($response->content());
    }
}
