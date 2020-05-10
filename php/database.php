<?php

class database{

    public static $conn = "";
    private static $connection = false;

    public static function connection(){
        if(!defined("DATABASE")){
            die("Error: " . "database unset");
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
        echo "Connected successfully";
    }

    public static function getHomework($user_id, $category_id){
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

        return json_encode(['status' => 'ok', 'result' => $result]);
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

        return json_encode(['status' => 'ok', 'result' => $result]);
    }

    public static function addHomework($homework, $user_id, $category_id){
        if(!isset($category_id)){
            die("Error: " . "category_id unset");
            //TODO make this go to log function
        }
        if(!isset($user_id)){
            die("Error: " . "user_id unset");
            //TODO make this go to log function
        }
        if(!isset($homework->name)){
            die("Error: " . "name unset");
            //TODO make this go to log function
        }
        if(!isset($homework->description)){
            die("Error: " . "description unset");
            //TODO make this go to log function
        }
        if(!isset($homework->duedate)){
            die("Error: " . "duedate unset");
            //TODO make this go to log function
        }
        if(!isset($homework->course)){
            die("Error: " . "course unset");
            //TODO make this go to log function
        }
        if(!isset($homework->priority)){
            die("Error: " . "priority unset");
            //TODO make this go to log function
        }

        $stmt = self::$conn->prepare("INSERT INTO homework(user_id, name, description, duedate, course, category_id, priority) VALUES(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('issssis', $user_id, $homework->name, $homework->description, $homework->duedate, $homework->course, $category_id, $homework->priority);
        $stmt->execute();
        $stmt->close();

        // maybe return the added item
        return json_encode(['status', 'ok']);
    }

    public static function addCategory($category, $user_id){
        if(!isset($category)){
            die("Error: " . "category unset");
            //TODO make this go to log function
        }
        if(!isset($user_id)){
            die("Error: " . "user_id unset");
            //TODO make this go to log function
        }

        $stmt = self::$conn->prepare("INSERT INTO category(name, user_id) VALUES(?, ?)");
        $stmt->bind_param('si', $category, $user_id);
        $stmt->execute();
        $stmt->close();

        // maybe return the added item
        return json_encode(['status', 'ok']);
    }

    public static function addUser($user){
        if(!isset($user->username)){
            die("Error: " . "username unset");
            //TODO make this go to log function
        }
        if(!isset($user->password)){
            die("Error: " . "password unset");
            //TODO make this go to log function
        }

        $stmt = self::$conn->prepare("INSERT INTO user(username, password) VALUES(?, ?)");
        $stmt->bind_param('ss', $user->username, $user->password);
        $stmt->execute();
        $stmt->close();

        // maybe return the added item
        return json_encode(['status', 'ok']);
    }

    public static function editHomework($id, $homework){
        if(!isset($id)){
            die("Error: " . "id unset");
            //TODO make this go to log function
        }
        //   ??
    }

    public static function editCategory($id, $category){
        if(!isset($id)){
            die("Error: " . "id unset");
            //TODO make this go to log function
        }
        //   ??
    }

    public static function editUser($id, $user){
        if(!isset($id)){
            die("Error: " . "id unset");
            //TODO make this go to log function
        }
        //   ??

    }

    public static function deleteHomework($id){
        if(!self::$connection){
            self::connection();
        }

        $stmt = self::$conn->prepare("DELETE FROM homework WHERE id = ?");
        $stmt->bind_param('s', $id);
        if($stmt->execute()){
            die("Error: " . "delete homework id:". $id);
            //TODO make this go to log function
        }
        $stmt->close();

        return json_encode(['status' => 'ok']);
    }

    public static function deleteCategory($id){
        if(!self::$connection){
            self::connection();
        }

        $stmt = self::$conn->prepare("DELETE FROM category WHERE id = ?");
        $stmt->bind_param('s', $id);
        if($stmt->execute()){
            die("Error: " . "delete category id:". $id);
            //TODO make this go to log function
        }
        $stmt->close();

        return json_encode(['status' => 'ok']);
    }

    public static function deleteUser($id){
        if(!self::$connection){
            self::connection();
        }

        $stmt = self::$conn->prepare("DELETE FROM user WHERE id = ?");
        $stmt->bind_param('s', $id);
        if($stmt->execute()){
            die("Error: " . "delete user id:". $id);
            //TODO make this go to log function
        }
        $stmt->close();

        return json_encode(['status' => 'ok']);
    }
}
?>