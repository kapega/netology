<?php
header('Content-Type: text/html; charset=utf-8');
try {
	$pdo = new PDO("mysql:host=localhost;dbname=global", 'eborodina', "neto1541");
$sql = "select * from books";
$result = $pdo->prepare($sql);
$result->execute();
}
 catch (PDOException $e) {
    die($e->getMessage());
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Библиотека успешного человека</title>
	<style type="text/css">
		table {
    		border-collapse: collapse;
    		border: 1px solid #ccc;
   		}
   		tr, td, th {
    		padding: 5px;
   			border: 1px solid #ccc;
   		}
   		th {
    		background-color: #EFEEEC; 
    		font-weight: bold; 
    		text-align: center;
   		}
	</style>
</head>
<body>
	<h1>Библиотека успешного человека</h1>
	<table>
		<thead>
			<th>Название</th>
			<th>Автор</th>
			<th>Год выпуска</th>
			<th>Жанр</th>
			<th>ISBN</th>
		</thead>
	    <?php
foreach ($result as $data) { ?>
		<tbody>
				<td><?= $data["name"] ?></td>
				<td><?= $data["author"] ?></td>
				<td><?= $data["year"] ?></td>
				<td><?= $data["genre"] ?></td>
				<td><?= $data["isbn"] ?></td>
			</tr>
		</tbody>
		<?php
}
?>
	</table>
</body>
</html>