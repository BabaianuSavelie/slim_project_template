<?php

require __DIR__ . "/../vendor/autoload.php";

use DI\Container;
use Slim\App;
use Slim\Views\PhpRenderer;
use Illuminate\Database\Capsule\Manager;
use App\Http\Controllers\HomeController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use DI\Bridge\Slim\Bridge;

$container = new Container();

$viewsPath = __DIR__ . "/../resources/views";
$renderer = new PhpRenderer($viewsPath);
$renderer->setLayout("/layouts/layout.php");
$container->set(PhpRenderer::class, $renderer);

$app = Bridge::create($container);
$capsule = new Manager();

$capsule->addConnection(require '../config/settings.php');
$capsule->setAsGlobal();
$capsule->bootEloquent();


require __DIR__ . "/../routes/web.php";

$app->run();
