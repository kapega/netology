<!DOCTYPE html>
<html>
<head>
    <title></title>
	<style type="text/css">
	form {
	margin: 100px auto;
	padding: 40px;
	width: 60%;
	min-width: 300px;
	background: -webkit-linear-gradient(left, #1dad46, #25b7c4);
	background: linear-gradient(to right, #1dad46, #25b7c4);
	font-family: Roboto, sans-serif;
}
</style>
</head>
<body>
<form enctype="multipart/form-data" action="admin.php" method="POST">
    <label><strong>Выберите файл с тестами в формате JSON для загрузки на сервер:</strong></label><br><br>
    <input type="file" name="mytest"><br><br>
    <input type="submit" value="Отправить тест"><br><br>

	<?php
		if (count($_FILES) > 0) {
			try {
				// читаем загруженный файл (из временной папки)
				$user_file = file_get_contents($_FILES['mytest']['name']);
				$json_test = json_decode($user_file); // из файла json получаем структуры php
				if (is_null($json_test) && !empty($user_file))
					throw new Exception('файл был получен, но это не json');
				// читаем файл из своего хранилища загруженных тестов
				$tests_file = file_get_contents('tests.json');
				$json = json_decode($tests_file); // из файла json получаем структуры php
				// $json - массив тестов
				$json[] = $json_test;
				// сохраняем
				$new_json = json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
				file_put_contents('tests.json', $new_json);
				echo '<p>Файл сохранён!</p>';
			} catch (Exception $e) {
				echo "<p>{$e -> getMessage()}</p>";
			}
		}
	?>
	<a href="list.php">Список загруженных тестов</a>
</form>
</body>
</html>