<?php
use App\Controllers\DatabaseWrapper;
use App\Models\CircuitStatus;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/updateform', function(Request $request, Response $response){

    $db = new DatabaseWrapper();


    if (isset($_POST['submit']))  {


    }

    return $this->view->render($response, 'updateform.html.twig');

})->setName('updateform');




$app->post('/updateform', function(Request $request, Response $response) {

    addFormToDatabase();

    return $this->view->render($response, 'updateform.html.twig');
});





function addFormToDatabase() {



    $msisdn = $_POST['msisdn'];
    $name = $_POST['name'];
    $email= $_POST['email'];
    $switch1=  $_POST['switch1'];
    $switch2=  $_POST['switch2'];
    $switch3= $_POST['switch3'];
    $switch4= $_POST['switch4'];
    $fan= $_POST['fan'];
    $temp= $_POST['temp'];
    $keypad= $_POST['keypad'];

    $db = new DatabaseWrapper();


    $status = new CircuitStatus($msisdn, $name, $email, $switch1,
        $switch2,$switch3,$switch4, $fan, $temp, $keypad);

    $db->insertBoardStatus($status);
}