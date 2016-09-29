<?php
require INC_ROOT.'/vendor/autoload.php';

$app = new \Slim\App;

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

require INC_ROOT."/app/routes/first.php";

$app->run();