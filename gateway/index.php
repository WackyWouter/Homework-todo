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

// require_once __DIR__ . '/_autoload.php';

// h_cors::domains(CORS);
// h_database::$host = DB_HOST;
// h_database::$dbname = DB_NAME;
// h_database::$username = DB_UID;
// h_database::$passwd = DB_PWD;

// if (php_sapi_name() == 'cli') {
//     cronjob::kft();
// }
// else if (isset($_SERVER['REQUEST_URI'])) {
//     # Get JSON as a string
//     $json_str = file_get_contents('php://input');
    
//     $action = str_replace(BASE_DIR, '', $_SERVER['REQUEST_URI']);
//     switch ($action) {
//         case 'startblokkeertimer/weekly':
//             echo startblokkeertimer::weekly();
//             break;
//         case 'startblokkeertimer/holiday':
//             echo startblokkeertimer::holiday();
//             break;
//         default:
//             exit('404 call not found');
//     }
// }