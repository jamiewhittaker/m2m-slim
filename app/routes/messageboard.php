<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get(
    '/messageboard',
    function(Request $request, Response $response) use ($app)
    {
        return $this->view->render($response,
            'messageboard.html.twig',
            [
                'messages' => [
                    1 =>
                        [
                            'fan_direction' => 'reverse',
                            'temperature' => '65°C',
                            'keypad_number' => '1',
                            'switches' => ['On', 'Off', 'Off', 'On'],
                            'sim_number' => '01234 567890',
                            'name' => 'Micheal Keaton',
                            'email' => 'mkeaton@hollywood.com'
                        ],
                    2 =>
                        [
                            'fan_direction' => 'reverse',
                            'temperature' => '65°C',
                            'keypad_number' => '2',
                            'switches' => ['On', 'Off', 'Off', 'On'],
                            'sim_number' => '01234 567890',
                            'name' => 'Micheal Keaton',
                            'email' => 'longeremailfortest@hollywood.com'
                        ],
                    3 =>
                        [
                            'fan_direction' => 'reverse',
                            'temperature' => '65°C',
                            'keypad_number' => '3',
                            'switches' => ['On', 'Off', 'Off', 'On'],
                            'sim_number' => '01234 567890',
                            'name' => 'Micheal Keaton',
                            'email' => 'mkeaton@hollywood.com'
                        ],
                    4 =>
                        [
                            'fan_direction' => 'reverse',
                            'temperature' => '65°C',
                            'keypad_number' => '4',
                            'switches' => ['On', 'Off', 'Off', 'On'],
                            'sim_number' => '01234 567890',
                            'name' => 'Micheal Keaton',
                            'email' => 'mkeaton@hollywood.com'
                        ],
                    5 =>
                        [
                            'fan_direction' => 'reverse',
                            'temperature' => '65°C',
                            'keypad_number' => '5',
                            'switches' => ['On', 'Off', 'Off', 'On'],
                            'sim_number' => '01234 567890',
                            'name' => 'Micheal Keaton',
                            'email' => 'mkeaton@hollywood.com'
                        ],
                    6 =>
                        [
                            'fan_direction' => 'reverse',
                            'temperature' => '65°C',
                            'keypad_number' => '6',
                            'switches' => ['On', 'Off', 'Off', 'On'],
                            'sim_number' => '01234 567890',
                            'name' => 'Micheal Keaton',
                            'email' => 'mkeaton@hollywood.com'
                        ],
                    7 =>
                        [
                            'fan_direction' => 'reverse',
                            'temperature' => '65°C',
                            'keypad_number' => '7',
                            'switches' => ['On', 'Off', 'Off', 'On'],
                            'sim_number' => '01234 567890',
                            'name' => 'Micheal Keaton',
                            'email' => 'mkeaton@hollywood.com'
                        ],
                    8 =>
                        [
                            'fan_direction' => 'reverse',
                            'temperature' => '65°C',
                            'keypad_number' => '8',
                            'switches' => ['On', 'Off', 'Off', 'On'],
                            'sim_number' => '01234 567890',
                            'name' => 'Micheal Keaton',
                            'email' => 'mkeaton@hollywood.com'
                        ],
                    9 =>
                        [
                            'fan_direction' => 'reverse',
                            'temperature' => '65°C',
                            'keypad_number' => '9',
                            'switches' => ['On', 'Off', 'Off', 'On'],
                            'sim_number' => '01234 567890',
                            'name' => 'Micheal Keaton',
                            'email' => 'mkeaton@hollywood.com'
                        ],
                    10 =>
                        [
                            'fan_direction' => 'reverse',
                            'temperature' => '65°C',
                            'keypad_number' => '0',
                            'switches' => ['On', 'Off', 'Off', 'On'],
                            'sim_number' => '01234 567890',
                            'name' => 'Micheal Keaton',
                            'email' => 'mkeaton@hollywood.com'
                        ]
                ]
            ]);

    });
