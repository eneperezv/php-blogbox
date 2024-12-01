<?php

class User{

    public static function findByEmail($email) {
        $db = Connection::connect();
        
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(":email", $email, \PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function findById($userId) {
        $db = Connection::connect();
        
        $stmt = $db->prepare("SELECT * FROM users WHERE id = :userId");
        $stmt->bindParam(":userId", $userId, \PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function create($data, $password) {
        $db = Connection::connect();

        $stmt = $db->prepare("INSERT INTO users (email, password, role, name, phone, timezone) 
                              VALUES (:email, :password, :role, :name, :phone, :timezone)");

        $stmt->bindParam(":email", $data['email'], \PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, \PDO::PARAM_STR);
        $stmt->bindParam(":role", $data['role'], \PDO::PARAM_STR);
        $stmt->bindParam(":name", $data['name'], \PDO::PARAM_STR);
        $stmt->bindParam(":phone", $data['phone'], \PDO::PARAM_STR);
        $stmt->bindParam(":timezone", $data['timezone'], \PDO::PARAM_STR);
        
        return $stmt->execute();
    }

}

?>