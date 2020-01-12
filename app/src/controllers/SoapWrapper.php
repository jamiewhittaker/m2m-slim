<?php
/**
 * Constructs a SoapClient object with WSDL_URL to the M2M server
 *
 */

namespace App\Controllers;
use \SoapClient;
use \Exception;

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
        //returns a maximum of 500 messages
    }


    /**
     * Used to send a string containing the circuit status
     */

    public function sendMessages() {

        /**
         * Retrieving the circuit status from the form's post and stored in variables to be used to create
         * the string which is sent to the server.
         */

        $firstName = $_POST['firstname'];
        $surname = $_POST['surname'];
        $email= $_POST['email'];
        $switch1=  $_POST['switch1'];
        $switch2=  $_POST['switch2'];
        $switch3= $_POST['switch3'];
        $switch4= $_POST['switch4'];
        $fan= $_POST['fan'];
        $temp= $_POST['temp'];
        $keypad= $_POST['keypad'];


        /**
         * First Name must not contain " " character else throws exception
         */
        if (strpos($firstName, " ") !== false){
            throw new Exception("Invalid first name, contains space character");
        }

        /**
         * First Name must not be empty else throws exception
         */
        if(strlen($firstName)===0){
            throw new Exception("First Name field is empty");
        }


        /**
         * Surname must not contain " " character else throws exception
         */
        if (strpos($surname, " ") !== false){
            throw new Exception("Invalid surname, contains space character");
        }


        /**
         * Surname must not be empty else throws exception
         */
        if(strlen($surname)===0){
            throw new Exception("Surname field is empty");
        }


        /**
         * Surname must not contain " " character else throws exception
         */
        if (strpos($email, " ") !== false){
            throw new Exception("Invalid email, contains space character");
        }

        /**
         * Email must contain "@" character else throws exception
         */
        if (strpos($email, "@") !== false){

        } else {
            throw new Exception("Invalid email, does not contain @ character");
        }


        /**
         * Email must contain "." character else throws exception
         */
        if (strpos($email, ".") !== false){

        } else {
            throw new Exception("Invalid email, does not contain . character");
        }

        /**
         * Email must not be empty else throws exception
         */
        if(strlen($firstName)===0){
            throw new Exception("Email field is empty");
        }

        /**
         * Heater temperature must be 3 or less throws exception
         */
        if(strlen($temp)>3){
            throw new Exception("Heater temperature must only be 3 or less digits");
        }

        if(strlen($keypad)>1){
            throw new Exception("Keypad input must only be 1 digit");
        }




        /**
         * Creating formatted message to be sent
         */

        $message = "ID: circuit123 S1: $switch1 S2: $switch2 S3: $switch3 S4: $switch4 F: $fan T: $temp K: $keypad FN: $firstName SN: $surname E: $email";

        var_dump($message);


        /**
         * Sends the message to the M2M server
         */

       $this->client->sendMessage(M2M_USERNAME, M2M_PASSWORD, "+447817814149",$message, false, "SMS");
    }

}
