<?php

namespace Project\Data;

class Data
{
    private $message, $source;

    public function __construct($message, $source)
    {
        $this->message = $message;
        $this->source = $source;
    }

    public function writeData()
    {
        $instance = $this->method($this->source);
        $instance->writeData($this->message);
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