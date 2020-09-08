<?php
    require_once '../Usefull-PHP/up_database.php';
    require_once '../Usefull-PHP/up_crypt.php';

class Create{

    public static function addHomework($user_id, $category_id, $name, $description, $comments, $duedate, $course, $priority){

        if(!isset($category_id)){
            die("Error: " . "category_id unset");
            //TODO make this go to log function
        }
        if(!isset($user_id)){
            die("Error: " . "user_id unset");
            //TODO make this go to log function
        }
        if(!isset($name)){
            die("Error: " . "name unset");
            //TODO make this go to log function
        }
        if(!isset($comments)){
            die("Error: " . "comments unset");
            //TODO make this go to log function
        }
        if(!isset($description)){
            die("Error: " . "description unset");
            //TODO make this go to log function
        }
        if(!isset($duedate)){
            die("Error: " . "duedate unset");
            //TODO make this go to log function
        }
        if(!isset($course)){
            die("Error: " . "course unset");
            //TODO make this go to log function
        }
        if(!isset($priority)){
            die("Error: " . "priority unset");
            //TODO make this go to log function
        }

        $stmt = up_database::prepare("INSERT INTO homework(user_id, name, description, comments, duedate, course, category_id, priority) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssssis', $user_id, $name, $description, $comments, $duedate, $course, $category_id, $priority);
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

        $stmt = up_database::prepare('SELECT name FROM category WHERE user_id = ? AND name = ?' );
        $stmt->bind_param('ss', $user_id, $category);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0){
            $stmt->close();
            return true;
        }

        
        $stmt = up_database::prepare("INSERT INTO category(name, user_id) VALUES(?, ?)");
        $stmt->bind_param('ss', $category, $user_id);
        $stmt->execute();
        if(!($stmt->affected_rows > 0)){
            $stmt->close();
            return false;
            //TODO add log function
        }
        $stmt->close();
        return true;
    }

    public static function addUser($username, $password, $securityQuestion, $securityAnswer){
        if(!isset($username)){
            die("Error: " . "username unset");
            //TODO make this go to log function
        }
        if(!isset($password)){
            die("Error: " . "password unset");
            //TODO make this go to log function
        }
        if(!isset($securityQuestion)){
            die("Error: " . "security question unset");
            //TODO make this go to log function
        }
        if(!isset($securityAnswer)){
            die("Error: " . "security answer unset");
            //TODO make this go to log function
        }

        $uuid4 = up_crypt::uuid4();

        if ($stmt = up_database::prepare(
            "INSERT INTO users(
                username
                , password
                , security_question
                , security_answer
                , user_uuid) 
            VALUES (
                ?,
                AES_ENCRYPT(?, UNHEX(SHA2(?, 512))), 
                AES_ENCRYPT(?, UNHEX(SHA2(?, 512))), 
                AES_ENCRYPT(?, UNHEX(SHA2(?, 512))), 
                ?)"))
            {
            $stmt->bind_param('ssssssss', $username, $password, $uuid4, $securityQuestion, $uuid4, $securityAnswer, $uuid4, $uuid4 );
            $stmt->execute();
            $stmt->close();

            session_start();
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $username;
            $_SESSION['id'] = $uuid4;

            return true;
        }
        return false;
    }

}

?>