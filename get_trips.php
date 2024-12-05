<?php
require 'db.php';
header('Content-Type: application/json');

$filterDate = $_GET['date'];

$sql = "SELECT trips.id, couriers.name AS courier_name, regions.name AS region_name, trips.start_date, trips.end_date
        FROM trips
        JOIN couriers ON trips.courier_id = couriers.id
        JOIN regions ON trips.region_id = regions.id
        WHERE trips.start_date <= ? AND trips.end_date >= ?";


$query = $mysqli->prepare($sql);
$query->bind_param("ss", $filterDate, $filterDate);
$query->execute();
$result = $query->get_result();

$trips = [];

while ($row = $result->fetch_assoc()) {
    array_push($trips, $row);
}

$query->close();
$mysqli->close();

echo json_encode($trips);

?>
