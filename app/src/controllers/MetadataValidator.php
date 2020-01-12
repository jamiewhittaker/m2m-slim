<?php
/**
 * Checks metadata stored in a row to avoid duplication of data
 */


namespace App\controllers;


use PDO;

class MetadataValidator
{
    private $database;

    public function checkDateRecieved($status) {


        try {

            /**
             * Create a new PDO object connecting to the database
             */
            $this->database = new PDO('mysql:host='. db_host .';dbname='. db_name,db_username, db_password);
            $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            /**
             * Getting the metadata and circuit board status using get methods from the CircuitStatus class
             * to store in variables.
             */
            $date = $status->getDate();

            /**
             * Preparing sql statement which will be used to count the number of rows with a certain date
             */
            $sql = $this->database->prepare("SELECT COUNT(*) FROM `board_status` WHERE date = :date");

            /**
             * Binding parameters so that they can be used in the sql statement which was prepared
             */

            $sql->bindParam(':date', $date);

            /**
             * If execute() returns false a new exception will be thrown
             */
            if (
                $sql->execute() === false) {
                throw new exception("Unable to add to database");
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