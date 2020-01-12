<?php
/**
 * Validates user form input and checks if the user already exists on the database.
 */

namespace App\controllers;

use App\Controllers\UserDatabaseWrapper;
use PDO;

class UserDatabaseValidator
{

   private $database;


    /**
     * @return string
     * Checks if the user has inputted their username and password, calls addUser() if the post variables are set. Returns
     * a string containing error message if true.
     */
    public function validateRegisterInput() {


    if (!isset($_POST['usernameRegister']) || !isset($_POST['passwordRegister'])) {
        $error = "Please input both a Username and Password to register";
        return $error;
    } else {
        $db = new UserDatabaseWrapper();
        try {
            /**
             * calls addUser() to add the user to the database
             */

            $db->addUser();
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
    }

    /**
     * @return bool
     * Connects to the database and checks if a user exists.
     */

    public function validateUserExists()
    {

        /**
         * If statements verify which button has been pressed, and sets the statement to be used in the prepare() function.
         */

        if (isset($_POST['register'])) {
            $username = $_POST['usernameRegister'];
            $password = $_POST['passwordRegister'];

            /**
             * SQL statement retrieves the count of rows where either the username or password matches,
             * as we only need to verify the username field to see if a row exists.
             */

            $statement = "SELECT COUNT(*) FROM `users` WHERE username = :username OR password = :password";
        }
        if (isset($_POST['login'])) {
            $username = $_POST['usernameLogin'];
            $password = $_POST['passwordLogin'];

            /**
             * SQL statement retrieves the count of rows where both the username or password matches,
             * as we need to verify both username and password.
             */

            $statement = "SELECT COUNT(*) FROM `users` WHERE username = :username AND password = :password";
        }

            try {
                /**
                 * Create PDO object with connection to database.
                 */

                $this->database = new PDO('mysql:host=localhost;dbname=m2m_slim', 'm2mslim', 'DMUcoursework1');
                $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = $this->database->prepare($statement);

                /**
                 * binding parameters to be used in the sql statement.
                 */

                $sql->bindParam(':username', $username);
                $sql->bindParam(':password', $password);

                if ($sql->execute() === false) {

                    throw new exception ("Unable to add users");

                }

                $count = $sql->fetchColumn();

                /**
                 * If the number of rows is higher than 0 (should always be 1 if so)  to verify
                 * whether a user exists.
                 */

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