<?php

/*
 * @(#)Post.php 1.0 01/12/2024
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

class Post{

    public static function findById($postId) {
        $result = PostDal::findById($postId);
        return $result === false ? [] : $result;
    }

    public static function findByAuthorId($authorId) {
        $result = PostDal::findByAuthorId($authorId);
        return $result === false ? [] : $result;
    }

    public static function findAllPosts() {
        $result = PostDal::findAllPosts();
        return $result === false ? [] : $result;
    }

    public static function create($data) {
        $result = PostDal::create($data);
        return $result === false ? [] : $result;
    }

    public static function setVote($data){
        $result = PostDal::setVote($data);
        return $result === false ? [] : $result;
    }

    public static function getVotes($postId){
        $result = PostDal::getVotes($postId);
        return $result === false ? [] : $result;
    }

    public static function getVotesCount($postId){
        $result = PostDal::getVotesCount($postId);
        return $result === false ? [] : $result;
    }

    public static function setComment($data){
        $result = PostDal::setComment($data);
        return $result === false ? [] : $result;
    }

    public static function getComments($postId){
        $result = PostDal::getComments($postId);
        return $result === false ? [] : $result;
    }
    
    public static function getCommentsCount($postId){
        $result = PostDal::getCommentsCount($postId);
        return $result === false ? [] : $result;
    }

}

?>