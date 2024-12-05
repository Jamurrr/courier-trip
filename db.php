<?php
$mysqli = new mysqli("localhost", "root", "", "courier_trip"); //Подключение к БД

if ($mysqli->connect_error) {
    die("Ошибка подключения: " . $mysqli->connect_error);
}

