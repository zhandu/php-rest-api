<?php
namespace App;

use PDO;
use PDOException;

class DatabaseService {
    private static $connection = null;

    public static function setConnection() {
        try {
            self::$connection = new PDO(
                "mysql:host=" . $_ENV["DB_HOST"] . ";dbname=" . $_ENV["DB_NAME"] . ";charset=utf8",
                $_ENV["DB_USER"],
                $_ENV["DB_PASSWORD"],
                array(
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                )
            );
        } catch (PDOException $e) {
            http_response_code(500);
            die();
        }
    }

    public static function getConnection() {
        if (self::$connection === null) {
            self::setConnection();
        }
        return self::$connection;
    }
}
?>