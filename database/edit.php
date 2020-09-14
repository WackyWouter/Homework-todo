<?php
require_once '../Usefull-PHP/up_database.php';

class Edit{

    public static function editHomework($userId, $id, $name, $description, $comments, $duedate, $course, $priority){
        $stmt = up_database::prepare("UPDATE homework SET name = ?, description = ?, comments = ?, duedate = ?, course = ?, priority = ? WHERE id = ? and user_id = ?");
        $stmt->bind_param("ssssssis", $name, $description, $comments, $duedate, $course, $priority, $id, $userId);
        $stmt->execute();
        if($stmt->error != null){
            $error = $stmt->error;
            $stmt->close();
            header('Location: error.php?error=' . $error);
        }
        $stmt->close();
    }

    public static function editCategory($id, $name, $userId){
        $stmt = up_database::prepare("UPDATE category SET name = ? WHERE id = ? and user_id = ?");
        $stmt->bind_param("sis", $name, $id, $userId);
        $stmt->execute();
        if($stmt->error != null){
            $error = $stmt->error;
            $stmt->close();
            header('Location: error.php?error=' . $error);
        }
        $stmt->close();
    }

    public static function updatePassword($id, $password){
        if($stmt = up_database::prepare("UPDATE users SET password = AES_ENCRYPT(?, UNHEX(SHA2(?, 512))) WHERE user_uuid = ?")){
            $stmt->bind_param("sss", $password, $id, $id);
            $stmt->execute();
            up_database::logError($stmt);
            $stmt->close();
            if($stmt->error != null){
                $error = $stmt->error;
                $stmt->close();
                header('Location: error.php?error=' . $error);
            }
            return true;
        }
        return false;
    }

    public static function updateSecurity($id, $question, $answer){
        if($stmt = up_database::prepare("UPDATE users SET security_question = AES_ENCRYPT(?, UNHEX(SHA2(?, 512))), security_answer = AES_ENCRYPT(?, UNHEX(SHA2(?, 512))) WHERE user_uuid = ?")){
            $stmt->bind_param("sssss", $question, $id, $answer, $id, $id);
            $stmt->execute();
            up_database::logError($stmt);
            $stmt->close();
            if($stmt->error != null){
                $error = $stmt->error;
                $stmt->close();
                header('Location: error.php?error=' . $error);
            }
            return true;
        }
        return false;
    }


    public static function doneHomework($userId, $id, $done = 1){

        $stmt = up_database::prepare("UPDATE homework SET done = ? WHERE id = ? and user_id = ?");
        $stmt->bind_param("iis", $done, $id, $userId);
        $stmt->execute();
        if($stmt->error != null){
            $error = $stmt->error;
            $stmt->close();
            header('Location: error.php?error=' . $error);
        }
        $stmt->close();
    }
}
?>