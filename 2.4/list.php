<?php

require_once 'functions.php';

if (!isAdmin()) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
	die('403 Forbidden');
}
//var_dump($_SESSION);
//var_dump($_POST);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="link/favicon.ico">
        <title>Генератор тестов</title>
        <link href="link/css/bootstrap.min.css" rel="stylesheet">
        <link href="link/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="theme.css" rel="stylesheet">
        <script src="link/js/ie-emulation-modes-warning.js"></script>
        <style>
            body {
            background: -webkit-linear-gradient(left, #a0ffd7, #baf9ff);
            background: linear-gradient(to right, #a0ffd7, #baf9ff);
            font-family: 'Roboto', sans-serif;
            }
        </style>
    </head>
    <body class="vsc-initialized">
        <div class="container">
            <h1>Тесты</h1>
            <?php
	$tests_file = file_get_contents('tests.json') or exit('Не удалось получить данные');
	$json = json_decode($tests_file, true) or exit('Ошибка декодирования json'); // из файла json получаем структуры php
	foreach ($json as $index => $test) {
		echo "<p><a href='test.php?test={$index}'>{$test['test_name']}</a></p>";
		if (isAuthorized() && isAdmin()) {
            echo "<a href='delete.php?test={$index}' style='text-decoration: none; color: black'>удалить тест</a>";
        }
	}

 if (isAuthorized() && isAdmin()) {
          echo "<p><a href='admin.php'><input type='button' value='загрузить еще тесты'></a></p>";
 }
 ?>
        </div>
    </body>
</html>