<?php
include 'include/config.php';
$bookingid = $_GET['bookingid'];
$sql = "UPDATE tblbooking SET status = 'Cancelled' WHERE id = :bookingid";
$query = $dbh->prepare($sql);
$query->bindParam(':bookingid', $bookingid, PDO::PARAM_INT);
echo ($query->execute()) ? "Booking canceled successfully." : "Error canceling booking.";
?>