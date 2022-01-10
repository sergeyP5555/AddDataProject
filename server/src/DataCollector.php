<?php

namespace Project\Data;

class DataCollector
{
    public function getAllData()
    {
        $allData['database'] = $this->getDataFromDatabase();
        $allData['csv'] = $this->getDataFromCsv();
        $allData['txt'] = $this->getDataFromTxt();
        return $allData;
    }

    public function getDataFromDatabase()
    {
        $database = $this->method('database');
        return $database->getAllData();
    }

    public function getDataFromCsv()
    {
        $csv = $this->method('csv');
        return $csv->getAllData();
    }

    public function getDataFromTxt()
    {
        $txt = $this->method('txt');
        return $txt->getAllData();
    }

    private function method($classFile)
    {
        $listenerClass = 'Project\\Data\\Methods\\' . ucfirst($classFile) . 'Class';
        if (class_exists($listenerClass)) {
            return $listenerClass::getInstance();
        } else {
            exit("This class does not exist! $classFile \n $listenerClass");
        }
    }
}