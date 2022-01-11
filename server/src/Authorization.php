<?php

namespace Project\Authorization;

use Project\Database\Database;

class Authorization
{
    public static function login($login, $password)
    {
        $database = Database::createObject();
        $existingUsers = $database->con->query("SELECT * FROM Users WHERE login = '$login'")->fetch();
        if ($existingUsers) {
            if ($existingUsers['password'] == md5($password)) {
                $existingFileSettings = $database->con->query("SELECT * FROM Settings WHERE setting = 'csvFile'")->fetch();
                $loginForFile = trim(str_replace(' ', '_', strtolower($login)));
                if ($existingFileSettings) {
                    $database->con->query("UPDATE Settings SET value = '$loginForFile.csv' WHERE setting = 'csvFile'");
                    $database->con->query("UPDATE Settings SET value = '$loginForFile.txt' WHERE setting = 'txtFile'");
                } else {
                    $database->con->query("INSERT INTO Settings (setting, value) values ('csvFile', '$loginForFile.csv')");
                    $database->con->query("INSERT INTO Settings (setting, value) values ('txtFile', '$loginForFile.txt')");
                }

                return true;
            } else {
                return "Пароль введен неверно!";
            }
        } else {
            return "Вы не зарегестрированы!";
        }

    }

    public static function registration($login, $password)
    {
        $database = Database::createObject();
        $existingUsers = $database->con->query("SELECT * FROM Users WHERE login = '$login'")->fetch();
        if ($existingUsers) {
            return "Такой пользователь уже существует!";
        } else {
            $md5Password = md5($password);
            $query = $database->con->query("INSERT INTO Users (login,password) values('$login', '$md5Password')");

            $existingFileSettings = $database->con->query("SELECT * FROM Settings WHERE setting = 'csvFile'")->fetch();
            $loginForFile = trim(str_replace(' ', '_', strtolower($login)));
            if ($existingFileSettings) {
                $database->con->query("UPDATE Settings SET value = '$loginForFile.csv' WHERE setting = 'csvFile'");
                $database->con->query("UPDATE Settings SET value = '$loginForFile.txt' WHERE setting = 'txtFile'");
            } else {
                $database->con->query("INSERT INTO Settings (setting, value) values ('csvFile', '$loginForFile.csv')");
                $database->con->query("INSERT INTO Settings (setting, value) values ('txtFile', '$loginForFile.txt')");
            }
        }
        if ($query) {
            return true;
        }
        return 'Произошла ошибка!';
    }
}