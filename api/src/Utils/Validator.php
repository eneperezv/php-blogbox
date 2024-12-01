<?php

class Validator {

    public static function validateEmail(string $email): bool {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function validatePassword(string $password): bool {
        $pattern = "/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/";
        return preg_match($pattern, $password) === 1;
    }

    public static function validateText(string $text): bool {
        $pattern = '/^[a-zA-Z0-9\s.,\'"?!-]+$/u';
        return preg_match($pattern, $text) === 1;
    }
    
    public static function validateInteger($value): bool {
        return filter_var($value, FILTER_VALIDATE_INT) !== false;
    }
    
    public static function validateDecimal($value): bool {
        return filter_var($value, FILTER_VALIDATE_FLOAT) !== false;
    }

    public static function validateTime24H(string $text): bool {
        $format = 'H:i:s';
        $time = DateTime::createFromFormat($format, $text);
        return $time && $time->format($format) === $text;
    }

    public static function validateDate(string $text): bool {
        $format = 'Y-m-d';
        $date = DateTime::createFromFormat($format, $text);
        return $date && $date->format($format) === $text;
    }

    // VALIDACION DE DATOS PARA AUTENTICACION
    public static function validateCredentials(string $email, string $password): array {
        $errors = [];
        if (!self::validateEmail($email)) {
            $errors[] = "El correo electrónico no es válido.";
        }
        if (!self::validatePassword($password)) {
            $errors[] = "La contraseña debe tener al menos 8 caracteres, incluir una letra mayúscula, un número y un carácter especial.";
        }
        return $errors;
    }

    // VALIDACION DE DATOS PARA SERVICES
    public static function validateDataService($data): array {
        $errors = [];
        if (!self::validateText($data['name'])) {
            $errors[] = "El campo 'name' contiene caracteres inválidos.";
        }
        if (!self::validateInteger($data['duration_minutes'])) {
            $errors[] = "El campo 'duration_minutes' debe ser un número entero.";
        }
        if (!self::validateDecimal($data['price'])) {
            $errors[] = "El campo 'price' debe ser un número decimal válido.";
        }
        return $errors;
    }

    // VALIDACION DE DATOS PARA OPERATOR SCHEDULE
    public static function validateDataOperatorSchedule($data): array {
        $errors = [];
        if (!self::validateInteger($data['operator_id'])) {
            $errors[] = "El campo 'operator_id' contiene caracteres inválidos.";
        }
        if (!self::validateTime24H($data['start_time'])) {
            $errors[] = "El campo 'start_time' debe ser en formato HH:MM:SS.";
        }
        if (!self::validateTime24H($data['end_time'])) {
            $errors[] = "El campo 'end_time' debe ser en formato HH:MM:SS.";
        }
        if (!self::validateDate($data['date'])) {
            $errors[] = "El campo 'date' debe ser en formato AAAA-MM-DD.";
        }
        return $errors;
    }

}


?>