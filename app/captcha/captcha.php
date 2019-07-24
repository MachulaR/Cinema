<?php

session_start();

$permitted_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';

$captcha_length = mt_rand(4,6);

function generate_string($permitted_chars, $length) {

    $input_length = strlen($permitted_chars);
    $random_string = '';

    for($i = 0; $i < $length; $i++) {
        $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }

    return $random_string;
}

$image = imagecreatetruecolor(200, 50);

imageantialias($image, true);

$colors = [];

$red = rand(125, 175);
$green = rand(125, 175);
$blue = rand(125, 175);

for($i = 0; $i < 5; $i++) {
    $colors[] = imagecolorallocate($image, $red - 20*$i, $green - 20*$i, $blue - 20*$i);
}

imagefill($image, 0, 0, $colors[0]);

for($i = 0; $i < 10; $i++) {
    imagesetthickness($image, rand(2, 10));
    $rect_color = $colors[rand(1, 4)];
    imagerectangle($image, rand(-10, 190), rand(-10, 10), rand(-10, 190), rand(40, 60), $rect_color);
}

$black = imagecolorallocate($image, 0, 0, 0);
$white = imagecolorallocate($image, 255, 255, 255);
$textcolors = [$black, $white];

$fonts = [dirname(__FILE__).'fonts\Arial.ttf'];


$captcha_string = generate_string($permitted_chars, $captcha_length);

for($i = 0; $i < $captcha_length; $i++) {
    $letter_space = 170/$captcha_length;
    $initial = 15;

    imagettftext($image, 20, rand(-15, 15), $initial + $i*$letter_space, rand(20, 40), $textcolors[rand(0, 1)], $fonts[array_rand($fonts)], $captcha_string[$i]);
}
$_SESSION['captcha_text'] = $captcha_string;
header('Content-type: '.$image);
imagepng($image);
imagedestroy($image);
?>
