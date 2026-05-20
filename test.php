<?php 

$route = '/test/{test}/user/{user}';
$parameters = [];

preg_match_all('/\{([a-zA-Z]+)\}/', $route, $parameters);

$parameters = $parameters[1];

$regex = preg_replace('/\{([a-zA-Z]+)\}/', '([a-zA-Z0-9]+)', $route );
$uri = '/test/1/user/2';


$arguments = [];

preg_match("#^$regex$#", $uri, $arguments);

var_dump($arguments);