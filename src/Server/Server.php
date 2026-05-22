<?php

namespace Lume\Server;

use Lume\Http\HttpMethod;
use Lume\Http\Response;

/**
 * INTERFACE DE SERVIDOR
 */
interface Server
{
    /**
     * Summary of requestUri
     * @return array|bool|int|string|null
     */
    public function requestUri(): string;
    /**
     * Summary of requestMethod
     * @return HttpMethod
     */
    public function requestMethod(): HttpMethod;
    /**
     * Summary of requestData
     * @return array
     */
    public function requestData(): array;
    /**
     * Summary of requestParams
     * @return array
     */
    public function requestParams(): array;
    /**
     * Summary of sendResponse
     * @param Response $response
     * @return void
     */
    public function sendResponse(Response $response);
}
