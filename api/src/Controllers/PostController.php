<?php

/*
 * @(#)PostController.php 1.0 01/12/2024
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

class PostController{

    public static function findById($postId) {

        $errors = Validator::validateConsultaPorId($postId);
        if (!empty($errors)) {
            return Response::error('Ha ocurrido un error en la solicitud.', $errors, 422);
        }

        try {
            $postDetails = Post::findById($postId);

            if ($postDetails) {
                return Response::success('Consulta de datos', $postDetails, 200, 'post');
            } else {
                $err = array('error' => 'Error al consultar el post.');
                return Response::error('Ha ocurrido un error en la solicitud.', $err, 422);
            }
        } catch (\Exception $e) {
            $err = array('error' => 'Error en el servidor: ' . $e->getMessage());
            return Response::error('Error en el servidor', $err, 500);
        }
        
    }

    public static function findByAuthorId($authorId) {

        $errors = Validator::validateConsultaPorId($authorId);
        if (!empty($errors)) {
            return Response::error('Ha ocurrido un error en la solicitud.', $errors, 422);
        }

        try {
            $postDetails = Post::findByAuthorId($authorId);

            if ($postDetails) {
                return Response::success('Consulta de datos', $postDetails, 200, 'post');
            } else {
                $err = array('error' => 'Error al consultar posts por autor.');
                return Response::error('Ha ocurrido un error en la solicitud.', $err, 422);
            }
        } catch (\Exception $e) {
            $err = array('error' => 'Error en el servidor: ' . $e->getMessage());
            return Response::error('Error en el servidor', $err, 500);
        }
        
    }

    public static function findAllPosts() {

        try {
            $postDetails = Post::findAll();

            if ($postDetails) {
                return Response::success('Consulta de datos', $postDetails, 200, 'post');
            } else {
                $err = array('error' => 'Error al consultar posts.');
                return Response::error('Ha ocurrido un error en la solicitud.', $err, 422);
            }
        } catch (\Exception $e) {
            $err = array('error' => 'Error en el servidor: ' . $e->getMessage());
            return Response::error('Error en el servidor', $err, 500);
        }
        
    }

    public static function create($data) {

        $errors = Validator::validateDataPost($data);
        if (!empty($errors)) {
            return Response::error('Ha ocurrido un error en la solicitud.', $errors, 422);
        }

        try {
            $postDetails = Post::create($data);

            if ($postDetails) {
                return Response::success('Post creado con éxito.', $postDetails, 200, 'post');
            } else {
                $err = array('error' => 'Error al registrar el post.');
                return Response::error('Ha ocurrido un error en la solicitud.', $err, 422);
            }
        } catch (\Exception $e) {
            $err = array('error' => 'Error en el servidor: ' . $e->getMessage());
            return Response::error('Error en el servidor', $err, 500);
        }
        
    }

}

?>