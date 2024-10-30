<?php
session_start();
require_once('include/config.php');
// if(strlen($_SESSION["uid"])==0) {   
//     header('location:login.php');
// } else {
//     if(isset($_POST['submit_water_add'])) {
//         $uid = $_SESSION['uid'];
//         $date = $_POST['Cdate'];
//         $water_intake = $_POST['water_intake'];
//         // Insert data into water consumption table (add your query here)
//         echo "<script>alert('Water consumption data saved successfully.');</script>";
//     }

//     if(isset($_POST['submit_water_edit'])) {
//         $date = $_POST['Cdate'];
//         $water_intake = $_POST['water_intake'];
//         // Update data in water consumption table (add your query here)
//         echo "<script>alert('Water consumption data updated successfully.');</script>";
//     }

//     if(isset($_POST['submit_water_delete'])) {
//         $date = $_POST['Cdate'];
//         // Delete data from water consumption table (add your query here)
//         echo "<script>alert('Water consumption data deleted successfully.');</script>";
//     }
// }
if(isset($_POST['submit_water_add'])) {
    $uid = $_SESSION['uid'];
    $date = $_POST['Cdate'];
    $water_intake = $_POST['water_intake'];
    
    $sql = "INSERT INTO water_management (uid, Cdate, water_consumed) VALUES (:uid, :date, :water_intake)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
    $query->bindParam(':date', $date, PDO::PARAM_STR);
    $query->bindParam(':water_intake', $water_intake, PDO::PARAM_STR);
    
    if($query->execute()) {
        echo "<script>alert('Water consumption data saved successfully.');</script>";
    } else {
        echo "<script>alert('Error saving data. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Water Consumption Management</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
    <?php include 'include/header.php';?>

    <div class="container">
        <div class="centered-content">
            <h2><b>Water Management</b></h2><br><br>

            <!-- Add Water Consumption -->
            <h3>Add Water Consumption</h3>
            <form method="post" class="form-container">
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" id="Cdate" name="Cdate" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="water_intake">Water Intake (liters):</label>
                    <input type="number" id="water_intake" name="water_intake" class="form-control" step="0.1" required>
                </div>
                <button type="submit" name="submit_water_add" class="btn btn-primary">SAVE</button>
            </form>

            <!-- Edit Water Consumption -->
            <h3>Edit Water Consumption</h3>
            <form method="post" class="form-container">
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" id="Cdate" name="Cdate" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="water_intake">Water Intake (liters):</label>
                    <input type="number" id="water_intake" name="water_intake" class="form-control" step="0.1" required>
                </div>
                <button type="submit" name="submit_water_edit" class="btn btn-warning">UPDATE</button>
            </form>

            <!-- Delete Water Consumption -->
            <h3>Delete Water Consumption</h3>
            <form method="post" class="form-container">
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" id="Cdate" name="Cdate" class="form-control" required>
                </div>
                <button type="submit" name="submit_water_delete" class="btn btn-danger">DELETE</button>
            </form>
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
