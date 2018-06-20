<?php
$db_name = "global";
$connect = mysqli_connect("localhost", "eborodina", "neto1541", $db_name);
$sql = 'show tables';
$res = mysqli_query($connect, $sql);
$connect = mysqli_connect("localhost", "eborodina", "neto1541", "global");
$sql_create = "create table `students` ( 
	`id` int(11) not null auto_increment,
	`name` varchar(50) not null,
	`estimation` float not null,
	`budget` tinyint(4) not null default '0',
	primary key (`id`)
) engine=InnoDB default charset=utf8";
$create = mysqli_query($connect, $sql_create);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>Управление</title>
</head>
<body>
	<p>Список таблиц в базе <?php echo $db_name; ?></p>
	<table>
		<?php while ($data = mysqli_fetch_array($res)) { ?>
		<tr>
			<td><?php echo '<a href="php.php?get=' . $data['0'] . '">'.$data['0'].'</a>'?></td>
		</tr>
		<?php } ?>
	</table>
</body>
</html>