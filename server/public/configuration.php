<?php
session_start();
require_once '../vendor/autoload.php';

use Project\Data\Settings;

$settings = new Settings();
if (isset($_POST['save'])) {

    $settingsArray = [
        'csvFile' => $_POST['csvFile'],
        'txtFile' => $_POST['txtFile'],
        'dbUser' => $_POST['dbUser'],
        'dbHost' => $_POST['dbHost'],
        'dbPassword' => $_POST['dbPassword'],
        'dbName' => $_POST['dbName'],
        'tableName' => $_POST['tableName'],
    ];

    $saveResult = $settings->saveSettings($settingsArray);
}
$settingsFromDB = $settings->getAllSettings();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet">
    <title>Configuration</title>
</head>
<body>
<form action="configuration.php" method="post">
    <p>CSV</p>          <input type="text" name="csvFile" value="<?= $settingsFromDB['csvFile'] ?? '' ?>"><br>
    <p>TXT</p>          <input type="text" name="txtFile" value="<?= $settingsFromDB['txtFile'] ?? '' ?>"><br>
    <p>DB User</p>      <input type="text" name="dbUser" value="<?= $settingsFromDB['dbUser'] ?? '' ?>"><br>
    <p>DB Host</p>      <input type="text" name="dbHost" value="<?= $settingsFromDB['dbHost'] ?? '' ?>"><br>
    <p>DB Password</p>  <input type="text" name="dbPassword" value="<?= $settingsFromDB['dbPassword'] ?? '' ?>"><br>
    <p>DB Name</p>      <input type="text" name="dbName" value="<?= $settingsFromDB['dbName'] ?? '' ?>"><br>
    <p>Table Name</p>   <input type="text" name="tableName" value="<?= $settingsFromDB['tableName'] ?? '' ?>"><br><br>
    <input type="submit" name="save" id="go_save" value="Save settings"><br>
    <?php
    if ($saveResult) {
        echo '<p>Настройки сохранены успешно!</p>';
    }
    ?>
    <a id="addData" href="addData.php">Вернуться</a>
</form>

</body>
</html>