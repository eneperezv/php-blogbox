<?php

function authenticateUser($email, $password) {
    $apiUrl = 'http://localhost:8090/proyectos/php-blogbox-api/user/authenticate';
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

function fetchPosts($token) {
    $apiUrl = 'http://localhost:8090/proyectos/php-blogbox-api/post/find-all';
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

?>