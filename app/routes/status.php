<?php

use App\Models\CircuitStatus;
use App\Controllers\DatabaseWrapper;
use App\Controllers\SoapWrapper;
use App\Controllers\XMLParserW3C;
use App\Controllers\MessageValidator;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;





$app->get('/status', function(Request $request, Response $response)
{

    $status = new CircuitStatus("+8",  "Kieran",
        "kieran@test", "ON", "OFF", "OFF", "OFF", "forward", 50, 2);

    $msisdn = $status->getMsisdn();
    $name = $status->getName();
    $email = $status->getEmail();
    $switch1 = $status->getSwitch1();
    $switch2 = $status->getSwitch2();
    $switch3 = $status->getSwitch3();
    $switch4 = $status->getSwitch4();
    $fan = $status->getFan();
    $temp = $status->getTemp();
    $keypad = $status->getKeypad();

$soap = new SoapWrapper();

var_dump($soap->getMessages());



    return $this->view->render($response, 'status.html.twig',
        ['msisdn' => $msisdn,
            'name' => $name,
            'email' => $email,
            'switch1' => $switch1,
            'switch2' => $switch2,
            'switch3' => $switch3,
            'switch4' => $switch4,
            'fan' => $fan,
            'temp' => $temp,
            'keypad' => $keypad
        ]);







})->setName('status');






function testDB() {
    $status = new CircuitStatus("+8",  "Kieran",
        "kieran@test", "ON", "OFF", "ON", "OFF", "forward", 50, 2);

    $db = new DatabaseWrapper();




    try {
        $db->insertBoardStatus($status);
    } catch (Exception $e) {
    }


}


