<?php
    require './Router.php';

    $router = new Router();

    $router->get('/test', function () {
        return "Get Ok";
    });

    $router->post('/test', function () {
        return "Get Ok";
    });

   
    try {
         $action = $router->resolve();
        print_r($action());
    } catch (\Throwable $th) {
        print("Not Found");
        http_response_code(404);
    }

