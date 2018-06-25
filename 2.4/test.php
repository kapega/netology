<?php 

require_once 'functions.php';
//var_dump($_SESSION);
//var_dump($_POST);
if (!isAdmin()) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
	die('403 Forbidden');
}

if (isAuthorized()) {
	$_POST['name'] = $_SESSION['user']['username'];
}

$n = $_SESSION['user']['username'];



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
	
<?php
$testsFile = file_get_contents('tests.json');
$json = json_decode($testsFile, true); // из файла json получаем структуры php
$testNum = $_GET['test'];

if (empty($json[$testNum])) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo '<p>Некорректное значение параметра test.<p>';
}
else {
    $test = $json[$testNum];
    echo "<h1>{$test['test_name']}</h1>";
    if (empty($_POST['a'])) {
        echo "<form method='post' action='test.php?test={$testNum}'>";
        echo "<p>Привет, $n!</p>";
        foreach($test['questions'] as $qi => $q) {
            echo "<div><p>{$q['q']}</p>";
            foreach($q['answers'] as $ai => $a) {
                echo "<p><label for='a_{$qi}_{$ai}'>";
                echo "<input type='checkbox' name='a[$qi][$ai]' id='a_{$qi}_{$ai}'> {$a['a']}";
                echo "</label></p>";
            }
        }

        echo "<input type='submit' value='Отправить'>";
        echo "</form>";
    }
    else {
        $userAnswers = $_POST['a'];
        $results = []; // [$qi => valid || not valid, ...]

        // echo "<pre>"; print_r($userAnswers); echo "</pre>";
        // получить правильные варианты ответов

        $valid =
        function ($item)
        {
            return $item['correct'];
        };
        foreach($test['questions'] as $qi => $q) {
            $ans = array_filter($q['answers'], $valid);

            // echo "<p>"; var_dump($ans); echo "</p>";
            // index правильного варианта

            $validIndices = array_keys($ans);
            if (empty($userAnswers[$qi])) {
                $userIndices = [];
            }
            else {
                $userIndices = array_keys($userAnswers[$qi]);
                $intersect = array_intersect($validIndices, $userIndices);
                $ci = count($intersect);
                $results[$qi] = ($ci == count($validIndices) && $ci == count($userIndices));
            }
        }

        $allResults = count($results);
        $valid = count(array_filter($results));
        $name = urlencode($_POST['name']);
        echo "<p>Всего вопросов: ", $allResults, "</p>";
        echo "<p>Правильных ответов: ", $valid, "</p>";
        echo "<img src='png.php?name={$name}&all={$allResults}&valid={$valid}'>";
    }
}

?>
</body>
</html>