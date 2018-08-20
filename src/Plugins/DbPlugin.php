<?php

declare(strict_types = 1);

namespace Caju\Finance\Plugins;

use Caju\Finance\Interfaces\PluginInterface;
use Caju\Finance\Interfaces\ServiceContainerInterface;
use Illuminate\Database\Capsule\Manager as Capsule;
use Caju\Finance\Repository\RepositoryFactory;
use Caju\Finance\Repository\StatementRepository;
use Interop\Container\ContainerInterface;
use Caju\Finance\Models\CategoryCost;
use Caju\Finance\Models\BillReceive;
use Caju\Finance\Models\User;
use Caju\Finance\Models\BillPay;
use Caju\Finance\Repository\CategoryCostRepository;

class DbPlugin implements PluginInterface
{
    public function register(ServiceContainerInterface $container)
    {
        $capsule = new Capsule;
        $config = include __DIR__ . '/../../config/db.php';
        $capsule->addConnection($config['default_connection']);
        $capsule->bootEloquent();

        $container->add('repository.factory', new RepositoryFactory);

        $container->addLazy('bill-receives.repository', function (ContainerInterface $container) {
            return $container->get('repository.factory')->factory(BillReceive::class);
        });

        $container->addLazy('bill-pays.repository', function (ContainerInterface $container) {
            return $container->get('repository.factory')->factory(BillPay::class);
        });

        $container->addLazy('category-costs.repository', function () {
            return new CategoryCostRepository;
        });

        $container->addLazy('users.repository', function (ContainerInterface $container) {
            return $container->get('repository.factory')->factory(User::class);
        });

        $container->addLazy('statement.repository', function () {
            return new StatementRepository;
        });
    }
}
