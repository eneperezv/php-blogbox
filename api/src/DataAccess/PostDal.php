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

class PostDal{

    public static function findById($postId) {
        $db = Connection::connect();
        
        $stmt = $db->prepare("SELECT * FROM posts WHERE id = :postId");
        $stmt->bindParam(":postId", $postId, \PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result === false ? [] : $result;
    }

    public static function findByAuthorId($authorId) {
        $db = Connection::connect();
        
        $stmt = $db->prepare("SELECT * FROM posts WHERE author_id = :author_id");
        $stmt->bindParam(":author_id", $authorId, \PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result === false ? [] : $result;
    }

    public static function findAllPosts() {
        $db = Connection::connect();
        
        $stmt = $db->prepare("SELECT * FROM posts");
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result === false ? [] : $result;
    }

    public static function create($data) {
        $db = Connection::connect();

        $fechaHoy = date('Y-m-d H:i:s');
    
        try {
            $db->beginTransaction();
            $stmt = $db->prepare("INSERT INTO posts (title, content, author_id, created_at, updated_at) 
                                  VALUES (:title, :content, :author_id, :created_at, :updated_at)");
            $stmt->bindParam(":title", $data['title'], \PDO::PARAM_STR);
            $stmt->bindParam(":content", $data['content'], \PDO::PARAM_STR);
            $stmt->bindParam(":author_id", $data['author_id'], \PDO::PARAM_INT);
            $stmt->bindParam(":created_at", $fechaHoy, \PDO::PARAM_STR);
            $stmt->bindParam(":updated_at", $fechaHoy, \PDO::PARAM_STR);
            $stmt->execute();
            $postId = $db->lastInsertId();
            $db->commit();

            return self::findById($postId);
        } catch (\PDOException $e) {
            $db->rollBack();
            throw new \Exception("Error al crear el post: " . $e->getMessage());
        }
    }

    public static function setUpvote($data){
        //$result = PostDal::setUpvote($data);
        //return $result === false ? [] : $result;
    }

    public static function getUpvotes($postId){
        //$result = PostDal::getUpvotes($postId);
        //return $result === false ? [] : $result;
    }

    public static function setComment($data){
        //$result = PostDal::setComment($data);
        //return $result === false ? [] : $result;
    }

    public static function getComments($postId){
        //$result = PostDal::getComments($postId);
        //return $result === false ? [] : $result;
    }

}

?>