<?php
require_once('include/config.php');
// Check if the session is active
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_POST['submit_weight_add'])) {
    $uid = $_SESSION['uid'];
    $date = $_POST['Wdate'];
    $weight = $_POST['weightKG'];
    
    $sql = "INSERT INTO weight_management (uid, Wdate, weightKG) VALUES (:uid, :date, :weight)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
    $query->bindParam(':date', $date, PDO::PARAM_STR);
    $query->bindParam(':weight', $weight, PDO::PARAM_STR);
    
    if($query->execute()) {
        echo "<script>alert('Weight data saved successfully.');</script>";
    } else {
        echo "<script>alert('Error saving data. Please try again.');</script>";
    }
}

// Update Weight
if (isset($_POST['submit_weight_edit'])) {
    $uid = $_SESSION['uid'];
    $date = $_POST['Wdate'];
    $weight = $_POST['weightKG'];

    $sql = "UPDATE weight_management SET weightKG = :weight WHERE uid = :uid AND Wdate = :date";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
    $query->bindParam(':date', $date, PDO::PARAM_STR);
    $query->bindParam(':weight', $weight, PDO::PARAM_STR);

    if ($query->execute()) {
        echo "<script>alert('Weight data updated successfully.');</script>";
    } else {
        echo "<script>alert('Error updating data. Please try again.');</script>";
    }
}

// Delete Weight
if (isset($_POST['submit_weight_delete'])) {
    $uid = $_SESSION['uid'];
    $date = $_POST['Wdate'];

    $sql = "DELETE FROM weight_management WHERE uid = :uid AND Wdate = :date";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
    $query->bindParam(':date', $date, PDO::PARAM_STR);

    if ($query->execute()) {
        echo "<script>alert('Weight data deleted successfully.');</script>";
    } else {
        echo "<script>alert('Error deleting data. Please try again.');</script>";
    }
}

// Fetching the latest weight data
$uid = $_SESSION['uid'];
$sql_weight = "SELECT Wdate, weightKG FROM weight_management WHERE uid = :uid ORDER BY Wdate DESC";
$query_weight = $dbh->prepare($sql_weight);
$query_weight->bindParam(':uid', $uid, PDO::PARAM_STR);
$query_weight->execute();
$results_weight = $query_weight->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weight Management</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
    <?php include 'include/header.php';?>

    <div class="container">
        <div class="centered-content">
        <h2><b>Weight Management</b></h2><br><br>

            <!-- Add Weight -->
            <h3>Add Weight</h3>
            <form method="post" class="form-container">
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" id="Wdate" name="Wdate" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="weight">Weight (kg):</label>
                    <input type="number" id="weight" name="weightKG" class="form-control" step="0.1" required>
                </div>
                <button type="submit" name="submit_weight_add" class="btn btn-primary">SAVE</button>
            </form>

            <!-- Edit Weight -->
            <h3>Edit Weight</h3>
            <form method="post" class="form-container">
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" id="Wdate" name="Wdate" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="weight">Weight (kg):</label>
                    <input type="number" id="weight" name="weightKG" class="form-control" step="0.1" required>
                </div>
                <button type="submit" name="submit_weight_edit" class="btn btn-warning">UPDATE</button>
            </form>

            <!-- Delete Weight -->
            <h3>Delete Weight</h3>
            <form method="post" class="form-container">
            <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" id="Wdate" name="Wdate" class="form-control" required>
                </div>
                <button type="submit" name="submit_weight_delete" class="btn btn-danger">DELETE</button>
            </form>
        </div>
    </div>

</body>
</html>
