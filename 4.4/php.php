<?php
$connect = mysqli_connect("localhost", "eborodina", "neto1541", "global");
if (isset($_GET['get'])) {
	$table = $_GET['get'];
}
if (!empty($_POST)) {
	foreach ($_POST as $key => $value) {
		if ($key[0] === 'd' && $value !== '') {
			$i = substr($key, 1);
			mysqli_query($connect, 'alter table '.$table.' drop column '.$i);
			header('Location: php.php?get='.$table);
		}
		if ($key != 'type' && $key[0] === 't' && $value != '' && $_POST['type'] != '') {
			$i = substr($key, 1);
			mysqli_query($connect, 'alter table '.$table.' modify '.$i.' '.$_POST['type'].' not null');
			header('Location: php.php?get='.$table);
		}
		if ($key !== 'renamed' && $key[0] === 'n' && $value != '' && $_POST['renamed'] != '') {
			$i = substr($key, 1);
			$types = explode("&", $i);
			mysqli_query($connect, 'alter table '.$table.' change '.$types[0].' '.$_POST['renamed'].' '.$types[1]);
		}
	}
}
$li = ['INT', 'VARCHAR(255)', 'TEXT'];
$sql = 'describe '.$table;
$res = mysqli_query($connect, $sql);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>Table</title>
</head>
<body>
	<h1>Table <?php echo $table ?></h1>
	<form action="" method="post">
		<table>
			<tr>
				<td>Name</td>
				<td>Type</td>
			</tr>
			<?php while ($data = mysqli_fetch_array($res)) { ?>
			<tr>
				<td><?php echo $data['Field'] ?></td>
				<td><?php echo $data['Type'] ?></td>
				<td><input type="submit" name="<?= 'd'.$data['Field']; ?>" value="Delete"></td>
				<td>
					<form action="" method="post">
						<select name="type">
							<option></option>
							<?php for ($i = 0; $i < count($li); $i++) { ?>
							<option><?php echo $li[$i]; ?></option>
							<?php } ?>
						</select>
						<br>
						<input type="submit" name="<?= 't'.$data['Field']; ?>" value="Edit type">
					</form>
				</td>
				<td>
					<form action="" method="post">
						<input type="text" name="renamed">
						<br>
						<input type="submit" name="<?= 'n'.$data['Field'].'&'.$data['Type']; ?>" value="Edit name">
					</form>
				</td>
			</tr>
			<?php } ?>
		</table>
	</form>
	<a href="ind.php">Back</a>
</body>
</html>