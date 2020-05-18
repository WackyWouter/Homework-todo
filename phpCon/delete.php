<?php
require_once 'database.php';

class Delete{
    public static function deleteHomework($id){
        if(!Database::$connection){
            Database::connection();
        }

        $stmt = Database::$conn->prepare("DELETE FROM homework WHERE id = ?");
        $stmt->bind_param('s', $id);
        if($stmt->execute()){
            die("Error: " . "delete homework id:". $id);
            //TODO make this go to log function
        }
        $stmt->close();

        return json_encode(['status' => 'ok']);
    }

    public static function deleteCategory($id){
        if(!Database::$connection){
            Database::connection();
        }

        $stmt = Database::$conn->prepare("DELETE FROM category WHERE id = ?");
        $stmt->bind_param('s', $id);
        if($stmt->execute()){
            die("Error: " . "delete category id:". $id);
            //TODO make this go to log function
        }
        $stmt->close();

        return json_encode(['status' => 'ok']);
    }

    public static function deleteUser($id){
        if(!Database::$connection){
            Database::connection();
        }

        $stmt = Database::$conn->prepare("DELETE FROM user WHERE id = ?");
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