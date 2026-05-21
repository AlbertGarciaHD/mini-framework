<?php

namespace Lume\Http;

use Lume\Server\Server;

class Request
{
    protected string $uri;
    protected HttpMethod $method;
    protected array $data;
    protected array $query;

    public function __construct( Server $server )
    {
        $this->uri = $server->requestUri();
        $this->method = $server->requestMethod();
        $this->data = $server->requestData();
        $this->query = $server->requestParams();
    }

    

    /**
     * Get the value of uri
     */ 
    public function uri() : string
    {
        return $this->uri;
    }

    /**
     * Get the value of method
     */ 
    public function method() : HttpMethod
    {
        return $this->method;
    }

    /**
     * Get the value of data
     */ 
    public function data()
    {
        return $this->data;
    }

    /**
     * Get the value of query
     */ 
    public function query()
    {
        return $this->query;
    }
}
