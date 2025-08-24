<?php

/*
 * @(#)app.php 1.0 12/12/2024
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

function loadPropertiesFile($filePath) {
    if (!file_exists($filePath)) {
        throw new Exception("El archivo de propiedades no existe: $filePath");
    }

    $properties = [];
    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        // Ignorar comentarios
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        // Dividir la línea en clave y valor
        $parts = explode('=', $line, 2);
        if (count($parts) === 2) {
            $key = trim($parts[0]);
            $value = trim($parts[1]);
            $properties[$key] = $value;
        }
    }

    return $properties;
}

function getProperty($key, $properties) {
    if (isset($properties[$key])) {
        return $properties[$key];
    }
    throw new Exception("La clave '$key' no existe en las propiedades.");
}

function getEndpoint($key){
    try {
        // Cargar el archivo de propiedades
        $properties = loadPropertiesFile('config/acc.properties');

        // Leer la base URL y los endpoints específicos
        $baseUrl   = getProperty('api.base_url', $properties);
        $endponint = getProperty($key, $properties);
        //$findAllPostsEndpoint = getProperty('api.posts.find_all', $properties);
        //$upvoteEndpoint = getProperty('api.votes.upvote', $properties);

        // Combinar la base URL con un endpoint
        $fullUrl = $baseUrl . $endponint;
        return $fullUrl;
        //echo "Endpoint completo para 'find_all': $fullUrl\n";
    } catch (Exception $e) {
        return '';
        //echo "Error: " . $e->getMessage();
    }
}


?>