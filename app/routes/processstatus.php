<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/processstatus', function(Request $request, Response $response) use ($app){

    $status = getStatus($app);

    return $this->view->render($response, 'status.html.twig',[
        'switch1' => $status->getSwitch1(),
        'switch2' => $status->getSwitch2(),
        'switch3' => $status->getSwitch3(),
        'switch4' => $status->getSwitch4(),
        'fan' => $status->getFan(),
        'temp' => $status->getTemp(),
        'keypad' => $status->getKeypad(),
        'date' => $status->getDate()
    ]);
});

function getStatus($app){
    $statusController = $app->getContainer()->get('statusController');
    $statusController->fetchStatus();
    $status = $statusController->returnStatus();
    return $status;
}