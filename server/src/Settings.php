<?php

namespace Project\Data;

use Project\Database\Database;

class Settings
{
    private $database;

    public function __construct()
    {
        $this->database = Database::createObject();
    }

    public function saveSettings($settingsArray)
    {
        foreach ($settingsArray as $key => $value){
            if($this->checkIssetSetting($key)){
                    $this->updateSetting($key,$value);
            } else {
                $this->addSetting($key,$value);
            }
        }
        return true;
    }
    private function checkIssetSetting($key)
    {
        return $this->database->con->query("SELECT * FROM Settings WHERE setting = '$key'")->fetch();
    }
    private function addSetting($key, $value)
    {
        return $this->database->con->query("INSERT INTO Settings(setting, value) values('$key', '$value')");
    }
    private function updateSetting($key,$value)
    {
        return $this->database->con->query("UPDATE Settings SET value = '$value' WHERE setting = '$key'");
    }
    public function getAllSettings()
    {
        $settingsArray = [];
        $fetchedSettings = $this->database->con->query("SELECT * FROM Settings")->fetchAll();
        foreach ($fetchedSettings as $fetchedSetting) {
            $settingsArray[$fetchedSetting['setting']] = $fetchedSetting['value'];
        }

        return $settingsArray;
    }

    public function getSettingByKey($key) {
        $setting = $this->database->con->query("SELECT * FROM Settings WHERE setting = '$key'")->fetch();
        return $setting['value'] ?? null;
    }
}