<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use App\Models\User;
use App\Controllers\UserDatabaseWrapper;
use App\Controllers\UserDatabaseValidator;
use App\Controllers\UserLoginValidator;

$app->get('/', function(Request $request, Response $response)
{


    /**
     * Unset's $_SESSION variables on load
     */

    session_unset();


    return $this->view->render($response, 'login.html.twig');
});




$app->post('/', function(Request $request, Response $response) {

    $val = new UserDatabaseValidator();
    $formVal = new UserLoginValidator();


    /**
     * Firstly checks if the register button has been set (pressed) and
     * then checks if the form data has been filled in correctly.
     */

    if (isset($_POST['register'])) {
        if (!$formVal->validateRegister()) {
            $err = "<p>Please input both username and password to register</p>";
            return $this->view->render($response, 'login.html.twig' , ["formError" => $err]);
        } else {

            if ($val->validateUserExists()) {
               $err = "<p>User Already Exists</p>";
                return $this->view->render($response, 'login.html.twig' , ["formError" => $err]);
            }

            if (!$val->validateUserExists()) {
                addUser();
                $_SESSION['username'] = $_POST['usernameRegister'];
                return $this->view->render($response->withRedirect('homepage'), 'homepage.html.twig');

            }
        }

    }

    /**
     * Same as the register check
     */

    if (isset($_POST['login'])) {
        if (!$formVal->validateLogin()) {
            $err = "<p>Please input both username and password to log in</p>";
            return $this->view->render($response, 'login.html.twig', ["formError" => $err]);
        } else {
            if ($val->validateUserExists()) {
                $_SESSION['username'] = $_POST['usernameLogin'];
                return $this->view->render($response->withRedirect('homepage'), 'homepage.html.twig');
            } else {
                $err = "<p>User does not exist</p>";
                return $this->view->render($response, 'login.html.twig', ["formError" => $err]);
            }
        }
    }
});


/**
 * Creates a new UserDatabaseValidator object and runs method to validate input.
 */

function addUser() {
    $val = new UserDatabaseValidator();
    $val->validateRegisterInput();
}








