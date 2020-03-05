<?php

class database{

    public static $conn = "";
    private static $connection = false;

    public static function connection(){
        
        if(!defined(DATABASE)){
            die("Error: " . "database unset");
            //TODO make this go to log function
        }
        if(!defined(PASSWORD)){
            die("Error: " . "password unset");
            //TODO make this go to log function
        }
        if(!defined(SERVERNAME)){
            die("Error: " . "servername unset");
            //TODO make this go to log function
        }
        if(!defined(USERNAME)){
            die("Error: " . "username unset");
            //TODO make this go to log function
        }

        self::$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);

        // Check connection
        if (self::$conn->connect_error) {
            die("Connection failed: " . self::$conn->connect_error);
            //TODO make this go to log function
        }
        echo "Connected successfully";
    }

    public static function getUserHw($user_id, $category_id){

        if(!self::$connection){
            self::connection();
        }

        $result = [];
        $name = '';
        $description = '';
        $duedate = '';
        $course = '';
        $priority = '';
        $done = '';

        $stmt = self::$conn->prepare("SELECT name, description, duedate, course, priority, done FROM homework WHERE user_id = ? AND category_id = ?");
        $stmt->bind_param("ii", $user_id, $category_id);
        $stmt->execute();
        $stmt->bind_result($name, $description, $duedate, $course, $priority, $done);
        while ($stmt->fetch()){
            $result [] = [$name, $description, $duedate, $course, $priority, $done];
        }
        $stmt->close();

        return json_encode($result);
    }

    public static function getCategories($user_id){

        if(!self::$connection){
            self::connection();
        }

        $result = [];
        $name = '';
        $id = '';

        $stmt = self::$conn->prepare("SELECT id, name FROM category WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($id, $name);
        while ($stmt->fetch()){
            $result [] = [$id, $name];
        }
        $stmt->close();

        return json_encode($result);
    }
}
?>