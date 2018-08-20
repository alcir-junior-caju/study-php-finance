<?php

use Caju\Finance\ServiceContainer;
use Caju\Finance\Application;
use Caju\Finance\Plugins\DbPlugin;
use Caju\Finance\Plugins\AuthPlugin;

$serviceContainer = new ServiceContainer;
$app = new Application($serviceContainer);

$app->plugin(new DbPlugin);
$app->plugin(new AuthPlugin);

return $app;