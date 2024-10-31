<?php 
session_start();
error_reporting(E_ALL); // Enable error reporting for debugging
ini_set('display_errors', 1); // Display errors

include 'include/config.php';
$uid = $_SESSION['uid'];

// Check if the user is logged in
if (!isset($uid)) {
    header('Location: login.php'); // Redirect if not logged in
    exit();
}

if (isset($_POST['submit'])) { 
    $pid = $_POST['pid'];

    // Prepare the SQL statement
    $sql = "INSERT INTO tblbooking (package_id, userid) VALUES (:pid, :uid)";
    $query = $dbh->prepare($sql);
    
    // Bind parameters
    $query->bindParam(':pid', $pid, PDO::PARAM_STR);
    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
    
    // Execute and check for errors
    if ($query->execute()) {
        echo "<script>alert('Package has been booked.');</script>";
        echo "<script>window.location.href='booking-history.php'</script>";
    } else {
        echo "<script>alert('Booking failed.');</script>";
    }
}

// Fetching data for display
try {
    // Fetch Water Data
    $sql_water = "SELECT Cdate, water_consumed FROM water_management WHERE uid = :uid ORDER BY Cdate DESC";
    $query_water = $dbh->prepare($sql_water);
    $query_water->bindParam(':uid', $uid, PDO::PARAM_STR);
    $query_water->execute();
    $results_water = $query_water->fetchAll(PDO::FETCH_OBJ);

    // Fetch Weight Data
    $sql_weight = "SELECT Wdate, weightKG FROM weight_management WHERE uid = :uid ORDER BY Wdate DESC";
    $query_weight = $dbh->prepare($sql_weight);
    $query_weight->bindParam(':uid', $uid, PDO::PARAM_STR);
    $query_weight->execute();
    $results_weight = $query_weight->fetchAll(PDO::FETCH_OBJ);

    // Fetch Exercise Data
    $sql_exercise = "SELECT Edate, exercise_type FROM exercise_management WHERE uid = :uid ORDER BY Edate DESC";
    $query_exercise = $dbh->prepare($sql_exercise);
    $query_exercise->bindParam(':uid', $uid, PDO::PARAM_STR);
    $query_exercise->execute();
    $results_exercise = $query_exercise->fetchAll(PDO::FETCH_OBJ);
} catch (Exception $e) {
    echo "Error fetching data: " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>About Us</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/owl.carousel.min.css"/>
    <link rel="stylesheet" href="css/nice-select.css"/>
    <link rel="stylesheet" href="css/magnific-popup.css"/>
    <link rel="stylesheet" href="css/slicknav.min.css"/>
    <link rel="stylesheet" href="css/animate.css"/>
    <!-- Main Stylesheets -->
    <link rel="stylesheet" href="css/style.css"/>
    <style>
        .centered-content {
            max-width: 900px;
            margin: auto;
            padding: 20px;
            text-align: center;
        }
        .form-container {
            margin-top: 10px;
            margin-bottom: 10px;
            padding: 15px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <!-- Page Preloder -->
    
    <!-- Header Section -->
    <?php include 'include/header.php'; ?>
    <!-- Header Section end -->

    <!-- Page top Section -->
    <section class="page-top-section set-bg"></section>

    <!-- Pricing Section -->
    <section class="pricing-section spad">
        <div class="container">
            <div class="section-title text-center">
                <h2>DATA MANAGEMENT</h2>
            </div>
            <div class="qa-container">
                <!-- Water Consumption Section -->
                <section>
                    <?php include 'waterconsumption.php'; ?>
                </section>
            </div>
            <div class="qa-container">
                <!-- Weight Management Section -->
                <section>
                    <?php include 'weightmanagement.php'; ?>
                </section>
            </div>
            <div class="qa-container">
                <!-- Exercise Management Section -->
                <section>
                    <?php include 'exercisemanagement.php'; ?>
                </section>
            </div>    
        </div>

        <div class="section-title text-center">
		<br><br><h2>DATA HISTORY</h2><br><br>
        </div>
        
        <!-- Water Data Table -->
        <div class="section-title text-center">
            <h3>Water Data</h3>
        </div>
        <table class="qa-container table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Water Consumed (L)</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($query_water->rowCount() > 0) {
                    foreach ($results_water as $water) { ?>
                        <tr>
                            <td><?php echo htmlentities($water->Cdate); ?></td>
                            <td><?php echo htmlentities($water->water_consumed); ?></td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr><td colspan="2">No Water Data Available</td></tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Weight Data Table -->
        <div class="section-title text-center">
            <h3>Weight Data</h3>
        </div>
        <table class="qa-container table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Weight (kg)</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($query_weight->rowCount() > 0) {
                    foreach ($results_weight as $weight) { ?>
                        <tr>
                            <td><?php echo htmlentities($weight->Wdate); ?></td>
                            <td><?php echo htmlentities($weight->weightKG); ?></td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr><td colspan="2">No Weight Data Available</td></tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Exercise Data Table -->
        <div class="section-title text-center">
            <h3>Exercise Data</h3>
        </div>
        <table class="qa-container table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Exercise Type</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($query_exercise->rowCount() > 0) {
                    foreach ($results_exercise as $exercise) { ?>
                        <tr>
                            <td><?php echo htmlentities($exercise->Edate); ?></td>
                            <td><?php echo htmlentities($exercise->exercise_type); ?></td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr><td colspan="3">No Exercise Data Available</td></tr>
                <?php } ?>
            </tbody>
        </table>
    </section>    

    <!-- Footer Section -->
    <?php include 'include/footer.php'; ?>
    <!-- Footer Section end -->

    <div class="back-to-top"><img src="img/icons/up-arrow.png" alt=""></div>

    <!--====== Javascripts & Jquery ======-->
    <script src="js/vendor/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.slicknav.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
