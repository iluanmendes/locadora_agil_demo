<?php

class Database
{
    private static $pdo;

    public static function getConnection()
    {
        if (!self::$pdo) {
            $host = "10.91.49.22";
            $db   = "locadora_agil";
            $user = "admin";
            $pass = "123456";

            self::$pdo = new PDO(
                "mysql:host=$host;dbname=$db;charset=utf8",
                $user,
                $pass,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        }

        return self::$pdo;
    }
}
