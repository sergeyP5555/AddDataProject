<?php
namespace Project\Data\Methods;

use Project\Data\Settings;
use Project\Data\Singleton;

class TxtClass extends Singleton implements MethodInterface
{
    protected $fileHandle;

    protected function __construct()
    {
        $settings = new Settings();
        $fileName = $settings->getSettingByKey('txtFile') ?? 'data.txt';
        $this->fileHandle = fopen($fileName, 'a+');
    }

    public function __destruct()
    {
        fclose($this->fileHandle);
    }

    public function writeData($message)
    {
        fwrite($this->fileHandle, "{$message} \n");
    }
    public function getAllData()
    {
        $txtData = [];
        while (!feof($this->fileHandle)){
            $line = fgets($this->fileHandle);
            if ($line != '') {
                $txtData[] = $line;
            }
        }
        return $txtData;
    }
}