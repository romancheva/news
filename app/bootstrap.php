<?php
use Slim\App;

ini_set('display_errors', 'On');

require INC_ROOT.'/vendor/autoload.php';

$config = require INC_ROOT . '/app/config/development.php';
$app = new App($config);

$container = $app->getContainer();

// Register component on container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(INC_ROOT . '/app/views', [
        'debug' => true
    ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container['router'],
        $container['request']->getUri()
    ));
    $view->addExtension(new Twig_Extension_Debug());

    return $view;
};

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = $capsule;

require INC_ROOT."/app/routes/first.php";

$app->run();