<?php
    require 'database.php';

class create{

    public static function addHomework($homework, $user_id, $category_id){
        if(!database::$connection){
            database::connection();
        }

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

        $stmt = database::$conn->prepare("INSERT INTO homework(user_id, name, description, duedate, course, category_id, priority) VALUES(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('issssis', $user_id, $homework->name, $homework->description, $homework->duedate, $homework->course, $category_id, $homework->priority);
        $stmt->execute();
        $stmt->close();

        // maybe return the added item
        return json_encode(['status', 'ok']);
    }

    public static function addCategory($category, $user_id){
        if(!database::$connection){
            database::connection();
        }
        if(!isset($category)){
            die("Error: " . "category unset");
            //TODO make this go to log function
        }
        if(!isset($user_id)){
            die("Error: " . "user_id unset");
            //TODO make this go to log function
        }

        $stmt = database::$conn->prepare('SELECT name FROM category WHERE user_id = ? AND name = ?' );
        $stmt->bind_param('is', $user_id, $category);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0){
            $stmt->close();
            return true;
        }
        
        $stmt = database::$conn->prepare("INSERT INTO category(name, user_id) VALUES(?, ?)");
        $stmt->bind_param('si', $category, $user_id);
        $stmt->execute();
        if(!($stmt->affected_rows > 0)){
            $stmt->close();
            return false;
            //TODO add log function
        }
        $stmt->close();
        return true;
    }

    public static function addUser($user){
        if(!database::$connection){
            database::connection();
        }
        if(!isset($user->username)){
            die("Error: " . "username unset");
            //TODO make this go to log function
        }
        if(!isset($user->password)){
            die("Error: " . "password unset");
            //TODO make this go to log function
        }

        $stmt = database::$conn->prepare("INSERT INTO user(username, password) VALUES(?, ?)");
        $stmt->bind_param('ss', $user->username, $user->password);
        $stmt->execute();
        $stmt->close();

        // maybe return the added item
        return json_encode(['status', 'ok']);
    }

}

?>