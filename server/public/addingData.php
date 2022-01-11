<?php
session_start();
require_once '../vendor/autoload.php';
use Project\Data\Data;

if(isset($_POST['addDataBtn'])){
    $data = new Data($_POST['message'], $_POST['source']);
    $data->writeData();
    header('Location: /data.php');
}
