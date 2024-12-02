<?php

/*
 * @(#)PostDal.php 1.0 01/12/2024
 * 
 * El código implementado en este formulario esta protegido
 * bajo las leyes internacionales del Derecho de Autor, sin embargo
 * se entrega bajo las condiciones descritas en The MIT License (MIT)
 * en https://opensource.org/license/mit
 */

/**
 * @author eliezer.navarro
 * @version 1.0
 * @since 1.0
 */

class User{

    public static function findByEmail($email) {
        $result = UserDal::findByEmail($email);
        return $result === false ? [] : $result;
        /*
        $db = Connection::connect();
        
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(":email", $email, \PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
        */
    }

    public static function findById($userId) {
        $result = UserDal::findById($userId);
        return $result === false ? [] : $result;
        /*
        $db = Connection::connect();
        
        $stmt = $db->prepare("SELECT * FROM users WHERE id = :userId");
        $stmt->bindParam(":userId", $userId, \PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
        */
    }

    public static function create($data, $password) {
        $result = UserDal::create($userId);
        return $result === false ? [] : $result;
        /*
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
        */
    }

}

?>