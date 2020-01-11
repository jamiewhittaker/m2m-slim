<?php


namespace App\controllers;

use App\Controllers\UserDatabaseWrapper;
use PDO;

class UserDatabaseValidator
{
   private $input;
   private $error;
   private $database;

   public function __construct()
   {
       $this->input = [];
       $this->error = "";
   }




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
        }
        if (isset($_POST['login'])) {
            $username = $_POST['usernameLogin'];
        }
            try {

                $this->database = new PDO('mysql:host=localhost;dbname=m2m_slim', 'm2mslim', 'DMUcoursework1');
                $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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