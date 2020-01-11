<?php


namespace App\controllers;

use App\Models\User;
use App\Controllers\UserDatabaseValidator;

use Exception;
use PDO;


class UserDatabaseWrapper
{
    private $database;


    public function addUser()
    {
        try {
            $val = new UserDatabaseValidator();

            if (!$val->validateUserExists()) {


                $this->database = new PDO('mysql:host=localhost;dbname=m2m_slim', 'm2mslim', 'DMUcoursework1');
                $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $username = $_POST['usernameRegister'];
                $password = $_POST['passwordRegister'];


                $sql = $this->database->prepare("INSERT INTO  `users` (username, password) VALUES (:username, :password)");

                $sql->bindParam(':username', $username);
                $sql->bindParam(':password', $password);

                if ($sql->execute() === false) {
                    throw new exception ("Unable to add users");
                }
            } else {
                return "error";
            }
        }

            catch
                (\PDOExcetion $e) {
                    echo "Error: " . $e->getMessage();
                }
            }







    public function checkUserBool()
    {
        $this->database = new PDO('mysql:host=localhost;dbname=m2m_slim', 'm2mslim', 'DMUcoursework1');
        $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_POST['register'])) {
            try {

                $this->database = new PDO('mysql:host=localhost;dbname=m2m_slim', 'm2mslim', 'DMUcoursework1');
                $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $username = $_POST['usernameRegister'];
                $password = $_POST['passwordRegister'];


                $sql = $this->database->prepare("SELECT 1 FROM `users` WHERE username = :username");

                $sql->bindParam(':username', $username);

                if ($sql->execute() === false) {
                    throw new exception ("Unable to add users");
                }
                $row = $sql->fetch(PDO::FETCH_ASSOC);

                if ($row) {
                    return true;
                }

                if (!$row) {
                    return false;
                }

            } catch (\PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

    }

    }
}





