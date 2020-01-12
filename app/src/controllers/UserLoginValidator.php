<?php

/**
 * Validation for the user input form
 */

namespace App\Controllers;


class UserLoginValidator
{

    public function validateLogin()
    {

        if (empty($_POST['usernameLogin']) || empty($_POST['passwordLogin'])) {
            return false;
        } else {
            return true;
        }
    }


    public function validateRegister() {
            if (empty($_POST['usernameRegister']) || empty($_POST['passwordRegister'])){
                return false;
            } else {
                return true;
            }
        }

}