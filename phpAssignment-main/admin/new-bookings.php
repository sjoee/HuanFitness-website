<?php 
session_start();
error_reporting(0);
include 'include/config.php'; 

if (strlen($_SESSION['adminid']) == 0) {
  header('location:logout.php');
} else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="Admin | New Bookings">
    <title>Admin | New Bookings</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="app sidebar-mini rtl">
    <?php include 'include/header.php'; ?>
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php include 'include/sidebar.php'; ?>
    
    <main class="app-content">
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <h3>New Bookings</h3>
                        <hr />
                        
                        <!-- Date Picker for Checking Availability -->
                        <label for="booking-date">Select Date for Availability:</label>
                        <input type="date" id="booking-date" onchange="checkAvailability()">
                        <div id="availability-result"></div>

                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Booking ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Booking Date</th>
                                    <th>Package Name</th>
                                    <th>Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT t1.id as bookingid, t3.fname as Name, t3.email as email, t1.booking_date as bookingdate,
                                        t2.titlename as title, t5.PackageName as PackageName 
                                        FROM tblbooking as t1
                                        JOIN tbladdpackage as t2 ON t1.package_id = t2.id
                                        JOIN tbluser as t3 ON t1.userid = t3.id
                                        JOIN tblpackage as t5 ON t2.PackageType = t5.id
                                        WHERE t1.paymentType IS NULL OR t1.paymentType = ''";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {
                                ?>
                                <tr>
                                    <td><?php echo htmlentities($cnt); ?></td>
                                    <td><?php echo htmlentities($result->bookingid); ?></td>
                                    <td><?php echo htmlentities($result->Name); ?></td>
                                    <td><?php echo htmlentities($result->email); ?></td>
                                    <td><?php echo htmlentities($result->bookingdate); ?></td>
                                    <td><?php echo htmlentities($result->PackageName); ?></td>
                                    <td><?php echo htmlentities($result->title); ?></td>
                                    <td>
                                        <button class="btn btn-primary" onclick="viewBookingDetails(<?php echo $result->bookingid; ?>)">View</button>
                                        <button class="btn btn-danger" onclick="cancelBooking(<?php echo $result->bookingid; ?>)">Cancel</button>
                                        <button class="btn btn-warning" onclick="rescheduleBooking(<?php echo $result->bookingid; ?>)">Reschedule</button>
                                    </td>
                                </tr>
                                <?php $cnt++; }} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <!-- Essential JavaScript -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/plugins/pace.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>

    <script>
    // Check real-time availability
    function checkAvailability() {
        const date = document.getElementById("booking-date").value;
        const packageId = 1; // Update with the actual package ID

        fetch(`getAvailability.php?date=${date}&package_id=${packageId}`)
            .then(response => response.json())
            .then(data => {
                const availabilityDiv = document.getElementById("availability-result");
                if (data.length > 0) {
                    availabilityDiv.innerHTML = "Unavailable slots on " + date + ": " + data.map(slot => slot.booking_time).join(", ");
                } else {
                    availabilityDiv.innerHTML = "All slots available on " + date;
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // Cancel booking
    function cancelBooking(bookingId) {
        if (confirm("Are you sure you want to cancel this booking?")) {
            fetch(`cancelBooking.php?bookingid=${bookingId}`)
                .then(response => response.text())
                .then(result => {
                    alert(result);
                    location.reload(); // Refresh page to update status
                })
                .catch(error => console.error('Error:', error));
        }
    }

    // Reschedule booking
    function rescheduleBooking(bookingId) {
        const newDate = prompt("Enter new date (YYYY-MM-DD):");
        if (newDate) {
            fetch(`rescheduleBooking.php`, {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `bookingid=${bookingId}&new_date=${newDate}`
            })
            .then(response => response.text())
            .then(result => {
                alert(result);
                location.reload(); // Refresh page to update status
            })
            .catch(error => console.error('Error:', error));
        }
    }
    </script>
</body>
</html>
<?php } ?>
