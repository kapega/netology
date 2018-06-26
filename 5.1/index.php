<?php
require __DIR__ . '/vendor/autoload.php';

$api = new \Yandex\Geo\Api();

if (!empty($_POST['address'])) {
    $address = filter_input(INPUT_POST, "address", FILTER_SANITIZE_STRING);
    $api->setQuery($address);
    $api->setLimit(10)->setLang(\Yandex\Geo\Api::LANG_RU)->load();
    $response = $api->getResponse();
    $response->getFoundCount();
    $response->getQuery();
    $response->getLatitude();
    $response->getLongitude();
    $collection = $response->getList();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Координаты</title>
	<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #4CAF50;
    color: white;
}

tr:hover {background-color:#f5f5f5;}

h1, form, h3 {
	text-align: center;
}
</style>
</head>
<body>
<h1>Сервис поиска координат по адресу</h1>
    <form method="POST">
		<input type="text" name="address" placeholder="Адрес">
		<button type="submit">Найти координаты</button>
    </form>
	<?php if (!empty($_POST['address'])): ?>
    <h3>Координаты по адресу  <?= $response->getQuery(); ?>:</h3>
    <?php if (isset($collection)): ?>
        <table>
            <thead>
			    <th>Адрес</th>
                <th>Долгота</th>
                <th>Широта</th>
            </thead>
            <?php foreach($collection as $item): ?>
            <tbody>
                <tr>
				    <td><?= $item->getAddress(); ?></td>
                    <td><?= $item->getLongitude(); ?></td>
                    <td><?= $item->getLatitude(); ?></td>
                </tr>
            </tbody>
            <?php endforeach ?>
        </table>
    <?php endif ?>
	<?php endif ?>
</body>
</html>