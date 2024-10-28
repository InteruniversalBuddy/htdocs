<?php
namespace lib;

use Exception;
use PDO;
use PDOException;

abstract class response {
    public static function successJSON(mixed $array=[], string $message='Erfolgreiche durchführung') {
        http_response_code(200);
        $array[] = ['success' => $message];
        header('HTTP/1.0 200 OK');
        header('Content-Type: application/json');
        echo json_encode($array);
    }

    public static function errorJSON(mixed $array=[], string $message='Fehlerhafte durchführung') {
        http_response_code(500);
        $array[] = ['error' => $message];
        header('HTTP/1.0 500 OK');
        header('Content-Type: application/json');
        echo json_encode($array);
    }
}