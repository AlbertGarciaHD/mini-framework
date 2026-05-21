<?php
require_once '../vendor/autoload.php';

use Lume\Http\HttpNotFoundException;
use Lume\Routing\Router;
use Lume\Server\PhpNativeServer;
use Lume\Http\Request;

$router = new Router();

$router->get('/test', function () {
    return "Get Ok";
});

$router->post('/test', function () {
    return "Post Ok";
});


try {
    $route = $router->resolve( new Request( new PhpNativeServer() ) );
    $action = $route->action();
    print($action());
    // $route = new Route('/test/1/user/2', fn() => 'test');
    // var_dump($route);
} catch (HttpNotFoundException $th) {
    print("Not Found");
    http_response_code(404);
}
