<?php

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