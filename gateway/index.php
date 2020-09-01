<?php

$data = json_decode(file_get_contents('php://input'), true);

if(array_key_exists("HTTP_TYPE", $_SERVER)){
    header("HTTP/1.1 400 Faulty request");
}
$type = $_SERVER['HTTP_TYPE'];


switch($type){
    case 'getAll':
        echo "getAll";
        break;
    default:
        header("Faulty call", true, 400);
}

