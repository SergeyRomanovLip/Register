<?php
$host = 'localhost';
$user = 'h910230154_rso';
$password = 'Pwos9028';
$database = 'h910230154_isinfo';
$link = mysqli_connect($host, $user, $password, $database);
$date = date('d.m.y');
$dateNoFormat = time();
$dateNoFormatYest = $dateNoFormat-54000;
$time = date('H:i');
?>