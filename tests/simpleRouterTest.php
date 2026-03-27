<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . "/../src/level2/simpleRouter.php";

class SimpleRouteTest extends TestCase {
    public function testStoringRoutes() {
        $router = new SimpleRouter();
        $router->get('/test', "result");
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/test';
        $this->assertEquals("result", $router->resolve());
    }
}