<?php
/**
 * Class for circuit board data
 */


namespace App\Models;

class CircuitStatus {
    private $msisdn;
    private $name;
    private $email;
    private $switch1;
    private $switch2;
    private $switch3;
    private $switch4;
    private $fan;
    private $temp;
    private $keypad;
    private $date;

    /**
     * Creates a new {@link CircuitStatus}.
     * @param $switch1 string Status of switch 1.
     * @param $switch2 string Status of switch 2.
     * @param $switch3 string Status of switch 3.
     * @param $switch4 string Status of switch 4.
     * @param $fan string Status of the fan.
     * @param $temp int The temperature.
     * @param $keypad int The number on the keypad.
     */


    public function __construct($msisdn, $name, $email, $switch1, $switch2, $switch3, $switch4, $fan, $temp, $keypad, $date)
    {
    $this->msisdn = $msisdn;
    $this->name = $name;
    $this->email = $email;
    $this->switch1 = $switch1;
    $this->switch2 = $switch2;
    $this->switch3 = $switch3;
    $this->switch4 = $switch4;
    $this->fan = $fan;
    $this->temp = $temp;
    $this->keypad = $keypad;
    $this->date = $date;

    }


    public function getMsisdn() {
        return $this->msisdn;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSwitch1(){
        return $this->switch1;
    }

    public function getSwitch2(){
        return $this->switch2;
    }

    public function getSwitch3(){
        return $this->switch3;
    }

    public function getSwitch4(){
        return $this->switch4;
    }

    public function getFan(){
        return $this->fan;
    }

    public function getTemp(){
        return $this->temp;
    }

    public function getKeypad(){
        return $this->keypad;
    }

    public function getDate(){
        return $this->date;
    }

    public function updateCircuit() {
        if (isset($_POST['name'])) {
            $this->name = $_POST['name'];
        }
        if (isset($_POST['email']) != null) {
            $this->email = $_POST['email'];
        }
        if (isset($_POST['msisdn'])) {
            $this->msisdn = $_POST['msisdn'];
        }

        if (isset($_POST['switch1'])) {
            $this->switch1 = "ON";
        }

        if (!isset($_POST['switch1'])) {
            $this->switch1 = "OFF";
        }

        if (isset($_POST['switch2'])) {
            $this->switch2 = $_POST['switch2'];
        }
        if (isset($_POST['switch3'])) {
            $this->switch3 = $_POST['switch3'];
        }
        if (isset($_POST['switch4'])) {
            $this->switch4 = $_POST['switch4'];
        }
        if (isset($_POST['fan'])) {
            $this->fan = $_POST['fan'];
        }
        if (isset($_POST['temp'])) {
            $this->temp = $_POST['temp'];
        }
        if (isset($_POST['keypad'])) {
            $this->keypad= $_POST['keypad'];
        }
        if (isset($_POST['date'])) {
            $this->date= $_POST['date'];
        }

    }



}