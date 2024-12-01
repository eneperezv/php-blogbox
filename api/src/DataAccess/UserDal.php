<?php

/*
 * @(#)UserDal.php 1.0 30/11/2024
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

class UserDal{

    public static function findById($serviceId) {
        $db = Connection::connect();
        
        $stmt = $db->prepare("SELECT * FROM services WHERE id = :serviceId");
        $stmt->bindParam(":serviceId", $serviceId, \PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result === false ? [] : $result;
    }

    public static function findByBusinessId($businessId) {
        $db = Connection::connect();
        
        $stmt = $db->prepare("SELECT * FROM services WHERE id_business_services = :businessId");
        $stmt->bindParam(":businessId", $businessId, \PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result === false ? [] : $result;
    }

    public static function findAll() {
        $db = Connection::connect();
        
        $stmt = $db->prepare("SELECT * FROM services");
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result === false ? [] : $result;
    }

    public static function create($data) {
        $db = Connection::connect();
    
        try {
            $db->beginTransaction();
            $stmt = $db->prepare("INSERT INTO services (name, duration_minutes, price) 
                                  VALUES (:name, :duration_minutes, :price)");
            $stmt->bindParam(":name", $data['name'], \PDO::PARAM_STR);
            $stmt->bindParam(":duration_minutes", $data['duration_minutes'], \PDO::PARAM_INT);
            $stmt->bindParam(":price", $data['price'], \PDO::PARAM_STR);
            $stmt->execute();
            $serviceId = $db->lastInsertId();
            $db->commit();

            return self::findById($serviceId);
        } catch (\PDOException $e) {
            $db->rollBack();
            throw new \Exception("Error al crear el servicio: " . $e->getMessage());
        }
    }

}

?>