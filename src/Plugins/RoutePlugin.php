<?php

declare(strict_types = 1);

namespace Caju\Finance\Plugins;

use Caju\Finance\Interfaces\PluginInterface;
use Caju\Finance\Interfaces\ServiceContainerInterface;
use Aura\Router\RouterContainer;
use Psr\Http\Message\RequestInterface;
use Interop\Container\ContainerInterface;
use Zend\Diactoros\ServerRequestFactory;

class RoutePlugin implements PluginInterface
{
    public function register(ServiceContainerInterface $container)
    {
        $routerContainer = new RouterContainer;

        /* Register route application */
        $map = $routerContainer->getMap();

        /* Indetify route actual */
        $matcher = $routerContainer->getMatcher();

        /* Generate links by register routes */
        $generator = $routerContainer->getGenerator();
        $request = $this->getRequest();

        $container->add('routing', $map);
        $container->add('routing.matcher', $matcher);
        $container->add('routing.generator', $generator);
        $container->add(RequestInterface::class, $request);

        $container->addLazy('route', function (ContainerInterface $container) {
            $matcher = $container->get('routing.matcher');
            $request = $container->get(RequestInterface::class);
            return $matcher->match($request);
        });
    }

    public function getRequest(): RequestInterface
    {
        return ServerRequestFactory::fromGlobals(
            $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
        );
    }
}
