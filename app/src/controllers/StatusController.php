<?php

namespace App\Controllers;

use \App\Controllers\DatabaseWrapper;
use \App\Controllers\MessageValidator;
use \App\Controllers\SoapWrapper;
use \App\Controllers\XMLParser;
use \App\Models\CircuitStatus;


class StatusController {

    public function fetchStatus() {
        $soapClient = new SoapWrapper();
        $messages = $soapClient->getMessages();

        $database = new DatabaseWrapper();
        $database->connect();

        foreach ($messages as $message) {
            $xmlParser = new XMLParser($message);
            $xmlParser->parse();
            $parsed = $xmlParser->getParsedData();

            $validator = new MessageValidator($parsed);

            try{
                $msisdn = $validator->validateMSISDN();
                $status = $validator->validateStatus();

                $board = $database->updateBoardStatus($msisdn, $status);
            } catch (Exception $e) {
                continue;
            }
        }
    }

    public function returnStatus() {
        $database = new DatabaseWrapper();
        $database->connect();
        $status = $database->getBoardStatus();

        return $status;
    }
}