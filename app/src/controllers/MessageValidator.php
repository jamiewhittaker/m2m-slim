<?php

class SMSValidator {
    private $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    private function getValue($key)
    {
        return $this->message[$key];
    }


}