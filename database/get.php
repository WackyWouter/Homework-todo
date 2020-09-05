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
        $id = '';
        $name = '';
        $description = '';
        $duedate = '';
        $course = '';
        $priority = '';

        $stmt = Database::$conn->prepare("SELECT id, name, description, duedate, course, priority FROM homework WHERE user_id = ? AND category_id = ? AND done = ? ORDER BY duedate ASC");
        $stmt->bind_param("iii", $user_id, $category_id, $done);
        $stmt->execute();
        $stmt->bind_result($id, $name, $description, $duedate, $course, $priority);
        while ($stmt->fetch()){
            $result [] = ['id'=>$id, 'name' => $name, 'description' => $description, 'duedate' => $duedate, 'course' => $course, 'priority' => $priority];
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
        $moddate = '';
        $adddate = '';

        $stmt = Database::$conn->prepare("SELECT id, name, moddate, adddate FROM category WHERE user_id = ? ORDER BY name ASC");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($id, $name, $moddate, $adddate);
        while ($stmt->fetch()){
            $result [] = ['id' => $id, 'name' => $name, 'moddate' => $moddate, 'adddate' => $adddate];
        }
        $stmt->close();

        return $result;
    }

    public static function getCategory($cat_id){
        if(!Database::$connection){
            Database::connection();
        }

        $name = '';
        $id = '';
        $moddate = '';
        $adddate = '';

        $stmt = Database::$conn->prepare("SELECT id, name, moddate, adddate FROM category WHERE id = ?");
        $stmt->bind_param("i", $cat_id);
        $stmt->execute();
        $stmt->bind_result($id, $name, $moddate, $adddate);
        $stmt->fetch();
        $stmt->close();
        $result = ['id' => $id, 'name' => $name, 'moddate' => $moddate, 'adddate' => $adddate];

        return $result;
    }

    public static function getTaskAmountByCat($user_id, $category_id, $type = 'all'){
        $amount = null;
        $query = '';
        switch($type) {
            case 'all':
                $query ="SELECT  count(c.id) FROM category c LEFT JOIN homework h ON h.category_id = c.id WHERE c.user_id = ? AND c.id = ?";
                break;
            case 'done':
                $query ="SELECT  count(c.id) FROM category c LEFT JOIN homework h ON h.category_id = c.id WHERE c.user_id = ? AND c.id = ? AND h.done = 1";
                break;
            case 'todo':
                $query ="SELECT  count(c.id) FROM category c LEFT JOIN homework h ON h.category_id = c.id WHERE c.user_id = ? AND c.id = ? AND h.done = 0";
                break;
            default:
                die("Error: " . "wrong type");
                //TODO make this go to log function
                
        }
        $stmt = Database::$conn->prepare($query);
        $stmt->bind_param('ii', $user_id, $category_id);
        $stmt->execute();
        $stmt->bind_result($amount);
        $stmt->fetch();
        $stmt->close();

        return $amount;
    }
}

?>