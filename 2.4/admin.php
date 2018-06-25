<?php
require_once 'functions.php';

if (!isAdmin()) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
	die('403 Forbidden');
}

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
		<div class="row vertical-offset-100">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
			<div class="panel-heading">
                    <h3 class="panel-title" style='text-align: center'>Загрузка тестов</h3>
                </div>
          <div class="panel-body">
            <form enctype="multipart/form-data" action="admin.php" method="POST">
			<fieldset>
                <label><strong>Выберите файл с тестами в формате JSON для загрузки на сервер:</strong></label><br />
                <div class="form-group">
				<input type="file" name="mytest" class="file-upload btn btn-primary"><br /><br />
				</div>
				<div class="form-group">
                <input type="checkbox" name="redirect_to_admin"> Загрузить ещё файл<br /><br />
				</div>
                <input type="submit" class="btn btn-lg btn-success" value="Отправить тест"><br /><br />
                <?php

if (count($_FILES) > 0) {
    try {

        // читаем загруженный файл (из временной папки)

        $userFile = file_get_contents($_FILES['mytest']['name']);

        // echo "<pre>";
        // print_r($_FILES['mytest']['name']); проверить название файла
        // echo "</pre>";

        $jsonTest = json_decode($userFile); // из файла json получаем структуры php
        if (is_null($jsonTest) && !empty($userFile)) throw new Exception('файл был получен, но это не json');

        // читаем файл из своего хранилища загруженных тестов

        $testsFile = file_get_contents('tests.json');
        $json = json_decode($testsFile, true); // из файла json получаем структуры php

        // $json - массив тестов

        $json[] = $jsonTest;

        // сохраняем

        $newJson = json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        // echo "<pre>";
        // print_r($newJson);
        // echo "</pre>";

        file_put_contents('tests.json', $newJson);

        // echo '<p>Файл сохранён!</p>';

        if (!empty($_POST['redirect_to_admin'])) redirect('admin.php');
        else redirect('list.php');
    }

    catch(Exception $e) {
        echo "<p>{$e->getMessage() }</p>";
    }
}

?>
				</fieldset>
                <a href="list.php">Перейти к загруженным тестам</a></br>
				<a href="logout.php">Выход</a>
            </form>
        </div>
		</div>
		</div>
		</div>
		</div>
    </body>
</html>