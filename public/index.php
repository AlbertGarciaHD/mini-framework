<?php

require_once '../vendor/autoload.php';

use Lume\{HttpNotFoundException, Router};

$router = new Router();

$router->get('/test', function () {
    return "Get Ok";
});

$router->post('/test', function () {
    return "Post Ok";
});


try {
    $action = $router->resolve();
    print_r($action());
} catch (HttpNotFoundException $th) {
    print("Not Found");
    http_response_code(404);
}
