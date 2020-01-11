<?php

namespace App\Controllers;

use DateTime;
use Exception;
use PDO;
use App\Models\CircuitStatus;



class DatabaseWrapper
{
    private $database;

    public function getBoardStatus()
    {

        $this->database = new PDO('mysql:host=localhost;dbname=m2m_slim', 'm2mslim', 'DMUcoursework1');

        $statement = $this->database->prepare('SELECT * FROM board_status');

        if ($statement->execute() == false) {
            throw new Exception('Statement did not execute.');
        }

        $result = $statement->fetch();

        $msidn = $result['msidn'];
        $date = DateTime::createFromFormat('d/m/Y H:i:s', $result['date']);
        $name = $result['name'];
        $email = $result['email'];
        $switch1 = $result['switch1'];
        $switch2 = $result['switch2'];
        $switch3 = $result['switch3'];
        $switch4 = $result['switch4'];
        $fan = $result['fan'];
        $temp = (int)$result['temp'];
        $keypad = (int)$result['keypad'];

        $status = new CircuitStatus($msidn, $name, $email, $date, $switch1, $switch2, $switch3, $switch4, $fan, $temp, $keypad);

        return $status;
    }


    public function insertBoardStatus($status)
    {

        try {

            $this->database = new PDO('mysql:host=localhost;dbname=m2m_slim', 'm2mslim', 'DMUcoursework1');
            $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $date = date("Y-m-d H:i:s");
            $name = $status->getName();
            $email = $status->getEmail();
            $msisdn = $status->getMsisdn();
            $s1 = $status->getSwitch1();
            $s2 = $status->getSwitch2();
            $s3 = $status->getSwitch3();
            $s4 = $status->getSwitch4();
            $fan = $status->getFan();
            $temp = $status->getTemp();
            $keypad = $status->getKeypad();

            $sql = $this->database->prepare("INSERT INTO `board_status` (date, name, email, msisdn, switch1, switch2, switch3, switch4, fan, temp, keypad)
            VALUES (:date, :email , :name, :msisdn, :switch1, :switch2, :switch3, :switch4, :fan, :temp, :keypad)");

            $sql->bindParam(':date', $date);
            $sql->bindParam(':email', $email);
            $sql->bindParam(':name', $name);
            $sql->bindParam(':msisdn', $msisdn);
            $sql->bindParam(':switch1', $s1);
            $sql->bindParam(':switch2', $s2);
            $sql->bindParam(':switch3', $s3);
            $sql->bindParam(':switch4', $s4);
            $sql->bindParam(':fan', $fan);
            $sql->bindParam(':temp', $temp);
            $sql->bindParam(':keypad', $keypad);


            if (
                $sql->execute() === false) {
                throw new exception("Unable to add to database");
            }

        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    public function insertUser($user)
    {
        try {

            $this->database = new PDO($this->database = new PDO('mysql:host=localhost;dbname=m2m_slim', 'm2mslim', 'DMUcoursework1'));


            $username = $user->getUsername();
            $password = $user->getPassword();


            $sql = $this->database->prepare("INSERT INTO  `users` (username, password) VALUES (:username, :password)");

            $sql->bindParam(':username', $username);
            $sql->bindParam(':password', $password);

            if ($sql->execute() === false) {
                throw new exception ("Unable to add users");
            }


        } catch (\PDOExcetion $e) {
            echo "Error: " . $e->getMessage();
        }


    }
}

