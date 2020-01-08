<?php


class metadata
{
    private $source;
    private $simNumber;
    private $name;
    private $email;


    public function __construct($source, $simNumber, $name, $email)
    {
        $this->source = "";
        $this->simNumber = 0;
        $this->name = "";
        $this->email = "";

    }


    public function getSource() {
        return $this->source;
    }

    public function getSim() {
        return $this->simNumber;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

}