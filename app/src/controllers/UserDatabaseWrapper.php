<?php
/**
 * Used to send the user data to the database
 */

namespace App\controllers;

use App\Models\User;
use App\Controllers\UserDatabaseValidator;

use Exception;
use PDO;


class UserDatabaseWrapper
{
    private $database;


    /**
     * @throws Exception
     * Function connects to the database and runs INSERT query to insert users into the user database.
     */

    public function addUser()
    {
        try {
            $val = new UserDatabaseValidator();

            /**
             * Validates whether the user exists, if the details dont match any records, add the user to the database.
             */
            if (!$val->validateUserExists()) {


                /**
                 * Creates PDO object with connection to the database
                 */
                $this->database = new PDO('mysql:host=localhost;dbname=m2m_slim', 'm2mslim', 'DMUcoursework1');
                $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                /**
                 * Retrieves the username and password filled out in the form and stores as variables to be used in the query
                 */

                $username = $_POST['usernameRegister'];
                $password =  password_hash($_POST['passwordRegister'], PASSWORD_DEFAULT);

                /**
                 * Prepare statement to insert users
                 */

                $sql = $this->database->prepare("INSERT INTO  `users` (username, password) VALUES (:username, :password)");

                $sql->bindParam(':username', $username);
                $sql->bindParam(':password', $password);

                if ($sql->execute() === false) {
                    throw new exception ("Unable to add users");
                }

                /**
                 * if user exists return string
                 */

            } else {
                echo "User already exists";
            }
        }

            catch
                (\PDOExcetion $e) {
                    echo "Error: " . $e->getMessage();
                }
            }




}





