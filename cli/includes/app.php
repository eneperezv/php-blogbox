<?php

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


?>