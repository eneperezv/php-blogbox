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
        
        $stmt = $db->prepare("SELECT posts.*, users.name AS author_name,
                                (SELECT COUNT(*) FROM votes WHERE votes.post_id = posts.id AND votes.option = 'UP') AS upvote_count,
                                (SELECT COUNT(*) FROM votes WHERE votes.post_id = posts.id AND votes.option = 'DOWN') AS downvote_count,
                                (SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id) AS comment_count
                            FROM posts
                            LEFT JOIN users ON posts.author_id = users.id WHERE posts.id = :postId ORDER BY posts.id DESC");
        $stmt->bindParam(":postId", $postId, \PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result === false ? [] : $result;
    }

    public static function findByAuthorId($authorId) {
        $db = Connection::connect();
        
        $stmt = $db->prepare("SELECT posts.*, users.name AS author_name,
                                (SELECT COUNT(*) FROM votes WHERE votes.post_id = posts.id AND votes.option = 'UP') AS upvote_count,
                                (SELECT COUNT(*) FROM votes WHERE votes.post_id = posts.id AND votes.option = 'DOWN') AS downvote_count,
                                (SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id) AS comment_count
                            FROM posts
                            LEFT JOIN users ON posts.author_id = users.id WHERE posts.author_id = :author_id ORDER BY posts.id DESC");
        $stmt->bindParam(":author_id", $authorId, \PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result === false ? [] : $result;
    }

    public static function findAllPosts() {
        $db = Connection::connect();
        
        $stmt = $db->prepare("SELECT posts.*, users.name AS author_name,
                                (SELECT COUNT(*) FROM votes WHERE votes.post_id = posts.id AND votes.option = 'UP') AS upvote_count,
                                (SELECT COUNT(*) FROM votes WHERE votes.post_id = posts.id AND votes.option = 'DOWN') AS downvote_count,
                                (SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id) AS comment_count
                            FROM posts
                            LEFT JOIN users ON posts.author_id = users.id ORDER BY posts.id DESC");
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

    public static function setVote($data){
        $db = Connection::connect();

        $fechaHoy = date('Y-m-d H:i:s');
    
        try {
            $db->beginTransaction();
            $stmt = $db->prepare("INSERT INTO votes (post_id, option, user_id, created_at, updated_at) 
                                  VALUES (:post_id, :option, :user_id, :created_at, :updated_at)");
            $stmt->bindParam(":post_id", $data['post_id'], \PDO::PARAM_INT);
            $stmt->bindParam(":option", $data['option'], \PDO::PARAM_STR);
            $stmt->bindParam(":user_id", $data['user_id'], \PDO::PARAM_INT);
            $stmt->bindParam(":created_at", $fechaHoy, \PDO::PARAM_STR);
            $stmt->bindParam(":updated_at", $fechaHoy, \PDO::PARAM_STR);
            $stmt->execute();
            $voteId = $db->lastInsertId();
            $db->commit();

            return self::getVoteById($voteId);
        } catch (\PDOException $e) {
            $db->rollBack();
            throw new \Exception("Error al crear el vote: " . $e->getMessage());
        }
    }

    public static function getVoteById($voteId){
        $db = Connection::connect();
        
        $stmt = $db->prepare("SELECT * FROM votes WHERE id = :voteId");
        $stmt->bindParam(":voteId", $voteId, \PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result === false ? [] : $result;
    }

    public static function getVotes($postId){
        $db = Connection::connect();
        
        $stmt = $db->prepare("SELECT * FROM votes WHERE post_id = :post_id");
        $stmt->bindParam(":post_id", $postId, \PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result === false ? [] : $result;
    }

    public static function getVotesCount($postId){
        $db = Connection::connect();
        
        $stmt = $db->prepare("SELECT COUNT(1) FROM votes WHERE post_id = :post_id");
        $stmt->bindParam(":post_id", $postId, \PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result === false ? [] : $result;
    }

    public static function setComment($data){
        $db = Connection::connect();

        $fechaHoy = date('Y-m-d H:i:s');
    
        try {
            $db->beginTransaction();
            $stmt = $db->prepare("INSERT INTO comments (post_id, content, user_id, created_at, updated_at) 
                                  VALUES (:post_id, :content, :user_id, :created_at, :updated_at)");
            $stmt->bindParam(":post_id", $data['post_id'], \PDO::PARAM_INT);
            $stmt->bindParam(":content", $data['content'], \PDO::PARAM_STR);
            $stmt->bindParam(":user_id", $data['user_id'], \PDO::PARAM_INT);
            $stmt->bindParam(":created_at", $fechaHoy, \PDO::PARAM_STR);
            $stmt->bindParam(":updated_at", $fechaHoy, \PDO::PARAM_STR);
            $stmt->execute();
            $commentId = $db->lastInsertId();
            $db->commit();

            return self::getCommentById($commentId);
        } catch (\PDOException $e) {
            Logger::warning("Error al crear el comment: ".$e->getMessage());
            $db->rollBack();
            throw new \Exception("Error al crear el comment: " . $e->getMessage());
        }
    }

    public static function getCommentById($commentId){
        $db = Connection::connect();
        
        $stmt = $db->prepare("SELECT * FROM comments WHERE id = :commentId");
        $stmt->bindParam(":commentId", $commentId, \PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result === false ? [] : $result;
    }

    public static function getComments($postId){
        $db = Connection::connect();
        
        $stmt = $db->prepare("SELECT * FROM comments WHERE post_id = :post_id");
        $stmt->bindParam(":post_id", $postId, \PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result === false ? [] : $result;
    }

    public static function getCommentsCount($postId){
        $db = Connection::connect();
        
        $stmt = $db->prepare("SELECT COUNT(1) FROM comments WHERE post_id = :post_id");
        $stmt->bindParam(":post_id", $postId, \PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result === false ? [] : $result;
    }

}

?>