<?php
require_once './ConfigDB.php';

class Database
{
    public static $conn = null;

    public static function getConnection() : PDO {
        if (self::$conn === null) {
            $dsn = 'mysql:host=' . ConfigDB::HOSTNAME . ';dbname=' . ConfigDB::DBNAME . ';charset=utf8mb4';
            Database::$conn = new PDO($dsn, ConfigDB::USERNAME, ConfigDB::PASSWORD);
        }

        return Database::$conn;
    }
}