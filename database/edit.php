<?php
require_once 'database.php';

class Edit{

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

    public static function doneHomework($id, $done = 1){
        if(!isset($id)){
            die("Error: " . "id unset");
            //TODO make this go to log function
        }

        $stmt = Database::$conn->prepare("UPDATE homework SET done = ? WHERE id = ?");
        $stmt->bind_param("ii", $done, $id);
        $stmt->execute();
        $stmt->close();
    }
}
?>