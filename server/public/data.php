<?php
session_start();
require_once '../vendor/autoload.php';

use Project\Data\DataCollector;

if (!isset($_SESSION['userLogin'])) {
    header('Location: /authorization.html');
}
$dataCollector = new DataCollector();
$allData = $dataCollector->getAllData();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet">
    <title>Data</title>
</head>
<body>
<p class="data">Здравствуйте, <?= $_SESSION['userLogin'] ?>!</p>
<a id="addData" href="addData.php">Добавить данные</a>

<div class="outputData">
    <?php
    if (!empty($allData['database'])) {
        echo '<h3>Данные в Базе данных</h3>';
        echo '<ul>';
        foreach ($allData['database'] as $dbData) {
            echo "<li>$dbData</li>";
        }
        echo '</ul>';
    }
    if (!empty($allData['csv'])) {
        echo '<h3>Данные в CSV файле</h3>';
        echo '<ul>';
        foreach ($allData['csv'] as $csvData) {
            echo "<li>$csvData</li>";
        }
        echo '</ul>';
    }
    if (!empty($allData['txt'])) {
        echo '<h3>Данные в TXT файле</h3>';
        echo '<ul>';
        foreach ($allData['txt'] as $txtData) {
            echo "<li>$txtData</li>";
        }
        echo '</ul>';
    }
    ?>
</div>
<a id="go_configuration" href="configuration.php">Перейти в Настройки</a>
<form action="authorization.php" method="post">
    <input type="submit" name="exit" id="go_exit" value="Выйти">
</form>
</body>
</html>
