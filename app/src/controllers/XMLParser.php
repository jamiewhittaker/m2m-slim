<?php

namespace App\Controllers;
use App\Models\CircuitStatus;
use Exception;


/**
 * The XMLParser class takes an array of messages fetched from the SOAP server and
 * runs them through a foreach to add messages with our 'ID' tag (circuit123 for test purposes)
 * to a new array. The newest message is then taken from the new array and split into the
 * circuit status information. A CircuitStatus object is then returned.
 */

class XMLParser
{

    public function parse($messages) {
        $ourMessages = array();

        foreach ($messages as $message) {
            $xml = simplexml_load_string($message) or Die("ERROR"); //1 message in array

            $message = $xml->message;
            $decoded = json_decode($message);

            if (array_key_exists("ID", $decoded)){
                if(($decoded->ID) === SMS_ID){ //if array contains circuit123
                    $msisdn = $xml->sourcemsisdn;
                    $date = $xml->receivedtime;
                    array_unshift($ourMessages, $message);
                }
            }



     } //end of foreach

        $newestMessage = $ourMessages[0];
        $decodedMessage = json_decode($newestMessage);

        $switch1 = $decodedMessage->S1;
        $switch2 = $decodedMessage->S2;
        $switch3 = $decodedMessage->S3;
        $switch4 = $decodedMessage->S4;
        $fan = $decodedMessage->F;
        $temp = $decodedMessage->T;
        $keypad = $decodedMessage->K;
        $firstName = $decodedMessage->FN;
        $secondName = $decodedMessage->SN;
        $email = $decodedMessage->E;

        //SWITCH 1 VALUE
        if ($switch1 == "1") {
            $switch1 = "ON";
        } elseif ($switch1 == "0") {
            $switch1 = "OFF";
        } else {
            throw new Exception("Switch 1 value invalid");
        }


        //SWITCH 2 VALUE
        if ($switch2 == "1") {
            $switch2 = "ON";
        } elseif ($switch2 == "0") {
            $switch2 = "OFF";
        } else {
            throw new Exception("Switch 2 value invalid");
        }


        //SWITCH 3 VALUE
        if ($switch3 == "1") {
            $switch3 = "ON";
        } elseif ($switch3 == "0") {
            $switch3 = "OFF";
        } else {
            throw new Exception("Switch 3 value invalid");
        }


        //SWITCH 4 VALUE
        if ($switch4 == "1") {
            $switch4 = "ON";
        } elseif ($switch4 == "0") {
            $switch4 = "OFF";
        } else {
            throw new Exception("Switch 4 value invalid");
        }


        //FAN VALUE
        if ($fan == "0") {
            $fan = "FORWARD";
        } elseif ($fan == "1") {
            $fan = "REVERSE";
        } else {
            throw new Exception("Fan value invalid");
        }

        $name = "$firstName $secondName";

        $parsed = new CircuitStatus($msisdn, $name, $email, $switch1, $switch2, $switch3, $switch4, $fan, $temp, $keypad, $date);
        return $parsed;

        echo "<br> Switch 1: $switch1, Switch 2: $switch2, Switch 3: $switch3, Switch 4: $switch4, Fan: $fan, Temp: $temp, Keypad: $keypad <br>";


        var_dump($ourMessages);

 }


}