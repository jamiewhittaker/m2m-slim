<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/updateform', function(Request $request, Response $response){

    return $this->view->render($response, 'updateform.html.twig');

})->setName('updateform');