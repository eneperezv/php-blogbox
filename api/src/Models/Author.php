<?php

class Author{

	public static function findById($authorId) {
        $result = AuthorDal::findById($authorId);
        return $result === false ? [] : $result;
    }

}

?>