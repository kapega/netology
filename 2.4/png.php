<?php

$font = __DIR__.'/GOTHIC.TTF';
$width = 800;
$height = 350;
$name = 'Поздравляю, '. $_GET['name'] . '!';
$all = (int) $_GET['all'];
$valid = intval($_GET['valid']);
$pc = $valid / $all * 100;
$x_name_length = $width / strlen($name) * 1.3;
$font_size = $x_name_length > 32 ? 32 : $x_name_length;
$image = imagecreate($width, $height);
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);
$red = imagecolorallocate($image, 255, 0, 0);
$orange = imagecolorallocate($image, 255, 153, 0);
$yellow = imagecolorallocate($image, 255, 204, 0);
$green = imagecolorallocate($image, 146, 205, 0);
$blue = imagecolorallocate($image, 102, 204, 255);
$dblue = imagecolorallocate($image, 0, 153, 204);
$violet = imagecolorallocate($image, 140, 72, 159);

imagerectangle($image, 0, 0, $width-1, $height-1, $white);
imagerectangle($image, 5, 5, $width-5, $height-5, $red);
imagerectangle($image, 10, 10, $width-10, $height-10, $orange);
imagerectangle($image, 15, 15, $width-15, $height-15, $yellow);
imagerectangle($image, 20, 20, $width-20, $height-20, $green);
imagerectangle($image, 25, 25, $width-25, $height-25, $blue);
imagerectangle($image, 30, 30, $width-30, $height-30, $dblue);
imagerectangle($image, 35, 35, $width-35, $height-35, $violet);

imagettftext($image, $font_size, 0, 150, 100 + $font_size, $violet, $font, $name);

imagettftext($image, $font_size, 0, 80, 200 + $font_size, $dblue, $font, "Правильных ответов: $valid / $all ({$pc}%)");

header("Content-type: image/png");
imagepng($image);
imagedestroy($image);
