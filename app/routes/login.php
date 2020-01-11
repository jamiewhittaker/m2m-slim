<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use App\Models\User;
use App\Controllers\UserDatabaseWrapper;
use App\Controllers\UserDatabaseValidator;

$app->get('/', function(Request $request, Response $response)
{
    return $this->view->render($response, 'login.html.twig');
})->setName('login');




$app->post('/', function(Request $request, Response $response) {

    $val = new UserDatabaseValidator();

    if (isset($_POST['register'])) {

        if ($val->validateUserExists()) {
            return $this->view->render($response, 'login.html.twig');
        } else {
            addUser();
            return $this->view->render($response, 'homepage.html.twig');
        }
    }

    if (isset($_POST['login'])) {

        if ($val->validateUserExists()) {

            return $this->view->render($response->withRedirect('homepage'), 'homepage.html.twig');
        }

        if (!$val->validateUserExists()) {

            return $this->view->render($response, 'login.html.twig');

        }
    }
});



function addUser() {

    if (isset($_POST['register'])) {
        $user = new User($_POST['usernameRegister'], $_POST['passwordRegister']);
    }

    if (isset($_POST['login'])){
        $user = new User($_POST['usernameLogin'], $_POST['passwordLogin']);
    }


    $val = new UserDatabaseValidator();
    $db = new UserDatabaseWrapper();
    $val->validateRegisterInput();
}





