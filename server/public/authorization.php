<?php
session_start();
require_once '../vendor/autoload.php';

use Project\Authorization\Authorization;

if (isset($_POST['registration'])) {
    $registration = Authorization::registration($_POST['userlogin'], $_POST['userpassword']);
    if ($registration === true) {
        $_SESSION['userLogin'] = $_POST['userlogin'];
        header('Location: /data.php');
    } else {
        echo $registration;
    }
}
if (isset($_POST['authorization'])) {
    $authorization = Authorization::login($_POST['userlogin'], $_POST['userpassword']);
    if ($authorization === true) {
        $_SESSION['userLogin'] = $_POST['userlogin'];
        header('Location: /data.php');
    } else {
        echo $authorization;
    }
}
if (isset($_POST['exit'])) {
    unset($_SESSION['userLogin']);
    header('Location: /authorization.html');
}