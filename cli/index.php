<?php

/*
 * @(#)index.php 1.0 30/11/2024
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

session_start();
require_once 'includes/app.php';
require_once 'includes/functions.php';

// Verificar si el usuario tiene un token
if (isset($_SESSION['token'])) {
    $token = $_SESSION['token'];

    // Validar si el token sigue siendo válido
    if (!validateToken($token)) {
        session_destroy(); // Eliminar la sesión si el token no es válido
        header('Location: index.php?action=login'); // Redirigir al login
        exit;
    }
} else {
    // Si no hay token, redirigir al login
    if (($_GET['action'] ?? '') !== 'login') {
        header('Location: index.php?action=login');
        exit;
    }
}

// Determinar acción
$action = $_GET['action'] ?? 'home';

// Renderizar la vista
switch ($action) {
    case 'login':
        require 'includes/login.php';
        break;
    case 'logout':
        session_destroy();
        header('Location: index.php?action=login');
        break;
    case 'post':
        require 'includes/post.php';
        break;
    case 'author':
        require 'includes/author.php';
        break;
    default:
        require 'includes/home.php';
        break;
}
