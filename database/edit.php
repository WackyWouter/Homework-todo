<?php
require_once '../Usefull-PHP/up_database.php';

class Edit{

    public static function editHomework($id, $homework){
        if(!isset($id)){
            die("Error: " . "id unset");
            //TODO make this go to log function
        }
        //   ??
    }

    public static function editCategory($id, $name){
        if(!isset($id) || !isset($name)){
            die("Error: id or name unset");
            //TODO make this go to log function
        }
        $stmt = up_database::prepare("UPDATE category SET name = ? WHERE id = ?");
        $stmt->bind_param("si", $name, $id);
        $stmt->execute();
        $stmt->close();
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

        $stmt = up_database::prepare("UPDATE homework SET done = ? WHERE id = ?");
        $stmt->bind_param("ii", $done, $id);
        $stmt->execute();
        $stmt->close();
    }
}
?>