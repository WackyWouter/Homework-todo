<?php
require_once '../Usefull-PHP/up_database.php';

class Delete{
    public static function deleteHomework($id){
        $stmt = up_database::prepare("DELETE FROM homework WHERE id = ?");
        $stmt->bind_param('s', $id);
        $stmt->execute();
        if($stmt->error != null){
            // todo do error logging
        }
        $stmt->close();

    }

    public static function deleteCategory($id){
        $stmt = up_database::prepare("DELETE FROM category WHERE id = ?");
        $stmt->bind_param('s', $id);
        $stmt->execute();
        if($stmt->error != null){
            // todo do error logging
        }
        $stmt->close();

        return json_encode(['status' => 'ok']);
    }

    public static function deleteUser($id){
        $stmt = up_database::prepare("DELETE FROM user WHERE id = ?");
        $stmt->bind_param('s', $id);
        $stmt->execute();
        if($stmt->error != null){
            // todo do error logging
        }
        $stmt->close();

        return json_encode(['status' => 'ok']);
    }
}
?>