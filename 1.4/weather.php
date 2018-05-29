<?php
$city = 'Moscow';
$country = 'RU';
$link = 'http://api.openweathermap.org/data/2.5/weather';
$appid = '652331e6244c72134cb084f0f587852d';
$url = "$link?appid=$appid&q=".$city.','.$country."&units=metric"; 
$message = 'Could not get data about';
$json=file_get_contents($url); 
	if($json === false) {
		exit("$message weather");
	}
$weather=json_decode($json,true);
	if($weather === null) {
		exit('Error while decoding json');
	}
$condition = $weather['weather'][0]['main'];
$temperature = round($weather['main']['temp']);
$humidity = $weather['main']['humidity'];
$clouds = $weather['clouds']['all'];
$wind = $weather['wind']['speed'];
$pic = $weather['weather'][0]['icon'];

?>

<!DOCTYPE html>
<html>
    <head>
    <title>The weather in <?php echo $city ?></title>
        <meta charset="utf-8">

    </head>
    <body>
        <div>
        <h1>Current weather in <?php echo $city ?></h1>
            <div>
                <p>
                    <strong>Weather condition: </strong><?php echo (!empty($condition)) ? $condition : "$message weather"; ?>
                </p>
				<p>
                    <strong>Temperature: </strong><?php echo (!empty($temperature)) ? $temperature : "$message temperature"; ?>° Celsius
                </p>
				<p>
                    <strong>Humidity: </strong><?php echo (!empty($humidity)) ? $humidity : "$message humidity"; ?>%
                </p>
				<p>
                    <strong>Clouds: </strong><?php echo (!empty($clouds)) ? $clouds : "$message clouds"; ?>%
                </p>
				<p>
                    <strong>Wind: </strong><?php echo (!empty($wind)) ? $wind : "$message wind"; ?> meter / sec
                </p>
				<img src='http://openweathermap.org/img/w/<?php echo $pic ?>.png'>
            </div>
        </div>
    </body>
</html>