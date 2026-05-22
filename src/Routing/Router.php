<?php

namespace Lume\Routing;

use Closure;
use Lume\Http\HttpMethod;
use Lume\Http\HttpNotFoundException;
use Lume\Http\Request;

/**
 * CLASE DE RUTEO
 */
class Router
{
    /**
     * Summary of routes
     * @var array
     */
    protected array $routes = [];
    /**
     * Summary of __construct
     */
    public function __construct()
    {
        foreach (HttpMethod::cases() as $method) {
            $this->routes[$method->value] = [];
        }
    }
    /**
     * Summary of get
     * @param string $uri
     * @param Closure $action
     * @return void
     */
    public function get(string $uri, Closure $action)
    {
        $this->registerRoute(HttpMethod::GET, $uri, $action);
    }
    /**
     * Summary of post
     * @param string $uri
     * @param Closure $action
     * @return void
     */
    public function post(string $uri, Closure $action)
    {
        $this->registerRoute(HttpMethod::POST, $uri, $action);
    }
    /**
     * Summary of put
     * @param string $uri
     * @param Closure $action
     * @return void
     */
    public function put(string $uri, Closure $action)
    {
        $this->registerRoute(HttpMethod::PUT, $uri, $action);
    }
    /**
     * Summary of patch
     * @param string $uri
     * @param Closure $action
     * @return void
     */
    public function patch(string $uri, Closure $action)
    {
        $this->registerRoute(HttpMethod::PATCH, $uri, $action);
    }
    /**
     * Summary of delete
     * @param string $uri
     * @param Closure $action
     * @return void
     */
    public function delete(string $uri, Closure $action)
    {
        $this->registerRoute(HttpMethod::DELETE, $uri, $action);
    }
    /**
     * Summary of registerRoute
     * @param HttpMethod $method
     * @param string $uri
     * @param Closure $action
     * @return void
     */
    public function registerRoute(HttpMethod $method, string $uri, Closure $action)
    {
        $this->routes[ $method->value ][] = new Route($uri, $action);
    }
    /**
     * Summary of resolve
     * @param Request $request
     * @return Route
     * @throws HttpNotFoundException
     */
    public function resolve(Request $request)
    {
        foreach ($this->routes[ $request->method()->value ] as $route) {
            if ($route->matches($request->uri())) {
                // return $route->getAction();
                return $route;
            }
        }

        throw new HttpNotFoundException();
    }
}
