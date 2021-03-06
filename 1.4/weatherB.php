<?php
$city = 'Barcelona';
$country = 'es';
$url = "http://api.openweathermap.org/data/2.5/weather?appid=652331e6244c72134cb084f0f587852d&q=".$city.','.$country."&units=metric"; 
$json=file_get_contents($url); 
$weather=json_decode($json,true);
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
                    <strong>Weather condition: </strong><?php echo $weather['weather'][0]['main']?>
                </p>
				<p>
                    <strong>Temperature: </strong><?php echo round($weather['main']['temp']) ?>° Celsius
                </p>
				<p>
                    <strong>Humidity: </strong><?php echo $weather['main']['humidity'] ?>%
                </p>
				<p>
                    <strong>Clouds: </strong><?php echo $weather['clouds']['all'] ?>%
                </p>
				<p>
                    <strong>Wind: </strong><?php echo $weather['wind']['speed'] ?> meter / sec
                </p>
				<img src='http://openweathermap.org/img/w/<?php echo $pic ?>.png'>
            </div>
        </div>
    </body>
</html>