<?php

require_once 'includes/functions.php';

// Determinar acción solicitada
$action = $_GET['action'] ?? 'login';

// Renderizar la vista adecuada
switch ($action) {
    case 'home':
        require 'includes/home.php';
        break;
    case 'post':
        require 'includes/post.php';
        break;
    case 'author':
        require 'includes/author.php';
        break;
    default:
        require 'includes/login.php';
        break;
}

?>