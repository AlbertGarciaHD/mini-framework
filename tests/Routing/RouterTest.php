<?php

namespace Lume\Tests\Routing;

use Lume\Http\HttpMethod;
use Lume\Http\Request;
use Lume\Routing\Router;
use Lume\Server\Server;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    private function createMockeRequest( string $uri, HttpMethod $httpMethod ) : Request
    {
        $mockServer = $this->getMockBuilder( Server::class )->getMock();
        $mockServer->method('requestUri')->willReturn($uri);
        $mockServer->method('requestMethod')->willReturn($httpMethod);

        return new Request( $mockServer );
    }

    public function test_resolve_basic_route_with_callback_action()
    {
        $uri = '/test';
        $action = fn() => "test";
        $router = new Router();
        $router->get($uri, $action);

        $route = $router->resolve( $this->createMockeRequest( $uri, HttpMethod::GET ) );
        $this->assertEquals($action, $route->action());
        $this->assertEquals($uri, $route->uri());
    }

    public function test_resolve_multiple_basic_route_with_callback_action()
    {
        $routes = [
            '/test' => fn() => 'test',
            '/foo' => fn() => 'foo',
            '/bar' => fn() => 'bas',
            '/long/nested/route' => fn() => 'long nested route',
        ];

        $router = new Router();

        foreach ($routes as $uri => $action) {

            $router->get($uri, $action);
        }

        foreach ($routes as $uri => $action) {
            // $this->assertEquals($action, $router->resolve($uri, HttpMethod::GET->value));
            $route = $router->resolve( $this->createMockeRequest( $uri, HttpMethod::GET ) );
            $this->assertEquals($action, $route->action());
            $this->assertEquals($uri, $route->uri());
        }
    }

    public function test_resolve_multiple_basic_routes_with_callback_action_for_different_http_methods()
    {
        $routes = [
            [HttpMethod::GET, '/test', fn() => 'get'],
            [HttpMethod::POST, '/test', fn() => 'post'],
            [HttpMethod::PATCH, '/test', fn() => 'patch'],
            [HttpMethod::PUT, '/test', fn() => 'put'],
            [HttpMethod::DELETE, '/test', fn() => 'delete'],

            [HttpMethod::GET, '/random/get', fn() => 'get'],
            [HttpMethod::POST, '/random/nested/post', fn() => 'post'],
            [HttpMethod::PATCH, '/random/route/put', fn() => 'patch'],
            [HttpMethod::PUT, '/some/patch/route', fn() => 'put'],
            [HttpMethod::DELETE, '/d', fn() => 'delete'],
        ];

        $router = new Router();

        foreach ($routes as [$method, $uri, $action]) {

            match ($method) {
                HttpMethod::GET => $router->get($uri, $action),
                HttpMethod::POST => $router->post($uri, $action),
                HttpMethod::PUT => $router->put($uri, $action),
                HttpMethod::PATCH => $router->patch($uri, $action),
                HttpMethod::DELETE => $router->delete($uri, $action),
            };
            //otra forma 
            // $router->{ strtolower( $method->value)}( $uri, $action );
        }

        foreach ($routes as [$method, $uri, $action]) {
            // $this->assertEquals($action, $router->resolve($uri, $method->value));
            $route = $router->resolve( $this->createMockeRequest( $uri, $method ) );
            $this->assertEquals($action, $route->action());
            $this->assertEquals($uri, $route->uri());
        }
    }
    // public function testBasicRouting()
    // {
    // $router = new Router();

    // $router->get('/hello', function() {
    //     return 'Hello, World!';
    // });

    // $request = new Request('GET', '/hello');
    // $response = $router->handle($request);

    // $this->assertEquals(200, $response->getStatusCode());
    // $this->assertEquals('Hello, World!', $response->getBody());
    // }

    // public function testRouteParameters()
    // {
    // $router = new Router();

    // $router->get('/user/{id}', function($id) {
    //     return "User ID: $id";
    // });

    // $request = new Request('GET', '/user/42');
    // $response = $router->handle($request);

    // $this->assertEquals(200, $response->getStatusCode());
    // $this->assertEquals('User ID: 42', $response->getBody());
    // }

    // public function testMiddlewareExecution()
    // {
    // $router = new Router();
    // $middlewareStack = new MiddlewareStack();

    // $middlewareStack->add(new class implements MiddlewareInterface {
    //     public function handle(Request $request, callable $next): Response
    //     {
    //         if ($request->getHeader('X-Auth') !== 'secret') {
    //             return new Response(401, [], 'Unauthorized');
    //         }
    //         return $next($request);
    //     }
    // });

    // $router->use($middlewareStack);

    // $router->get('/protected', function() {
    //     return 'Protected Content';
    // });

    // Test unauthorized access
    // $request = new Request('GET', '/protected');
    // $response = $router->handle($request);
    // $this->assertEquals(401, $response->getStatusCode());

    // Test authorized access
    // $request = new Request('GET', '/protected', ['X-Auth' => 'secret']);
    // $response = $router->handle($request);
    // $this->assertEquals(200, $response->getStatusCode());
    // $this->assertEquals('Protected Content', $response->getBody());
    // }
}
