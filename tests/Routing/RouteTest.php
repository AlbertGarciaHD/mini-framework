<?php

namespace Lume\Tests\Routing;

use Lume\Routing\Route;
use PHPUnit\Framework\TestCase;

class RouteTest extends TestCase
{
    public static function routesWithNoParameters()
    {
        return [
            ['/'],
            ['/test'],
            ['/test/nested'],
            ['/test/another/nested'],
            ['/test/another/very/route'],
        ];
    }

    /**
     * Summary of test_regex_with_no_parameters
     * @param string $uri
     * @return void
     * @dataProvider routesWithNoParameters
     */
    public function test_regex_with_no_parameters(string $uri)
    {
        $route = new Route($uri, fn() => 'test');
        $this->assertTrue($route->matches($uri));
        $this->assertFalse($route->matches("$uri/extra/path"));
        $this->assertFalse($route->matches("/some/patch/$uri"));
        $this->assertFalse($route->matches("/random/testing"));
    }

    public static function routesWithParameters()
    {
       return [
        ['/test/{test}', '/test/1', ['test'=> '1']],    
        ['/user/{user}/permisos/{permisos}','/user/1/permisos/2', ['user' => 1, 'permisos'=> 2]],
        ['/show/{user}/user','/show/1/user', ['user' => 1]],
        ['/show/{user}/user','/show/numero1/user', ['user' => 'numero1']],
        ['/show/{user}/user','/show/numeroUno/user', ['user' => 'numeroUno']],
        ['/show/{user}/user/{nombre}','/show/1/user/albert', ['user' => 1, 'nombre' => 'albert']],
       ]; 
    }
    /**
     * Summary of test_regex_with_parameters
     * @param string $definition
     * @param string $uri
     * @return void
     * @dataProvider routesWithParameters
     */
    public function test_regex_with_parameters(string $definition, string $uri)
    {
        $route = new Route($definition, fn() => 'test');
        $this->assertTrue($route->matches($uri));
        $this->assertFalse($route->matches("$uri/extra/path"));
        $this->assertFalse($route->matches("/some/patch/$uri"));
        $this->assertFalse($route->matches("/random/testing"));
    }
    /**
     * Summary of test_parse_parameters
     * @param string $definition
     * @param string $uri
     * @param array $expectedParamenters
     * @return void
     * @dataProvider routesWithParameters
     */
    public function test_parse_parameters(string $definition, string $uri, array $expectedParamenters)
    {
        $route = new Route($definition, fn() => 'test');
        $this->assertTrue($route->hasParameters());
        $this->assertEquals($expectedParamenters, $route->parseParameters( $uri));
    }
    /**
     * Summary of test_regex_on_uri_that_ends_with_slash
     * @param string $uri
     * @return void
     * @dataProvider routesWithNoParameters
     */
    public function test_regex_on_uri_that_ends_with_slash( string $uri )
    {
        $route = new Route($uri, fn() => 'test');
        $this->assertTrue($route->matches("$uri/"));
    }
}
 