<?php
use App\Controllers\DatabaseWrapper;
use App\Models\CircuitStatus;
use App\Controllers\SoapWrapper;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/updateform', function(Request $request, Response $response){

    $soap = new SoapWrapper();
    $soap->sendMessages();


    if (isset($_POST['submit']))  {


    }

    return $this->view->render($response, 'updateform.html.twig');

})->setName('updateform');


$app->post('/updateform', function(Request $request, Response $response) {
    $soap = new SoapWrapper();
    $soap->sendMessages();
    return $this->view->render($response, 'updateform.html.twig');
});





