<?php

namespace Project\Data\Methods;

use Project\Data\Settings;
use Project\Data\Singleton;

class CsvClass extends Singleton implements MethodInterface
{
    protected $fileHandle;

    protected function __construct()
    {
        $settings = new Settings();
        $fileName = $settings->getSettingByKey('csvFile') ?? 'data.csv';
        $this->fileHandle = fopen('files/'.$fileName, 'a+');
    }

    public function __destruct()
    {
        fclose($this->fileHandle);
    }

    public function writeData($message)
    {
        fwrite($this->fileHandle, "{$message}; \n");
    }
    public function getAllData()
    {
        $csvData = [];
        while (!feof($this->fileHandle)){
            $line = fgets($this->fileHandle);
            if ($line != '') {
                $csvData[] = $line;
            }
        }
        return $csvData;
    }
}