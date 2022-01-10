<?php

namespace Project\Database;

use PDO;

class Database
{
    private static $obj;

    private function __clone()
    {
        return false;
    }

    private function __wakeup()
    {
        return false;
    }

    private function __construct()
    {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        try {
            $this->con = new PDO (
                'mysql:host=a_level_nix_mysql;dbname=UsersData', 'root', 'cbece_gead-cebfa', $options);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            die();
        }
    }

    public static function createObject()
    {
        if (!is_object(self::$obj)) {
            self::$obj = new Database();
        }
        return self::$obj;
    }
}
