<?php
require_once 'functions.php';

$errors = [];

if (!empty($_POST['login']) && !empty($_POST['password'])) {
    if (login($_POST['login'], $_POST['password'])) {
        header('Location: admin.php');
        die;
    }
    else {
        $errors[] = 'Неверный логин или пароль';
    }
}

if (!empty($_POST['name'])) {
	$_SESSION['user']['username'] = $_POST['name'];
	$_SESSION['user']['is_admin'] = false;
    header('Location: list.php');
	
    die;
}

?>
<!doctype html>
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
			margin-top: 50px;
            }
        </style>
    </head>
<body>
<div class="container">
    <div class="row vertical-offset-100">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 style='text-align: center' class="panel-title">Авторизация</h3>
                </div>
                <div class="panel-body">

                    <?php

if (!empty($errors)): ?>
                    <ul>
                        <?php
    foreach($errors as $error): ?>
                            <li><?php echo $error
?></li>
                        <?php
    endforeach; ?>
                    </ul>
                    <?php
endif; ?>
					<h1> Войти как админ </h1>
                    <form method="POST">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Логин" name="login" type="text" required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Пароль" name="password" type="password"
                                       value="" required>
                            </div>
                            <input class="btn btn-lg btn-success btn-block" type="submit" value="Вход">
                        </fieldset>
                    </form>
					<h1>Войти как гость</h1>
					<form method="POST">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Имя" name="name" type="text" required>
                            </div>
                            <input class="btn btn-lg btn-success btn-block" type="submit" value="Вход">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
 
