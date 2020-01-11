<?php


namespace App\controllers;

use App\Controllers\UserDatabaseWrapper;
use PDO;

class UserDatabaseValidator
{

   private $database;


    public function validateRegisterInput() {
    $this->input = [$_POST['usernameRegister'], $_POST['passwordRegister']];

    if (!isset($_POST['usernameRegister']) || !isset($_POST['passwordRegister'])) {
        $error = "Please input both a Username and Password to register";
        return $error;
    } else {
        $db = new UserDatabaseWrapper();
        try {
            $db->addUser();
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
    }



    public function validateUserExists()
    {
        $this->database = new PDO('mysql:host=localhost;dbname=m2m_slim', 'm2mslim', 'DMUcoursework1');
        $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_POST['register'])) {
            $username = $_POST['usernameRegister'];
            $password = $_POST['passwordRegister'];

            $statement = "SELECT COUNT(*) FROM `users` WHERE username = :username OR password = :password";
        }
        if (isset($_POST['login'])) {
            $username = $_POST['usernameLogin'];
            $password = $_POST['passwordLogin'];
            $statement = "SELECT COUNT(*) FROM `users` WHERE username = :username AND password = :password";
        }

            try {

                $this->database = new PDO('mysql:host=localhost;dbname=m2m_slim', 'm2mslim', 'DMUcoursework1');
                $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = $this->database->prepare($statement);

                $sql->bindParam(':username', $username);
                $sql->bindParam(':password', $password);

                if ($sql->execute() === false) {

                    throw new exception ("Unable to add users");

                }

                $count = $sql->fetchColumn();

                if ($count > 0) {
                    return true;
                }

                if ($count == 0) {
                    return false;
                }






            } catch (\PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

        }


}