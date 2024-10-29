<?php
include 'include/config.php';

$date = $_GET['date'];
$package_id = $_GET['package_id'];

// Query to get booked slots for a specific date and package
$sql = "SELECT booking_time FROM tblbooking WHERE booking_date = :date AND package_id = :package_id";
$query = $dbh->prepare($sql);
$query->bindParam(':date', $date, PDO::PARAM_STR);
$query->bindParam(':package_id', $package_id, PDO::PARAM_INT);
$query->execute();
$bookedSlots = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($bookedSlots); // Return the booked slots as JSON
?>