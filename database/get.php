<?php
require_once '../Usefull-PHP/up_database.php';

class Get{
    public static function CheckUser($username, $password){
        if(!isset($username)){
            die("Error: " . "username unset");
            //TODO make this go to log function
        }

        if ($stmt = up_database::prepare('SELECT user_uuid
                                                , AES_DECRYPT(password, UNHEX(SHA2(user_uuid, 512))) 
                                            FROM 
                                                users 
                                            WHERE 
                                                username = ?')) {
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $stmt->store_result();

            $id = 0;
            $passwordDB = '';

        
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $passwordDB);
                $stmt->fetch();
               if ($password === $passwordDB) {
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

    public static function getUser($id){
        $username = null;
        $password = null;
        $user_uuid = null;
        $securityQuestion = null;
        $securityAnswer = null;
        $adddate = null;
        $user = [];

        $stmt = up_database::prepare('SELECT id
                                                , username
                                                , AES_DECRYPT(password, UNHEX(SHA2(user_uuid, 512))) 
                                                , AES_DECRYPT(security_question, UNHEX(SHA2(user_uuid, 512))) 
                                                , AES_DECRYPT(security_answer, UNHEX(SHA2(user_uuid, 512))) 
                                                , user_uuid
                                                , adddate
                                            FROM 
                                                users 
                                            WHERE 
                                                user_uuid = ?');
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $stmt->bind_result($id, $username, $password, $securityQuestion, $securityAnswer, $user_uuid, $adddate);
        $stmt->fetch();
        $stmt->close();
        
        $user = ['id' => $id, 'username' => $username, 'password' => $password, 'securityQuestion' => $securityQuestion, 'securityAnswer' => $securityAnswer, 'user_uuid' => $user_uuid, 'adddate' => $adddate];

        return $user;
    }

    

    public static function getHomework($user_id, $category_id, $done){
        $result = [];
        $id = '';
        $name = '';
        $description = '';
        $duedate = '';
        $course = '';
        $priority = '';

        $stmt = up_database::prepare("SELECT id, name, description, duedate, course, priority FROM homework WHERE user_id = ? AND category_id = ? AND done = ? ORDER BY duedate ASC");
        $stmt->bind_param("sii", $user_id, $category_id, $done);
        $stmt->execute();
        $stmt->bind_result($id, $name, $description, $duedate, $course, $priority);
        while ($stmt->fetch()){
            $result [] = ['id'=>$id, 'name' => $name, 'description' => $description, 'duedate' => $duedate, 'course' => $course, 'priority' => $priority];
        }
        $stmt->close();

        return $result;
    }

    public static function getCategories($user_id){
        $result = [];
        $name = '';
        $id = '';
        $moddate = '';
        $adddate = '';

        $stmt = up_database::prepare("SELECT id, name, moddate, adddate FROM category WHERE user_id = ? ORDER BY name ASC");
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $stmt->bind_result($id, $name, $moddate, $adddate);
        while ($stmt->fetch()){
            $result [$id] = ['id' => $id, 'name' => $name, 'moddate' => $moddate, 'adddate' => $adddate];
        }
        $stmt->close();

        return $result;
    }

    public static function getCategory($cat_id){
        $name = '';
        $id = '';
        $moddate = '';
        $adddate = '';

        $stmt = up_database::prepare("SELECT id, name, moddate, adddate FROM category WHERE id = ?");
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
        $stmt = up_database::prepare($query);
        $stmt->bind_param('si', $user_id, $category_id);
        $stmt->execute();
        $stmt->bind_result($amount);
        $stmt->fetch();
        $stmt->close();

        return $amount;
    }

    public static function getSecurityQuestions(){
        $result = [];
        $securityQuestion = '';
        $id = '';

        $stmt = up_database::prepare("SELECT id, security_question FROM security_questions ORDER BY security_question ASC");
        $stmt->execute();
        $stmt->bind_result($id, $securityQuestion);
        while ($stmt->fetch()){
            $result [$id] = ['id' => $id, 'securityQuestion' => $securityQuestion];
        }
        $stmt->close();

        return $result;
    }
}

?>