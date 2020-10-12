<?php

require_once './vendor/autoload.php';

$token = '3ACDH8LYP69SBzA171EZs8Vg4Edlh9i5ZBVfBmSUhMk';
$ln = new KS\Line\LineNotify($token);

$text = ' '; // Line Notify บังคับให้ใส่ข้อความ แต่อยากส่งแแต่รูปภาพเลยใส่ space ไว้
$image_path = 'https://i.ytimg.com/vi/zxFqW-QIsUI/maxresdefault.jpg'; //Line notify allow only jpeg and png file
$ln->send($text, $image_path);


?>
