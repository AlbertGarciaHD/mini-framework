<?php

namespace Lume\Http;

use Lume\Routing\Route;

/**
 * Parametros que recibe del Cliente al Servidor.
 */

class Request
{
    /**
     * URI requested by the client
     * @var string
     */
    protected string $uri;
    /**
     * Route matched by URI
     * @var Route
     */
    protected Route $route;
    /**
     * HTTP method by URI
     * @var HttpMethod
     */
    protected HttpMethod $method;
    /**
     * POST data
     * @var array
     */
    protected array $data;
    /**
     * Query Parameters
     * @var array
     */
    protected array $query;

    /**
     * Summary of uri
     * @return string
     */
    public function uri(): string
    {
        return $this->uri;
    }


    /**
     * Set request URI
     * @param string $uri
     * @return self
     */
    public function setUri( string $uri ) :self
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * GEt ROUTE Match by URI of this request.
     * @return Route
     */
    public function route(): Route
    {
        return $this->route;
    }


    /**
     * Set ROUTE for this request
     * @param Route $route
     * @return self
     */
    public function setRoute( Route $route ) :self
    {
        $this->route = $route;
        return $this;
    }

    /**
     * GEt the request HTTP method
     * @return HttpMethod
     */
    public function method(): HttpMethod
    {
        return $this->method;
    }
    /**
     * Set HTTP method
     * @param HttpMethod $method
     * @return Request
     */
    public function setMethod( HttpMethod $method ) : self 
    {
        $this->method = $method;
        return $this;
    }

    /**
     * Get POST data
     * @return array
     */
    public function data(): array
    {
        return $this->data;
    }
    /**
     * Set POST Data
     * @param array $data
     * @return Request
     */
    public function setPostData( array $data ) : self 
    {
        $this->data = $data;
        return $this;
    }
    /**
     * Get All query Parameters
     * @return array
     */
    public function query(): array
    {
        return $this->query;
    }
    /**
     * Set Query Parameters 
     * @param array $query
     * @return Request
     */
    public function setQueryParameters( array $query ) : self 
    {
        $this->query = $query;
        return $this;
    }
}
