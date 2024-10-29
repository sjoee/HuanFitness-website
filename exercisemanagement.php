<?php
session_start();
error_reporting(0);
require_once('include/config.php');

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_exercise'])) {
        // Add new exercise record
        $user_id = 1; // Assuming user_id is 1 for now
        $exercise_name = $_POST['exercise_name'];
        $duration = $_POST['duration'];
        $date = $_POST['date'];

        $sql = "INSERT INTO exercise_routines (user_id, exercise_name, duration, date) VALUES ('$user_id', '$exercise_name', '$duration', '$date')";
        if ($conn->query($sql) === TRUE) {
            echo "New exercise routine added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['update_exercise'])) {
        // Update an exercise record
        $id = $_POST['id'];
        $new_exercise_name = $_POST['new_exercise_name'];
        $new_duration = $_POST['new_duration'];

        $sql = "UPDATE exercise_routines SET exercise_name='$new_exercise_name', duration='$new_duration' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "Exercise record updated successfully!";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } elseif (isset($_POST['delete_exercise'])) {
        // Delete an exercise record
        $id = $_POST['id'];

        $sql = "DELETE FROM exercise_routines WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "Exercise record deleted successfully!";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
}

// Fetch records to display
$user_id = 1; // Assuming user_id is 1
$sql = "SELECT * FROM exercise_routines WHERE user_id='$user_id' ORDER BY date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Body Weight Management</title>
    <style>
        /* General page styling */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, teal 50%, white 50%);
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            color: #333;
        }

        /* Container for body weight management forms and table */
        .container {
            width: 400px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.881);
            margin: 20px;
            text-align: center;
            position:absolute;
            top:22%;
        }
p{
    color:white;
    position:absolute;
    text-align:center;
    font-size:30px;
    top:11%;
}
        /* Header styling */
        h1{
            color:white;
            font-family: Arial, Helvetica, sans-serif;
            font-size:40px;
        }h2 {
            color: teal;
        }

        /* Form elements styling */
        form {
            margin-bottom: 20px;
        }

        input[type="text"], input[type="date"], input[type="submit"] {
            width: calc(100% - 24px);
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: teal;
            color: white;
            cursor: pointer;
            border: none;
        }

        input[type="submit"]:hover {
            background-color: #00796b;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }

        th {
            background-color: teal;
            color: white;
        }
    </style>
</head>
<h1>Exercise Management</h1>
<p>You can add, update, and delete activities that you exercise on each day here.</p>
<body>
    <!-- Main container for exercise management forms and table -->
    <div class="container">

        <h2>Add Exercise Routine</h2>
<form id="addForm" method="post">
    <input type="text" name="name" placeholder="Type of Exercise:" required><br>
    <input type="text" name="duration" placeholder="Exercise Duration(minutes):" required><br>
    <input type="date" name="date" placeholder="Date" required><br>
    <input type="submit" name="Save" value="Save">
</form>
<h2>Update Exercise Routine</h2>
<!-- Update Body Weight Form -->
<form id="updateForm" method="post">
    <input type="text" name="name" placeholder="Type of Exercise:" required><br>
    <input type="text" name="duration" placeholder="Exercise Duration(minutes):" required><br>
    <input type="date" name="date" placeholder="Date" required><br>
    <input type="submit" name="Save" value="Save">
</form>
<h2>Delete Exercise Routine</h2>
<!-- Delete Body Weight Form -->
<form id="deleteForm" method="post">
    <input type="text" name="name" placeholder="Type of Exercise:" required><br>
    <input type="date" name="date" placeholder="Date" required><br>
    <input type="submit" name="delete" value="Delete">
</form>


        <!-- View Body Weight Records Table -->
        <h2>Your Exercise Activity Records</h2>
    <table id="recordsTable">
        <tr>
            <th>Type of Exercise</th>
            <th>Duration(Minutes)</th>
            <th>Date</th>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["exercise_name"] . "</td>";
            echo "<td>" . $row["duration"] . "</td>";
            echo "<td>" . $row["date"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No exercise records found.</td></tr>";
    }
    ?>
</table>

</body>
</html>

<?php
// Close database connection
$conn->close();
?>
<script>
    // Initialize an empty array to store exercise records
    let exerciseRecords = [];

    // Function to update the table with the latest exercise records
    function updateExerciseTable() {
        const table = document.getElementById('recordsTable');
        table.innerHTML = `
            <tr>
                <th>Type of Exercise</th>
                <th>Duration (Minutes)</th>
                <th>Date</th>
            </tr>
        `;

        // Insert each record as a new row in the table
        exerciseRecords.forEach(record => {
            const row = table.insertRow();
            row.insertCell(0).innerText = record.name;
            row.insertCell(1).innerText = record.duration;
            row.insertCell(2).innerText = record.date;
        });
    }

    // Add exercise event
    document.getElementById('addForm').addEventListener('submit', function(event) {
        event.preventDefault();
        
        // Get values from the form
        const name = event.target.name.value;
        const duration = event.target.duration.value;
        const date = event.target.date.value;

        // Add new exercise record
        exerciseRecords.push({ name, duration, date });

        // Update table and reset the form
        updateExerciseTable();
        event.target.reset();
    });

    // Update exercise event
    document.getElementById('updateForm').addEventListener('submit', function(event) {
        event.preventDefault();

        // Get values from the form
        const name = event.target.name.value;
        const duration = event.target.duration.value;
        const date = event.target.date.value;

        // Find the record and update it
        const record = exerciseRecords.find(record => record.name === name && record.date === date);
        if (record) {
            record.duration = duration;
            updateExerciseTable();
            alert('Exercise routine updated successfully!');
        } else {
            alert('Record not found.');
        }

        // Reset the form
        event.target.reset();
    });

    // Delete exercise event
    document.getElementById('deleteForm').addEventListener('submit', function(event) {
        event.preventDefault();

        // Get values from the form
        const name = event.target.name.value;
        const date = event.target.date.value;

        // Find the index of the record and delete it
        const index = exerciseRecords.findIndex(record => record.name === name && record.date === date);
        if (index !== -1) {
            exerciseRecords.splice(index, 1);
            updateExerciseTable();
            alert('Exercise routine deleted successfully!');
        } else {
            alert('Record not found.');
        }

        // Reset the form
        event.target.reset();
    });
</script>
