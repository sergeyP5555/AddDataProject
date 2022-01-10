<?php
session_start();
if (!isset($_SESSION['userLogin'])) {
    header('Location: /authorization.html');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet">
    <title>AddData</title>
</head>
<body>
<form action="addingData.php" method="post">
    <p class="addData">Введите данные</p>
    <textarea name="message"></textarea> <br>
    <p class="addData">Выберете куда сохранить данные</p>
    <select id="select" name="source">
        <option value="database">Database</option>
        <option value="txt">TXT</option>
        <option value="csv">CSV</option>
    </select>
    <br><br><br>

    <input type="submit" name="addDataBtn" id="go_save" value="Добавить"><br><br><br>
    <a id="addData" href="data.php">Веруться</a>
</form>
</body>
</html>

