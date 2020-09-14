<?php
    require_once '../Usefull-PHP/up_database.php';
    require_once '../Usefull-PHP/up_crypt.php';

class Create{

    public static function addHomework($user_id, $category_id, $name, $description, $comments, $duedate, $course, $priority){
        $stmt = up_database::prepare("INSERT INTO homework(user_id, name, description, comments, duedate, course, category_id, priority) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssssis', $user_id, $name, $description, $comments, $duedate, $course, $category_id, $priority);
        $stmt->execute();
        if($stmt->error != null){
            $error = $stmt->error;
            $stmt->close();
            header('Location: error.php?error=' . $error);
        }
        $stmt->close();

        // maybe return the added item
        return json_encode(['status', 'ok']);
    }

    public static function addCategory($category, $user_id){

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
            $error = $stmt->error;
            $stmt->close();
            header('Location: error.php?error=' . $error);
        }
        $stmt->close();
        return true;
    }

    public static function addUser($username, $password, $securityQuestion, $securityAnswer){
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
            if($stmt->error != null){
                $error = $stmt->error;
            $stmt->close();
            header('Location: error.php?error=' . $error);
            }
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