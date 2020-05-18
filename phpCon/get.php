<?php
require_once 'database.php';

class Get{
    public static function getUser($username, $password){
        if(!Database::$connection){
            Database::connection();
        }

        if(!isset($username)){
            die("Error: " . "username unset");
            //TODO make this go to log function
        }

        if ($stmt = Database::$conn->prepare('SELECT id, password FROM users WHERE username = ?')) {
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $stmt->store_result();

            $id = 0;
            $passwordDB = '';

        
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $passwordDB);
                $stmt->fetch();
               if (password_verify($password, $passwordDB)) {
                    session_regenerate_id();
                    $_SESSION['loggedin'] = TRUE;
                    $_SESSION['name'] = $username;
                    $_SESSION['id'] = $id;
                    $stmt->close();
                    return true;
                } 
            }            
        }
        $stmt->close();
        return false;
    }

    

    public static function getHomework($user_id, $category_id, $done){
        if(!Database::$connection){
            Database::connection();
        }

        $result = [];
        $name = '';
        $description = '';
        $duedate = '';
        $course = '';
        $priority = '';

        $stmt = Database::$conn->prepare("SELECT name, description, duedate, course, priority FROM homework WHERE user_id = ? AND category_id = ? AND done = ?");
        $stmt->bind_param("iii", $user_id, $category_id, $done);
        $stmt->execute();
        $stmt->bind_result($name, $description, $duedate, $course, $priority);
        while ($stmt->fetch()){
            $result [] = [$name, $description, $duedate, $course, $priority];
        }
        $stmt->close();

        return $result;
    }

    public static function getCategories($user_id){
        if(!Database::$connection){
            Database::connection();
        }

        $result = [];
        $name = '';
        $id = '';

        $stmt = Database::$conn->prepare("SELECT id, name FROM category WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($id, $name);
        while ($stmt->fetch()){
            $result [] = [$id, $name];
        }
        $stmt->close();

        return $result;
    }
}

?>