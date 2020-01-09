<?php

namespace App\Models;

class CircuitStatus {

    private $date;
    private $switch1;
    private $switch2;
    private $switch3;
    private $switch4;
    private $fan;
    private $temp;
    private $keypad;

    /**
     * Creates a new {@link CircuitStatus}.
     * @param $date DateTime Date object.
     * @param $switch1 string Status of switch 1.
     * @param $switch2 string Status of switch 2.
     * @param $switch3 string Status of switch 3.
     * @param $switch4 string Status of switch 4.
     * @param $fan string Status of the fan.
     * @param $temp int The temperature.
     * @param $keypad int The number on the keypad.
     */
    public function __construct($date, $switch1, $switch2, $switch3, $switch4, $fan, $temp, $keypad)
    {
        $this->date = $date;
        $this->switch1 = $switch1;
        $this->switch2 = $switch2;
        $this->switch3 = $switch3;
        $this->switch4 = $switch4;
        $this->fan = $fan;
        $this->temp = $temp;
        $this->keypad = $keypad;
    }


    public function getDate(){
        return $this->date;
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
}