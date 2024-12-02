<?php

class Post{

    public static function findById($postId) {
        $result = PostDal::findById($postId);
        return $result === false ? [] : $result;

        /*
        $db = Connection::connect();
        
        $stmt = $db->prepare("SELECT * FROM posts WHERE id = :postId");
        $stmt->bindParam(":postId", $postId, \PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result === false ? [] : $result;
        */
    }

    public static function findByAuthorId($authorId) {
        $result = PostDal::findByAuthorId($authorId);
        return $result === false ? [] : $result;
        /*
        $db = Connection::connect();
        
        $stmt = $db->prepare("SELECT * FROM posts WHERE author_id = :author_id");
        $stmt->bindParam(":author_id", $authorId, \PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result === false ? [] : $result;
        */
    }

    public static function findAll() {
        $result = PostDal::findAll();
        return $result === false ? [] : $result;
        /*
        $db = Connection::connect();
        
        $stmt = $db->prepare("SELECT * FROM posts");
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result === false ? [] : $result;
        */
    }

    public static function create($data) {
        $result = PostDal::create($data);
        return $result === false ? [] : $result;
        /*
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
        */
    }

}

?>