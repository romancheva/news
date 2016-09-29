<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/hello/{name}', function (Request $request, Response $response, $args) {
    $name = $request->getAttribute('name');
    return $this->view->render($response, 'first.html.twig', [
        'name' => $name
    ]);
});