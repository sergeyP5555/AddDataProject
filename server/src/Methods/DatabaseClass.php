<?php

namespace Project\Data\Methods;

use Project\Data\Settings;
use Project\Data\Singleton;
use PDO;

class DatabaseClass extends Singleton implements MethodInterface
{

    protected function __construct()
    {
        $settings = new Settings();
        $host = $settings->getSettingByKey('dbHost') ?? 'a_level_nix_mysql:3306';
        $dbName = $settings->getSettingByKey('dbName') ?? 'UsersData';
        $user = $settings->getSettingByKey('dbUser') ?? 'root';
        $password = $settings->getSettingByKey('dbPassword') ?? 'cbece_gead-cebfa';
        $db = [
            'dns'  => "mysql:host=$host;dbname=$dbName;charset=utf8",
            'user' => $user,
            'pass' => $password
        ];
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        $this->pdo = new PDO($db['dns'], $db['user'], $db['pass'], $options);
    }

    public function __destruct()
    {
       unset($this->pdo);
    }

    public function writeData($message)
    {
      $this->pdo->query("INSERT INTO Data (message) values('$message')");
    }
    public function getAllData(){
        $messages = [];
        $dbMessages = $this->pdo->query("SELECT * FROM Data")->fetchAll();
        foreach ($dbMessages as $dbMessage) {
            $messages[] = $dbMessage['message'];
        }
        return $messages;
    }
}