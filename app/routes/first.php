<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/hello/{name}', function (Request $request, Response $response, $args) use($container) {
    $name = $request->getAttribute('name');

    $posts = \App\Model\Post::all();

    return $this->view->render($response, 'first.html.twig', [
        'name' => $name,
        'posts' => $posts,
    ]);
});