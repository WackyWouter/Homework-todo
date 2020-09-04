<?php
require __DIR__ . '/../configuration.php';

class Database{

    public static $conn = "";
    public static $connection = false;

    public static function connection(){
        if(!defined("DATABASE")){
            die("Error: " . "Database unset");
            //TODO make this go to log function
        }
        if(!defined("PASSWORD")){
            die("Error: " . "password unset");
            //TODO make this go to log function
        }
        if(!defined("SERVERNAME")){
            die("Error: " . "servername unset");
            //TODO make this go to log function
        }
        if(!defined("USERNAME")){
            die("Error: " . "username unset");
            //TODO make this go to log function
        }

        self::$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);

        // Check connection
        if (self::$conn->connect_error) {
            die("Connection failed: " . self::$conn->connect_error);
            //TODO make this go to log function
        }
        self::$connection = true;
    }
}
?>