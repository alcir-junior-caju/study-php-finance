<?php

use Caju\Finance\Application;
use Caju\Finance\Plugins\DbPlugin;
use Caju\Finance\Plugins\RoutePlugin;
use Caju\Finance\Plugins\ViewPlugin;
use Caju\Finance\ServiceContainer;
use Psr\Http\Message\RequestInterface;
use Zend\Diactoros\Response;
use Caju\Finance\Plugins\AuthPlugin;

require_once __DIR__ . '/../vendor/autoload.php';
if (file_exists(__DIR__ . '/../.env')) {
    $dotEnv = new \Dotenv\Dotenv(__DIR__ . '/../');
    $dotEnv->overload();
}
require_once __DIR__ . '/../src/helpers.php';

$serviceContainer = new ServiceContainer;
$app = new Application($serviceContainer);

$app->plugin(new RoutePlugin);
$app->plugin(new ViewPlugin);
$app->plugin(new DbPlugin);
$app->plugin(new AuthPlugin);

// $app->get('/', function (RequestInterface $request) {
//     var_dump($request->getUri());
//     die;
//     echo 'Hello World!!!';
// });

// $app->get('/', function (RequestInterface $request) use ($app) {
//     $view = $app->service('view.renderer');
//     return $view->render('test.html.twig', ['name' => 'Junior']);
// });

// $app->get('/{name}', function (ServerRequestInterface $request) use ($app) {
//     $view = $app->service('view.renderer');
//     return $view->render('test.html.twig', ['name' => $request->getAttribute('name')]);
// });

$app->get('/home/{name}', function (ServerRequestInterface $request) {
    // echo 'Home!!!<br />';
    // echo $request->getAttribute('name');
    $response = new Response;
    $response->getBody()->write('Response com emitter do diactoros');
    return $response;
});

require_once '../src/controllers/category-costs.php';
require_once '../src/controllers/bill-receives.php';
require_once '../src/controllers/bill-pays.php';
require_once '../src/controllers/users.php';
require_once '../src/controllers/auth.php';
require_once '../src/controllers/statements.php';
require_once '../src/controllers/charts.php';

$app->start();
