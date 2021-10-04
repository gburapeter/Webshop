<?php

// rövid random fv.
function r($min, $max) {
    return random_int($min, $max);
}

// rövid random színfv.
function c($min, $max) {
    global $img;
    return imagecolorallocate($img, r($min, $max), r($min, $max), r($min, $max));
}

// A kép létrehozása
$img = imagecreate(200,60);

// A random szín létrehozása
$rand_color = c(0,75);

// A kép kitöltése a ranom színnel
imagefill($img, 0, 0, $rand_color);

// Random vonalhúzás (1 db)
for($k=0; $k< r(5,15); $k++) {
    imageline($img, r(0, 200), r(0, 60), r(0, 200), r(0, 60), c(0, 255));
}

// Random pöttyök (1 db)
for($k=0; $k< r(5,15); $k++) {
    imagefilledellipse($img, r(0, 200), r(0, 60), r(2, 5), r(2, 5), c(0, 255));
}

// random szöveg

$valid_chars = "ABCDEFGHJKLMNPRSTUVWXYZ23456789";
$captcha_text = substr(str_shuffle($valid_chars), 0, 6);

$font = '/opt/tFPDF/font/unifont/arial.ttf';

imagettftext($img, r(18, 32), r(-4,4), 30, 40, c(150,250), $font, $captcha_text);

// A HTTP válasz létrehozása
header("Content-Type: image/png");
imagepng($img);

