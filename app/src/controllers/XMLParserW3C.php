<?php


namespace App\Controllers;
use App\Controllers\SoapWrapper;
use App\Models\CircuitStatus;
use mysql_xdevapi\Exception;
use SimpleXMLElement;
use SimpleXMLIterator;


// MESSAGE FORMAT: ID: circuit123 S1: 1 S2: 1 S3: 0 S4: 1 F: 0 T: 420 K: 6

class XMLParserW3C
{


    public function parse($messages) {
        $ourMessages = array();

        foreach ($messages as $message) {
            $xml = simplexml_load_string($message) or Die("ERROR"); //1 message in array

            $message = $xml->message;

            $exploded = explode(" ", (string)$message); //explode message into array

            if(in_array("circuit123", $exploded)){ //if array contains circuit123
                $msisdn = $xml->sourcemsisdn;
                array_unshift($ourMessages, $message);
            }



     } //end of foreach

        $newestMessage = $ourMessages[0];
        $newestMessageExploded = explode(" ", (string)$newestMessage); //explode newest message into array

        $switch1 = $newestMessageExploded[3];
        $switch2 = $newestMessageExploded[5];
        $switch3 = $newestMessageExploded[7];
        $switch4 = $newestMessageExploded[9];
        $fan = $newestMessageExploded[11];
        $temp = $newestMessageExploded[13];
        $keypad = $newestMessageExploded[15];
        $firstName = $newestMessageExploded[17];
        $secondName = $newestMessageExploded[19];
        $email = $newestMessageExploded[21];

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

        $parsed = new CircuitStatus($msisdn, $name, $email, $switch1, $switch2, $switch3, $switch4, $fan, $temp, $keypad);
        return $parsed;

        echo "<br> Switch 1: $switch1, Switch 2: $switch2, Switch 3: $switch3, Switch 4: $switch4, Fan: $fan, Temp: $temp, Keypad: $keypad <br>";


        var_dump($ourMessages);

 }


}