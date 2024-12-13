<?php

/*
 * @(#)functions.php 1.0 30/11/2024
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

 // -------------------------------------------
 // AUTH --------------------------------------
 // -------------------------------------------
function authenticateUser($email, $password) {
    $apiUrl = getEndpoint('api.users.authenticate');
    //$apiUrl = 'http://localhost:8090/proyectos/php-blogbox-api/auth';
    $data = ['email' => $email, 'password' => $password];
    $options = [
        'http' => [
            'header'  => "Content-Type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ],
    ];
    $context  = stream_context_create($options);
    $response = file_get_contents($apiUrl, false, $context);
    return json_decode($response, true);
}

function validateToken($token) {
    $apiUrl = getEndpoint('api.token.validate');
    //$apiUrl = 'http://localhost:8090/proyectos/php-blogbox-api/validate-token';
    $options = [
        'http' => [
            'header' => "Authorization: Bearer $token\r\n",
            'method' => 'GET'
        ],
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($apiUrl, false, $context);
    $data = json_decode($response, true);

    return $data['status'] === 'OK';
}

// -------------------------------------------
// POSTS -------------------------------------
// -------------------------------------------
function fetchPosts($token) {
    $apiUrl = getEndpoint('api.posts.find_all');
    //$apiUrl = 'http://localhost:8090/proyectos/php-blogbox-api/post/find-all-posts';
    $options = [
        'http' => [
            'header' => "Authorization: Bearer $token\r\n",
        ],
    ];
    $context  = stream_context_create($options);
    $response = file_get_contents($apiUrl, false, $context);
    $data = json_decode($response, true);
    return $data['response_data']['content'] ?? [];
}

function fetchPostById($token,$postId){
    $apiUrl = getEndpoint('api.posts.find_by_id').$postId;
    //$apiUrl = 'http://localhost:8090/proyectos/php-blogbox-api/post/find-by-id/'.$postId;
    $options = [
        'http' => [
            'header' => "Authorization: Bearer $token\r\n",
            'method' => 'GET'
        ],
    ];
    $context  = stream_context_create($options);
    $response = file_get_contents($apiUrl, false, $context);
    $data = json_decode($response, true);
    return $data['response_data']['content'] ?? [];
}

function fetchPostByAuthor($token,$authorId){
    $apiUrl = getEndpoint('api.posts.find_by_author').$authorId;
    //$apiUrl = 'http://localhost:8090/proyectos/php-blogbox-api/post/find-by-id/'.$postId;
    $options = [
        'http' => [
            'header' => "Authorization: Bearer $token\r\n",
            'method' => 'GET'
        ],
    ];
    $context  = stream_context_create($options);
    $response = file_get_contents($apiUrl, false, $context);
    $data = json_decode($response, true);
    return $data['response_data']['content'] ?? [];
}

// -------------------------------------------
// AUTHOR -------------------------------------
// -------------------------------------------
function fetchAuthorById($token,$authorId){
    $apiUrl = getEndpoint('api.author.find_by_id').$authorId;
    //$apiUrl = 'http://localhost:8090/proyectos/php-blogbox-api/post/find-by-id/'.$postId;
    $options = [
        'http' => [
            'header' => "Authorization: Bearer $token\r\n",
            'method' => 'GET'
        ],
    ];
    $context  = stream_context_create($options);
    $response = file_get_contents($apiUrl, false, $context);
    $data = json_decode($response, true);
    return $data['response_data']['content'] ?? [];
}

?>