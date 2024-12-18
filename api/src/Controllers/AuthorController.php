<?php

/*
 * @(#)AuthorController.php 1.0 13/12/2024
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

class AuthorController {

	public static function findById($authorId) {

        $errors = Validator::validateConsultaPorId($authorId);
        if (!empty($errors)) {
            return Response::error('Ha ocurrido un error en la solicitud.', $errors, 422);
        }

        try {
            $authorDetails = Author::findById($authorId);

            if ($authorDetails) {
                return Response::success('Consulta de datos', $authorDetails, 200, 'author');
            } else {
                $err = array('error' => 'Error al consultar el autor.');
                return Response::error('Ha ocurrido un error en la solicitud.', $err, 422);
            }
        } catch (\Exception $e) {
            $err = array('error' => 'Error en el servidor: ' . $e->getMessage());
            return Response::error('Error en el servidor', $err, 500);
        }
        
    }

}

?>