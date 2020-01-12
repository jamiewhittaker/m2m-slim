<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;



$app->get('/homepage', function(Request $request, Response $response)
{



    return $this->view->render($response, 'homepage.html.twig', ["welcome" => $_SESSION['username']]);
})->setName('/homepage' );