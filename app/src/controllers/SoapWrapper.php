<?php
/**
 * Constructs a SoapClient object with WSDL_URL to the M2M server
 *
 */

namespace App\Controllers;
use \SoapClient;

class SoapWrapper{
    private $client;

    /**
     * SoapWrapper constructor.
     * @throws \SoapFault
     */

    public function __construct()
    {
        $this->client = new \SoapClient(WSDL_URL);
    }

    /**
     * @return mixed
     * uses the peekMessages() function from the soapclient to view sms
     */

    public function getMessages(){
        return $this->client->peekMessages(M2M_USERNAME, M2M_PASSWORD, 500);
        //returns a maximum of 200 messages
    }


    /**
     * Used to send a string containing the circuit status
     */

    public function sendMessages() {

        /**
         * Retrieving the circuit status from the form's post and stored in variables to be used to create
         * the string which is sent to the server.
         */

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

        /**
         * Creating formatted message to be sent
         */

        $message = "ID: circuit123 S1: $switch1 S2: $switch2 S3: $switch3 S4: $switch4 F: $fan T: $temp K: $keypad";

        var_dump($message);

        /**
         * Sends the message to the M2M server
         */

       $this->client->sendMessage(M2M_USERNAME, M2M_PASSWORD, "+447817814149",$message, false, "SMS");
    }

}