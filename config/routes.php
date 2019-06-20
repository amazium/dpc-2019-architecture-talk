<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\MiddlewareFactory;

return function (Application $app, MiddlewareFactory $factory, ContainerInterface $container) : void {
    $config = $container->get('config');
    $routes = $config['routes'] ?? [];

    foreach ($routes as $route) {
        if (empty($route['path'])) {
            continue;
        }
        $middleware = $route['middleware'] ?? [];
        if (!is_array($middleware)) {
            $middleware = [ $middleware ];
        }
//        if (empty($route['unsecured'])) {
//            array_unshift($middleware, \Amazium\Kernel\UI\Middleware\IsSecureWebPage::class);
//        }
        $app->route(
            $route['path'],
            $middleware,
            $route['methods'] ?? [ 'GET' ],
            $route['name'] ?? null
        );
    }
};
