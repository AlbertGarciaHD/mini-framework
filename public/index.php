<?php
require_once '../vendor/autoload.php';

use Lume\Http\HttpNotFoundException;
use Lume\Routing\Router;
use Lume\Server\PhpNativeServer;
use Lume\Http\Request;
use Lume\Http\Response;

$router = new Router();

$router->get('/test', function () {
    return Response::text('Hola desde Get');
});

$router->post('/test', function () {
    return Response::text("Hola desde Post");
});

$router->post('/data', function ( Request $request) {
    return Response::json([
        'post' => $request->data(),
        'get' => $request->query()
    ]);
});

$router->get('/redirect', function () {
    return Response::redirect('/test');
});


$server = new PhpNativeServer();

try {
    $request = $server->getRequest();
    $route = $router->resolve($request);
    $action = $route->action();
    $response = $action($request);
    $server->sendResponse( $response );

} catch (HttpNotFoundException $th) {
    $server->sendResponse( Response::text("Not Found")->setStatus(404) );
}
