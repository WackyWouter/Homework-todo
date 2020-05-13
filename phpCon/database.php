<?php
require __DIR__ . '/../configuration.php';

class database{

    public static $conn = "";
    public static $connection = false;

    public static function connection(){
        if(!defined("DATABASE")){
            die("Error: " . "database unset");
            //TODO make this go to log function
        }
        if(!defined("PASSWORD")){
            die("Error: " . "password unset");
            //TODO make this go to log function
        }
        if(!defined("SERVERNAME")){
            die("Error: " . "servername unset");
            //TODO make this go to log function
        }
        if(!defined("USERNAME")){
            die("Error: " . "username unset");
            //TODO make this go to log function
        }

        self::$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);

        // Check connection
        if (self::$conn->connect_error) {
            die("Connection failed: " . self::$conn->connect_error);
            //TODO make this go to log function
        }
        self::$connection = true;
    }

    public static function getUser($username, $password){
        if(!self::$connection){
            self::connection();
        }

        if(!isset($username)){
            die("Error: " . "username unset");
            //TODO make this go to log function
        }

        if ($stmt = self::$conn->prepare('SELECT id, password FROM users WHERE username = ?')) {
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

    

    public static function getHomework($user_id, $category_id){
        if(!self::$connection){
            self::connection();
        }

        $result = [];
        $name = '';
        $description = '';
        $duedate = '';
        $course = '';
        $priority = '';
        $done = '';

        $stmt = self::$conn->prepare("SELECT name, description, duedate, course, priority, done FROM homework WHERE user_id = ? AND category_id = ?");
        $stmt->bind_param("ii", $user_id, $category_id);
        $stmt->execute();
        $stmt->bind_result($name, $description, $duedate, $course, $priority, $done);
        while ($stmt->fetch()){
            $result [] = [$name, $description, $duedate, $course, $priority, $done];
        }
        $stmt->close();

        return json_encode(['status' => 'ok', 'result' => $result]);
    }

    public static function getCategories($user_id){
        if(!self::$connection){
            self::connection();
        }

        $result = [];
        $name = '';
        $id = '';

        $stmt = self::$conn->prepare("SELECT id, name FROM category WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($id, $name);
        while ($stmt->fetch()){
            $result [] = [$id, $name];
        }
        $stmt->close();

        return json_encode(['status' => 'ok', 'result' => $result]);
    }

   
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

    public static function deleteHomework($id){
        if(!self::$connection){
            self::connection();
        }

        $stmt = self::$conn->prepare("DELETE FROM homework WHERE id = ?");
        $stmt->bind_param('s', $id);
        if($stmt->execute()){
            die("Error: " . "delete homework id:". $id);
            //TODO make this go to log function
        }
        $stmt->close();

        return json_encode(['status' => 'ok']);
    }

    public static function deleteCategory($id){
        if(!self::$connection){
            self::connection();
        }

        $stmt = self::$conn->prepare("DELETE FROM category WHERE id = ?");
        $stmt->bind_param('s', $id);
        if($stmt->execute()){
            die("Error: " . "delete category id:". $id);
            //TODO make this go to log function
        }
        $stmt->close();

        return json_encode(['status' => 'ok']);
    }

    public static function deleteUser($id){
        if(!self::$connection){
            self::connection();
        }

        $stmt = self::$conn->prepare("DELETE FROM user WHERE id = ?");
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