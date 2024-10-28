<?php
include 'include/config.php';
$bookingid = $_POST['bookingid'];
$newDate = $_POST['new_date'];
$sql = "UPDATE tblbooking SET booking_date = :newDate WHERE id = :bookingid";
$query = $dbh->prepare($sql);
$query->bindParam(':newDate', $newDate, PDO::PARAM_STR);
$query->bindParam(':bookingid', $bookingid, PDO::PARAM_INT);
echo ($query->execute()) ? "Booking rescheduled successfully." : "Error rescheduling booking.";
?>