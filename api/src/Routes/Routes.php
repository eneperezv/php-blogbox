<?php

$arrayRutas = explode("/",$_SERVER['REQUEST_URI']);

if(count(array_filter($arrayRutas)) == 2){
    // ---- NO EXISTE PUNTO DE ACCESO INICIAL
    $json = array("detalle"=>"No existe el recurso");
    Response::error('No existe el recurso',$json,404);
}else{
    // ---- ENCUENTRA PUNTO DE ACCESO
    if(count(array_filter($arrayRutas)) == 3){
        // ------------------------------------------------------------------------------------------------
        // ------------------------------------------------------------------------------------------------
        // ENDPOINT: /auth
        // ------------------------------------------------------------------------------------------------
        // ------------------------------------------------------------------------------------------------
        if(array_filter($arrayRutas)[3] == "auth"){
            if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST" ){
                $body = json_decode(file_get_contents('php://input'), true);

                // Validar que existen los datos
                if (isset($body['email']) && isset($body['password'])) {
                    $datos = array(
                        'email' => $body['email'],
                        'password' => $body['password']
                    );
                    AuthController::login($body['email'], $body['password']);
                } else {
                    $err = array('error' => 'Faltan datos necesarios.');
                    Response::error('Bad Request', $err, 400);
                }
                
            }
        }
        // ------------------------------------------------------------------------------------------------
        // ------------------------------------------------------------------------------------------------
        // ENDPOINT: /register
        // ------------------------------------------------------------------------------------------------
        // ------------------------------------------------------------------------------------------------
        if (array_filter($arrayRutas)[3] == "register") {
            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST") {
                // Captura los datos enviados en el cuerpo de la solicitud
                $data = json_decode(file_get_contents("php://input"), true);

                if (isset($data['email']) && 
                        isset($data['password']) && 
                        isset($data['role']) && 
                        isset($data['name']) && 
                        isset($data['phone']) && 
                        isset($data['timezone'])
                    ) {
                    AuthController::register($data);
                } else {
                    $err = array('error' => 'Faltan datos necesarios.');
                    Response::error('Bad Request', $err, 400);
                }
            } else {
                $err = array('error' => 'Método no permitido.');
                Response::error("Method Not Allowed", $err, 405);
            }
        }
    }elseif(count(array_filter($arrayRutas)) >= 4){
        // ------------------------------------------------------------------------------------------------
        // ------------------------------------------------------------------------------------------------
        // MODULE: /services
        // ------------------------------------------------------------------------------------------------
        // ------------------------------------------------------------------------------------------------
        if (array_filter($arrayRutas)[3] == "services"){
            // ------------------------------------------------------------------------------------------------
            // ------------------------------------------------------------------------------------------------
            // ENDPOINT: /services/create
            // ------------------------------------------------------------------------------------------------
            // ------------------------------------------------------------------------------------------------
            if (array_filter($arrayRutas)[4] == "create"){
                if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST") {

                    $headers = function_exists('getallheaders') ? getallheaders() : [];
                    $errors = Utils::headerTokenValidate($headers);
                    if (!empty($errors)) {
                        return Response::error('Ha ocurrido un error en la solicitud.', $errors, 422);
                        exit();
                    }

                    $data = json_decode(file_get_contents("php://input"), true);
                    if (isset($data['name']) && 
                        isset($data['duration_minutes']) && 
                        isset($data['price'])) {
                        ServiceController::create($data);
                    } else {
                        $err = array('error' => 'Faltan datos necesarios.');
                        Response::error('Bad Request', $err, 400);
                    }
                } else {
                    $err = array('error' => 'Método no permitido.');
                    Response::error("Method Not Allowed", $err, 405);
                }
            }
            // ------------------------------------------------------------------------------------------------
            // ------------------------------------------------------------------------------------------------
            // ENDPOINT: /services/find-by-id/{service_id}
            // ------------------------------------------------------------------------------------------------
            // ------------------------------------------------------------------------------------------------
            if (array_filter($arrayRutas)[4] == "find-by-id"){
                if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET") {
                    if(isset($arrayRutas[5]) && Validator::validateInteger($arrayRutas[5])){

                        $headers = function_exists('getallheaders') ? getallheaders() : [];
                        $errors = Utils::headerTokenValidate($headers);
                        if (!empty($errors)) {
                            return Response::error('Ha ocurrido un error en la solicitud.', $errors, 422);
                            exit();
                        }

                        $service = Service::findById($arrayRutas[5]);
                        if(empty($service)){
                            $err = array('error' => 'No se encuentra el servicio solicitado.');
                            Response::error('No Content', $err, 204);
                        }else{
                            Response::success('OK', $service, 200, 'service');
                        }
                    }else{
                        $err = array('error' => 'Faltan datos necesarios.');
                        Response::error('Bad Request', $err, 400);
                    }
                }else{
                    $err = array('error' => 'Método no permitido.');
                    Response::error("Method Not Allowed", $err, 405);
                }
            }
            // ------------------------------------------------------------------------------------------------
            // ------------------------------------------------------------------------------------------------
            // ENDPOINT: /services/find-by-business/{business_id}
            // ------------------------------------------------------------------------------------------------
            // ------------------------------------------------------------------------------------------------
            if (array_filter($arrayRutas)[4] == "find-by-business"){
                if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET") {
                    if(isset($arrayRutas[5]) && Validator::validateInteger($arrayRutas[5])){

                        $headers = function_exists('getallheaders') ? getallheaders() : [];
                        $errors = Utils::headerTokenValidate($headers);
                        if (!empty($errors)) {
                            return Response::error('Ha ocurrido un error en la solicitud.', $errors, 422);
                            exit();
                        }

                        $service = Service::findByBusinessId($arrayRutas[5]);
                        if(empty($service)){
                            $err = array('error' => 'No se encuentran servicios asociados a la empresa.');
                            Response::error('No Content', $err, 200);
                        }else{
                            Response::success('OK', $service, 200, 'service');
                        }
                    }else{
                        $err = array('error' => 'Faltan datos necesarios.');
                        Response::error('Bad Request', $err, 400);
                    }
                }else{
                    $err = array('error' => 'Método no permitido.');
                    Response::error("Method Not Allowed", $err, 405);
                }
            }
            // ------------------------------------------------------------------------------------------------
            // ------------------------------------------------------------------------------------------------
            // ENDPOINT: /services/find-all
            // ------------------------------------------------------------------------------------------------
            // ------------------------------------------------------------------------------------------------
            if (array_filter($arrayRutas)[4] == "find-all"){
                if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET") {
                    $headers = function_exists('getallheaders') ? getallheaders() : [];
                    $errors = Utils::headerTokenRootValidate($headers);
                    if (!empty($errors)) {
                        return Response::error('Ha ocurrido un error en la solicitud.', $errors, 422);
                        exit();
                    }

                    $service = Service::findAll();
                    if(empty($service)){
                        $err = array('error' => 'No se encuentran servicios.');
                        Response::error('No Content', $err, 200);
                    }else{
                        Response::success('OK', $service, 200, 'service');
                    }
                }else{
                    $err = array('error' => 'Método no permitido.');
                    Response::error("Method Not Allowed", $err, 405);
                }
            }
        }
        // ------------------------------------------------------------------------------------------------
        // ------------------------------------------------------------------------------------------------
        // MODULE: /operators
        // ------------------------------------------------------------------------------------------------
        // ------------------------------------------------------------------------------------------------
        if (array_filter($arrayRutas)[3] == "operators"){
            // ------------------------------------------------------------------------------------------------
            // ------------------------------------------------------------------------------------------------
            // ENDPOINT: /operators/find-by-id/{service_id}
            // ------------------------------------------------------------------------------------------------
            // ------------------------------------------------------------------------------------------------
            if (array_filter($arrayRutas)[4] == "find-by-id"){
                if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET") {
                    if(isset($arrayRutas[5]) && Validator::validateInteger($arrayRutas[5])){

                        $headers = function_exists('getallheaders') ? getallheaders() : [];
                        $errors = Utils::headerTokenValidate($headers);
                        if (!empty($errors)) {
                            return Response::error('Ha ocurrido un error en la solicitud.', $errors, 422);
                            exit();
                        }

                        $operator = Operator::findById($arrayRutas[5]);
                        if(empty($operator)){
                            $err = array('error' => 'No se encuentra la disponibilidad para el operadot.');
                            Response::error('No Content', $err, 204);
                        }else{
                            Response::success('OK', $operator, 200, 'op-schedule');
                        }
                    }else{
                        $err = array('error' => 'Faltan datos necesarios.');
                        Response::error('Bad Request', $err, 400);
                    }
                }else{
                    $err = array('error' => 'Método no permitido.');
                    Response::error("Method Not Allowed", $err, 405);
                }
            }
            // ------------------------------------------------------------------------------------------------
            // ------------------------------------------------------------------------------------------------
            // ENDPOINT: /operators/find-by-business/{business_id}
            // ------------------------------------------------------------------------------------------------
            // ------------------------------------------------------------------------------------------------
            if (array_filter($arrayRutas)[4] == "find-by-business"){
                if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET") {
                    if(isset($arrayRutas[5]) && Validator::validateInteger($arrayRutas[5])){

                        $headers = function_exists('getallheaders') ? getallheaders() : [];
                        $errors = Utils::headerTokenValidate($headers);
                        if (!empty($errors)) {
                            return Response::error('Ha ocurrido un error en la solicitud.', $errors, 422);
                            exit();
                        }

                        $operators = Operator::findByBusinessId($arrayRutas[5]);
                        if(empty($operators)){
                            $err = array('error' => 'No se encuentran operadores asociados a la empresa.');
                            Response::error('No Content', $err, 200);
                        }else{
                            Response::success('OK', $operators, 200, 'operator');
                        }
                    }else{
                        $err = array('error' => 'Faltan datos necesarios.');
                        Response::error('Bad Request', $err, 400);
                    }
                }else{
                    $err = array('error' => 'Método no permitido.');
                    Response::error("Method Not Allowed", $err, 405);
                }
            }
            // ------------------------------------------------------------------------------------------------
            // ------------------------------------------------------------------------------------------------
            // ENDPOINT: /operators/find-all
            // ------------------------------------------------------------------------------------------------
            // ------------------------------------------------------------------------------------------------
            if (array_filter($arrayRutas)[4] == "find-all"){
                if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET") {
                    $headers = function_exists('getallheaders') ? getallheaders() : [];
                    $errors = Utils::headerTokenRootValidate($headers);
                    if (!empty($errors)) {
                        return Response::error('Ha ocurrido un error en la solicitud.', $errors, 422);
                        exit();
                    }

                    $operators = Operator::findAll();
                    if(empty($operators)){
                        $err = array('error' => 'No se encuentran operadores.');
                        Response::error('No Content', $err, 200);
                    }else{
                        Response::success('OK', $operators, 200, 'operator');
                    }
                }else{
                    $err = array('error' => 'Método no permitido.');
                    Response::error("Method Not Allowed", $err, 405);
                }
            }
            // ------------------------------------------------------------------------------------------------
            // ------------------------------------------------------------------------------------------------
            // ENDPOINT: /operators/add-schedule
            // ------------------------------------------------------------------------------------------------
            // ------------------------------------------------------------------------------------------------
            if (array_filter($arrayRutas)[4] == "add-schedule"){
                if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST") {

                    $headers = function_exists('getallheaders') ? getallheaders() : [];
                    $errors = Utils::headerTokenValidate($headers);
                    if (!empty($errors)) {
                        return Response::error('Ha ocurrido un error en la solicitud.', $errors, 422);
                        exit();
                    }

                    $data = json_decode(file_get_contents("php://input"), true);
                    if (isset($data['operator_id']) && 
                        isset($data['start_time']) && 
                        isset($data['end_time']) && 
                        isset($data['date'])) {
                        OperatorController::create($data);
                    } else {
                        $err = array('error' => 'Faltan datos necesarios.');
                        Response::error('Bad Request', $err, 400);
                    }
                } else {
                    $err = array('error' => 'Método no permitido.');
                    Response::error("Method Not Allowed", $err, 405);
                }
            }
        }
        // ------------------------------------------------------------------------------------------------
        // ------------------------------------------------------------------------------------------------
        // MODULE: /appointments
        // ------------------------------------------------------------------------------------------------
        // ------------------------------------------------------------------------------------------------
        if (array_filter($arrayRutas)[3] == "appointments"){
            // ------------------------------------------------------------------------------------------------
            // ------------------------------------------------------------------------------------------------
            // ENDPOINT: /appointments/find-by-business/{business_id}
            // ------------------------------------------------------------------------------------------------
            // ------------------------------------------------------------------------------------------------
            if (array_filter($arrayRutas)[4] == "find-by-business"){
                if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET") {
                    if(isset($arrayRutas[5]) && Validator::validateInteger($arrayRutas[5])){

                        $headers = function_exists('getallheaders') ? getallheaders() : [];
                        $errors = Utils::headerTokenValidate($headers);
                        if (!empty($errors)) {
                            return Response::error('Ha ocurrido un error en la solicitud.', $errors, 422);
                            exit();
                        }
                        /*
                        $operators = Operator::findByBusinessId($arrayRutas[5]);
                        if(empty($operators)){
                            $err = array('error' => 'No se encuentran operadores asociados a la empresa.');
                            Response::error('No Content', $err, 200);
                        }else{
                            Response::success('OK', $operators, 200, 'operator');
                        }
                            */
                    }else{
                        $err = array('error' => 'Faltan datos necesarios.');
                        Response::error('Bad Request', $err, 400);
                    }
                }else{
                    $err = array('error' => 'Método no permitido.');
                    Response::error("Method Not Allowed", $err, 405);
                }
            }

        }
    }
}
?>