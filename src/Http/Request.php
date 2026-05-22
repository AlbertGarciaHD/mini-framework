<?php

namespace Lume\Http;

use Lume\Server\Server;

/**
 * Parametros que recibe del Cliente al Servidor.
 */

class Request
{
    protected string $uri;
    protected HttpMethod $method;
    protected array $data;
    protected array $query;

    public function __construct(Server $server)
    {
        $this->uri = $server->requestUri();
        $this->method = $server->requestMethod();
        $this->data = $server->requestData();
        $this->query = $server->requestParams();
    }



    /**
     * Get the value of uri
     */
    public function uri(): string
    {
        return $this->uri;
    }

    /**
     * Get the value of method
     */
    public function method(): HttpMethod
    {
        return $this->method;
    }

    /**
     * Summary of data
     * @return array
     */
    public function data(): array
    {
        return $this->data;
    }

    /**
     * Summary of query
     * @return array
     */
    public function query(): array
    {
        return $this->query;
    }
}
