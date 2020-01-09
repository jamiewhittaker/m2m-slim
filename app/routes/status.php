<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get(
    '/status',
    function(Request $request, Response $response) use ($app)
    {
        return $this->view->render($response,
            'status.html.twig',
            [
                'fan_direction' => 'reverse',
                'temperature' => '65°C',
                'keypad_number' => '5',
                'switches' => ['On', 'Off', 'Off', 'On'],
                'sim_number' => '01234 567890',
                'name' => 'Micheal Keaton',
                'email' => 'mkeaton@hollywood.com'
            ]);

    });
