<?php

namespace Lume\Routing;

use Closure;

/**
 * CLASE DE RUTA
 */
class Route
{
    /**
     * Summary of uri
     * @var string
     */
    protected string $uri;
    /**
     * Summary of action
     * @var Closure
     */
    protected Closure $action;
    /**
     * Summary of regex
     * @var string
     */
    protected string $regex;
    /**
     * Summary of parameters
     * @var array
     */
    protected array $parameters;

    /**
     * Summary of __construct
     * @param string $uri
     * @param Closure $action
     */
    public function __construct(string $uri, Closure $action)
    {
        $this->uri = $uri;
        $this->action = $action;
        $this->regex = preg_replace('/\{([a-zA-Z]+)\}/', '([a-zA-Z0-9]+)', $uri);
        preg_match_all('/\{([a-zA-Z]+)\}/', $uri, $parameters);
        $this->parameters = $parameters[1];
    }
    /**
     * Summary of uri
     * @return string
     */
    public function uri()
    {
        return $this->uri;
    }

    /**
     * Summary of action
     * @return Closure
     */
    public function action()
    {
        return $this->action;
    }
    /**
     * Summary of matches
     * @param string $uri
     * @return bool
     */
    public function matches(string $uri): bool
    {
        return preg_match("#^$this->regex/?$#", $uri);
    }
    /**
     * Summary of hasParameters
     * @return bool
     */
    public function hasParameters(): bool
    {
        return count($this->parameters) > 0;
    }
    /**
     * Summary of parseParameters
     * @param string $uri
     * @return array
     */
    public function parseParameters(string $uri): array
    {
        preg_match("#^$this->regex$#", $uri, $arguments);
        return array_combine($this->parameters, array_slice($arguments, 1));
    }
}
