<?php
session_start();
require_once('include/config.php');
if(isset($_POST['submit_exercise_add'])) {
    $uid = $_SESSION['uid'];
    $date = $_POST['Edate'];
    $exercise = $_POST['exercise'];
    
    $sql = "INSERT INTO exercise_management (uid, Edate, exercise_type) VALUES (:uid, :date, :exercise)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
    $query->bindParam(':date', $date, PDO::PARAM_STR);
    $query->bindParam(':exercise', $exercise, PDO::PARAM_STR);
    
    if($query->execute()) {
        echo "<script>alert('Exercise data saved successfully.');</script>";
    } else {
        echo "<script>alert('Error saving data. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exercise Management</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
    <?php include 'include/header.php';?>

    <div class="container">
        <div class="centered-content">
            <h2><b>Exercise Management</b></h2><br><br>

            <!-- Add Exercise -->
            <h3>Add Exercise</h3>
            <form method="post" class="form-container">
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" id="Edate" name="Edate" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="exercise">Exercise Description:</label>
                    <input type="text" id="exercise" name="exercise" class="form-control" required>
                </div>
                <button type="submit" name="submit_exercise_add" class="btn btn-primary">SAVE</button>
            </form>

            <!-- Edit Exercise -->
            <h3>Edit Exercise</h3>
            <form method="post" class="form-container">
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" id="Edate" name="Edate" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="exercise">Exercise Description:</label>
                    <input type="text" id="exercise" name="exercise" class="form-control" required>
                </div>
                <button type="submit" name="submit_exercise_edit" class="btn btn-warning">UPDATE</button>
            </form>

            <!-- Delete Exercise -->
            <h3>Delete Exercise</h3>
            <form method="post" class="form-container">
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" id="Edate" name="Edate" class="form-control" required>
                </div>
                <button type="submit" name="submit_exercise_delete" class="btn btn-danger">DELETE</button>
            </form>
        </div>
    </div>
</body>
</html>
