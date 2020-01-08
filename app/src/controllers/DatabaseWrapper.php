<?php

require_once __DIR__ . 'app/src/models/CircuitStatus.php';
require_once __DIR__ . 'app/src/models/Metadata.php';

class DatabaseWrapper{
    private $database;

    public function connect($database){
        $this->database = new PDO('mysql:host=localhost;dbname=m2m_slim', 'm2mslim', 'DMUcoursework1');
    }

    public function getBoardStatus(){
        $statement = $this->database->prepare('SELECT * FROM board_status');

        if ($statement->execute() == false) {
            throw new Exception('Statement did not execute.');
        }

        $result = $statement->fetch();

        $date = DateTime::createFromFormat('d/m/Y H:i:s', $result['date']);
        $switch1 = $result['switch1'];
        $switch2 = $result['switch2'];
        $switch3 = $result['switch3'];
        $switch4 = $result['switch4'];
        $fan = $result['fan'];
        $temp = (int)$result['temp'];
        $keypad = (int)$result['keypad'];

        $status = new CircuitStatus($date, $switch1, $switch2, $switch3, $switch4, $fan, $temp, $keypad);

        return $status;
    }

    public function updateBoardStatus($msisdn, $status) {
        $date = $status->getDate()->format('d/m/Y H:i:s');
        $switch1 = $status->getSwitch1();
        $switch2 = $status->getSwitch2();
        $switch3 = $status->getSwitch3();
        $switch4 = $status->getSwitch4();
        $fan = $status->getFan();
        $temp = $status->getTemp();
        $keypad = $status->getKeypad();

        $statement = $this->database->prepare(
            'REPLACE INTO board_status
			SET msisdn = :msisdn,
			date = :date,
			switch1 = :switch1,
			switch2 = :switch2,
			switch3 = :switch3,
			switch4 = :switch4,
			fan = :fan,
			temp = :temp,
			keypad = :keypad');

        $statement->bindParam(':msisdn', $msisdn, PDO::PARAM_STR);
        $statement->bindParam(':date', $date, PDO::PARAM_STR);
        $statement->bindParam(':switch1', $switch1, PDO::PARAM_STR);
        $statement->bindParam(':switch2', $switch2, PDO::PARAM_STR);
        $statement->bindParam(':switch3', $switch3, PDO::PARAM_STR);
        $statement->bindParam(':switch4', $switch4, PDO::PARAM_STR);
        $statement->bindParam(':fan', $fan, PDO::PARAM_STR);
        $statement->bindParam(':temp', $temp, PDO::PARAM_INT);
        $statement->bindParam(':keypad', $keypad, PDO::PARAM_INT);

        if ($statement->execute() === false) {
            throw new Exception('Statement did not execute.');
        }
    }

    public function getMetadata(){
        $statement = $this->database->prepare('SELECT * FROM metadata_status');

        if ($statement->execute() == false) {
            throw new Exception('Statement did not execute.');
        }

        $result = $statement->fetch();

        $source = $result['source'];
        $simNumber = $result['sim'];
        $name = $result['name'];
        $email = $result['email'];

        $status = new Metadata($source, $simNumber, $name, $email);

        return $status;
    }

    public function updateMetadata($msisdn, $status) {
        $source = $status->getSource();
        $simNumber = $status->getSim();
        $name = $status->getName();
        $email = $status->getEmail();

        $statement = $this->database->prepare(
            'REPLACE INTO metadata
			SET msisdn = :msisdn,
			source = :source,
			simNumber = :simNumber,
			name = :name,
			email = :email
			');
        $statement->bindParam(':msisdn', $msisdn, PDO::PARAM_STR);
        $statement->bindParam(':source', $source, PDO::PARAM_STR);
        $statement->bindParam(':sim', $simNumber, PDO::PARAM_INT);
        $statement->bindParam(':name', $name, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);


        if ($statement->execute() === false) {
            throw new Exception('Statement did not execute.');
        }
    }


}