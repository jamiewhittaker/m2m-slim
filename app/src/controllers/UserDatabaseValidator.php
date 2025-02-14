<?php
/**
 * Validates user form input and checks if the user already exists on the database.
 */

namespace App\Controllers;

use App\Controllers\UserDatabaseWrapper;
use PDO;

class UserDatabaseValidator
{

    private $database;
    private $hashedPassword;


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
            $password = password_hash($_POST['passwordRegister'], PASSWORD_DEFAULT);

            /**
             * SQL statement retrieves the count of rows where either the username or password matches,
             * as we only need to verify the username field to see if a row exists.
             */

            $statement = "SELECT COUNT(*) FROM `users` WHERE username = :username OR password = :password";
        }
        if (isset($_POST['login'])) {
            $username = $_POST['usernameLogin'];

            $hash = $this->getHash($username);

            /**
             * Used to verify hashed password retrived from the server to see if it matches with user input
             */

            $password = password_verify($_POST['passwordLogin'], $hash);

            if ($password) {
                $password = $hash;
            }


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

            $this->database = new PDO('mysql:host='. db_host .';dbname='. db_name,db_username, db_password);
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


    /**
     * Function used to get the hashed password from the user database
     *
     */

    function getHash($username) {
        /**
         * Create a new PDO object connecting to the database
         */
        $this->database = new PDO('mysql:host='. db_host .';dbname='. db_name,db_username, db_password);
        $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /**
         * Preparing sql statement which will be used to select hashed password from db
         */
        $sql = $this->database->prepare("SELECT password FROM `users` WHERE username = :username");

        /**
         * Binding parameters so that they can be used in the sql statement which was prepared
         */

        $sql->bindParam(':username', $username);

        /**
         * If execute() returns false a new exception will be thrown
         */
        if (
            $sql->execute() === false) {
            throw new exception("Error");
        }

        /**
         * returns hashed password as string
         */
        $this->hashedPassword = $sql->fetchColumn();
        return $this->hashedPassword;

    }


}