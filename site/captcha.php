<?php
session_start();
header("Content-type: image/png");

$image = imagecreate(120, 40);
$background = imagecolorallocate($image, 255, 255, 255); // белый фон
$text_color = imagecolorallocate($image, 0, 0, 0);       // черный текст

$captcha_code = '';
for ($i = 0; $i < 5; $i++) {
    $captcha_code .= chr(rand(65, 90)); // Генерация случайной буквы
}
$_SESSION['rand_code'] = $captcha_code;

imagestring($image, 5, 30, 10, $captcha_code, $text_color);
imagepng($image);
imagedestroy($image);
?>
