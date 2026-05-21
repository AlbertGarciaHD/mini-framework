<?php

require_once '../vendor/autoload.php';

use Lume\{HttpNotFoundException, Request, Router, Server};

$router = new Router();

$router->get('/test', function () {
    return "Get Ok";
});

$router->post('/test', function () {
    return "Post Ok";
});


try {
    $route = $router->resolve( new Request( new Server() ) );
    $action = $route->action();
    print_r($action());
    // $route = new Route('/test/1/user/2', fn() => 'test');
    // var_dump($route);
} catch (HttpNotFoundException $th) {
    print("Not Found");
    http_response_code(404);
}
