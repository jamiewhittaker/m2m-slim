<?php

class SoapWrapper{
    private $client;

    public function __construct()
    {
        $this->client = new SoapClient(WSDL_URL);
    }

    public function getMessages(){
        return $this->client->peekMessages(M2M_USERNAME, M2M_PASSWORD, 10);
        //returns a maximum of 10 messages
    }
}