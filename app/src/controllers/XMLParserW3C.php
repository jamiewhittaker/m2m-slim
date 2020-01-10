<?php


namespace App\controllers;
use App\Controllers\SoapWrapper;

class XMLParserW3C
{

 private $message;

 public function parse($message) {




     $xml = simplexml_load_string($message->return) or Die("ERROR");
     foreach ($xml as $message) {
         print_r($message);
     }


 }


}