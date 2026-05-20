<?php

require_once '../vendor/autoload.php';

use Lume\{HttpNotFoundException, Route, Router};

$router = new Router();

$router->get('/test', function () {
    return "Get Ok";
});

$router->post('/test', function () {
    return "Post Ok";
});


try {
    // $action = $router->resolve( $_SERVER["REQUEST_URI"], $_SERVER["REQUEST_METHOD"]);
    // print_r($action());
    $route = new Route('/test/1/user/2', fn() => 'test');
    var_dump($route);
} catch (HttpNotFoundException $th) {
    print("Not Found");
    http_response_code(404);
}
