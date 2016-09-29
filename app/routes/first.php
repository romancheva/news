<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

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

$app->get('/hello/{name}', function (Request $request, Response $response, $args) {
    $name = $request->getAttribute('name');
    return $this->view->render($response, 'first.html.twig', [
        'name' => $name
    ]);
});
$app->run();