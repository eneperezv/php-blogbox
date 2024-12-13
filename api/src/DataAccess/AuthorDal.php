<?php

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