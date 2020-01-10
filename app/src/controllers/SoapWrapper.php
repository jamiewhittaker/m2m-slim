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


    public function sendMessages() {

        

        $msisdn = $_POST['msisdn'];
        $name = $_POST['name'];
        $email= $_POST['email'];
        $switch1=  $_POST['switch1'];
        $switch2=  $_POST['switch2'];
        $switch3= $_POST['switch3'];
        $switch4= $_POST['switch4'];
        $fan= $_POST['fan'];
        $temp= $_POST['temp'];
        $keypad= $_POST['keypad'];

        $message = "ID: circuit123 S1: $switch1 S2: $switch2 S3: $switch3 S4: $switch4 F: $fan T: $temp K: $keypad";

        var_dump($message);

       $this->client->sendMessage(M2M_USERNAME, M2M_PASSWORD, "+447817814149",$message, false, "SMS");
    }

}