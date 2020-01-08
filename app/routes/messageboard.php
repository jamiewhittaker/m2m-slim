<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/messageboard', function(Request $request, Response $response)
{
    return $this->view->render($response, 'messageboard.html.twig');
})->setName('messageboard');