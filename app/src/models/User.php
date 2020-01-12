<?php
/**
 * Class for user data
 */
namespace App\Models;

class User
{


    private $username;
    private $password;

    /**
     * User constructor.
     * @param $username
     * @param $password
     */

    public function __construct($username,$password){
        $this->username = $username;
        $this->password = $password;
    }

    public function setUsername($user) {
        $this->username = $user;
    }

    public function setPassword($pass) {
        $this->password = $pass;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

}