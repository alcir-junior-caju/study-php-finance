<?php

declare(strict_types = 1);

namespace Caju\Finance\Plugins;

use Caju\Finance\Interfaces\PluginInterface;
use Caju\Finance\Interfaces\ServiceContainerInterface;
use Interop\Container\ContainerInterface;
use Caju\Finance\Auth\JasnyAuth;
use Caju\Finance\Auth\Auth;

class AuthPlugin implements PluginInterface
{
    public function register (ServiceContainerInterface $container)
    {
        $container->addLazy('jasny.auth', function (ContainerInterface $container) {
            return new JasnyAuth($container->get('users.repository'));
        });
        $container->addLazy('auth', function (ContainerInterface $container) {
            return new Auth($container->get('jasny.auth'));
        });
    }
}