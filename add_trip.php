<?php
require 'db.php';

$courier_id = $_POST['courier_id'];
$region_id = $_POST['region_id'];
$start_date = $_POST['start_date'];

$result = $mysqli->query("SELECT goto_days FROM regions WHERE id = $region_id");
$region = $result->fetch_assoc();
$end_date = (new DateTime($start_date))->modify("+{$region['goto_days']} days")->format("Y-m-d");

$query = $mysqli->prepare("
    SELECT COUNT(*) 
    FROM trips 
    WHERE courier_id = ? 
    AND (? BETWEEN start_date AND end_date 
         OR ? BETWEEN start_date AND end_date)
");
$query->bind_param("iss", $courier_id, $start_date, $end_date);
$query->execute();
$query->bind_result($count);
$query->fetch();
$query->close();

if ($count > 0) {
    echo "Курьер занят на выбранные даты";

} else {
    $insert = $mysqli->prepare("INSERT INTO trips (courier_id, region_id, start_date, end_date) VALUES (?, ?, ?, ?)");
    $insert->bind_param("iiss", $courier_id, $region_id, $start_date, $end_date);
    $insert->execute();

    if ($insert->affected_rows > 0) {
        echo "Поездка успешно добавлена";
    } else {
        echo "Ошибка при добавлении поездки";
}
}


?>
