<?php
require_once '../Usefull-PHP/up_database.php';

class Edit{

    public static function editHomework($id, $name, $description, $comments, $duedate, $course, $priority){
        $stmt = up_database::prepare("UPDATE homework SET name = ?, description = ?, comments = ?, duedate = ?, course = ?, priority = ? WHERE id = ?");
        $stmt->bind_param("ssssssi", $name, $description, $comments, $duedate, $course, $priority, $id);
        $stmt->execute();
        if($stmt->error != null){
            // todo do error logging
        }
        $stmt->close();
    }

    public static function editCategory($id, $name){
        if(!isset($id) || !isset($name)){
            die("Error: id or name unset");
            //TODO make this go to log function
        }
        $stmt = up_database::prepare("UPDATE category SET name = ? WHERE id = ?");
        $stmt->bind_param("si", $name, $id);
        $stmt->execute();
        if($stmt->error != null){
            // todo do error logging
        }
        $stmt->close();
    }

    public static function editUser($id, $user){
        if(!isset($id)){
            die("Error: " . "id unset");
            //TODO make this go to log function
        }
        //   ??

    }

    public static function updatePassword($id, $password){
        if(!isset($id) || !isset($password)){
            die("Error: password or id unset");
            //TODO make this go to log function
        }
        if($stmt = up_database::prepare("UPDATE users SET password = AES_ENCRYPT(?, UNHEX(SHA2(?, 512))) WHERE user_uuid = ?")){
            $stmt->bind_param("sss", $password, $id, $id);
            $stmt->execute();
            up_database::logError($stmt);
            $stmt->close();
            if($stmt->error != null){
                // todo do error logging
            }
            return true;
        }
        return false;
    }

    public static function updateSecurity($id, $question, $answer){
        if(!isset($id) || !isset($question) || !isset($answer)){
            die("Error: question_id or answer or id unset");
            //TODO make this go to log function
        }
        if($stmt = up_database::prepare("UPDATE users SET security_question = AES_ENCRYPT(?, UNHEX(SHA2(?, 512))), security_answer = AES_ENCRYPT(?, UNHEX(SHA2(?, 512))) WHERE user_uuid = ?")){
            $stmt->bind_param("sssss", $question, $id, $answer, $id, $id);
            $stmt->execute();
            up_database::logError($stmt);
            $stmt->close();
            if($stmt->error != null){
                // todo do error logging
            }
            return true;
        }
        return false;
    }


    public static function doneHomework($id, $done = 1){
        if(!isset($id)){
            die("Error: " . "id unset");
            //TODO make this go to log function
        }

        $stmt = up_database::prepare("UPDATE homework SET done = ? WHERE id = ?");
        $stmt->bind_param("ii", $done, $id);
        $stmt->execute();
        if($stmt->error != null){
            // todo do error logging
        }
        $stmt->close();
    }
}
?>