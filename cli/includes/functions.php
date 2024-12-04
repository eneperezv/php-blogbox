<?php
function fetchPosts() {
    $apiUrl = 'http://localhost:8090/proyectos/php-blogbox-api/post/find-all';
    $response = file_get_contents($apiUrl);
    return json_decode($response, true);
}

function fetchPostById($id) {
    $apiUrl = "http://localhost:8090/proyectos/php-blogbox-api/post/find?id=$id";
    $response = file_get_contents($apiUrl);
    return json_decode($response, true);
}
?>