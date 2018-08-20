<?php

declare(strict_types = 1);

namespace Caju\Finance\Plugins;

use Caju\Finance\Interfaces\PluginInterface;
use Caju\Finance\Interfaces\ServiceContainerInterface;
use Caju\Finance\View\ViewRenderer;
use Caju\Finance\View\Twig\TwigGlobals;
use Interop\Container\ContainerInterface;

class ViewPlugin implements PluginInterface
{
    public function register(ServiceContainerInterface $container)
    {
        $container->addLazy('twig', function (ContainerInterface $container) {
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../../templates');
            $twig = new \Twig_Environment($loader, [
                'debug' => true
            ]);

            $auth = $container->get('auth');
            $generator = $container->get('routing.generator');
            
            $twig->addExtension(new TwigGlobals($auth));
            $twig->addExtension(new \Twig_Extension_Debug);
            
            $twig->addFunction(new \Twig_SimpleFunction('route',
                function (string $name, array $params = []) use ($generator) {
                return $generator->generate($name, $params);
            }));
            return $twig;
        });

        $container->addLazy('view.renderer', function (ContainerInterface $container) {
            $twigEnvironment = $container->get('twig');
            return new ViewRenderer($twigEnvironment);
        });
    }
}
