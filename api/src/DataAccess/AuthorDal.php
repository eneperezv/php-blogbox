<?php

/*
 * @(#)AuthorDal.php 1.0 13/12/2024
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

class AuthorDal{

	public static function findById($authorId) {
        $db = Connection::connect();
        
        $stmt = $db->prepare("SELECT id,name,email,phone,role,timezone FROM users WHERE id = :authorId");
        $stmt->bindParam(":authorId", $authorId, \PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result === false ? [] : $result;
    }

}

?>