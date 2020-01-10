<?php

namespace App\Controllers;
use \SoapClient;

class SoapWrapper{
    private $client;

    public function __construct()
    {
        $this->client = new \SoapClient(WSDL_URL);
    }

    public function getMessages(){
        return $this->client->peekMessages(M2M_USERNAME, M2M_PASSWORD, 200);
        //returns a maximum of 200 messages
    }
}