<?php


class Metadata
{
    private $source;
    private $simNumber;
    private $name;
    private $email;

    /**
     * Creates a new {@link Metadata}.
     * @param $source string source from message metadata.
     * @param $simNumber int sim number from message metadata.
     * @param $name string name from message metadata
     * @param $email string email from message metadata
     */

    public function __construct($source, $simNumber, $name, $email)
    {
        $this->source = $source;
        $this->simNumber = $simNumber;
        $this->name = $name;
        $this->email = $email;

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