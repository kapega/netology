<?php

$name = 'Kate';
$age = 27;
$email = 'kapega@ya.ru';
$city = 'Moscow';
$info = "Hi Netology! My name is $name, I am $age years old. I live in $city and study PHP.";

?>

<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='utf-8'>
<title> Kate </title>
</head>
<body>
    <h1 align='center'>About Kate</h1>
    <table cellspacing='2' border='1' cellpadding='5' width='400' align='center'>
    <tr>
    <td><strong>Name</strong></td>
    <td><?= $name ?></td>
    </tr>
    <tr>
    <td><strong>Age</strong></td>
    <td><?= $age ?></td>
    </tr>
    <tr>
    <td><strong>Email</strong></td>
    <td><a href='mailto:<?= $email ?>'> <?= $email ?></a> </td>
    </tr>
    <tr>
    <td><strong>City</strong></td>
    <td><?= $city ?></td>
    </tr>
    <tr>
    <td><strong>Info</strong></td>
    <td><?= $info ?></td>
    </tr>
    </table>
</body>
</html>
