<?php
session_start();
error_reporting(0);
require_once('include/config.php');

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_weight'])) {
        // Add new weight record
        $user_id = 1; // assuming user_id is 1 for now
        $weight = $_POST['weight'];
        $date = $_POST['date'];

        $sql = "INSERT INTO body_weight (user_id, weight, date) VALUES ('$user_id', '$weight', '$date')";
        if ($conn->query($sql) === TRUE) {
            echo "New body weight record added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['update_weight'])) {
        // Update existing weight record
        $id = $_POST['id'];
        $weight = $_POST['new_weight'];

        $sql = "UPDATE body_weight SET weight='$weight' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "Weight record updated successfully!";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } elseif (isset($_POST['delete_weight'])) {
        // Delete a weight record
        $id = $_POST['id'];

        $sql = "DELETE FROM body_weight WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "Weight record deleted successfully!";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
}

// Fetch records to display
$user_id = 1; // assuming user_id is 1
$sql = "SELECT * FROM body_weight WHERE user_id='$user_id' ORDER BY date DESC";
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
<h1>Body Weight Management</h1>
<p>You can add, update, and delete information related to your body weight here.</p>
<body>
    <!-- Main container for body weight management forms and table -->
    <div class="container">

        <!-- Add Body Weight Form -->
        <h2>Add Body Weight</h2>
        <!-- Add Body Weight Form -->
<form id="addForm" method="post">
    <input type="text" name="name" placeholder="Name:" required><br>
    <input type="text" name="age" placeholder="Age:" required><br>
    <input type="text" name="weight" placeholder="Weight (kg)" required><br>
    <input type="date" name="date" placeholder="Date" required><br>
    <input type="submit" name="add_weight" value="Add Weight">
</form>
<h2>Update Body Weight</h2>
<!-- Update Body Weight Form -->
<form id="updateForm" method="post">
    <input type="text" name="id" placeholder="Record Name:" required><br>
    <input type="text" name="new_weight" placeholder="New Weight (kg)" required><br>
    <input type="submit" name="update_weight" value="Update Weight">
</form>
<h2>Delete Body Weight</h2>
<!-- Delete Body Weight Form -->
<form id="deleteForm" method="post">
    <input type="text" name="id" placeholder="Record Name:" required><br>
    <input type="submit" name="delete_weight" value="Delete Weight">
</form>


        <!-- View Body Weight Records Table -->
        <h2>Your Body Weight Records</h2>
    <table id="recordsTable">
        <tr>
            <th>Name</th>
            <th>Weight (kg)</th>
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
    </table>
    </div>
</body>
</html>
<script>
    let records = [];

document.getElementById('addForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const name = event.target.name.value;
    const weight = event.target.weight.value;
    const date = event.target.date.value;

    records.push({ name, weight, date });
    updateTable();
    event.target.reset();
});

document.getElementById('updateForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const name = event.target.id.value;
    const newWeight = event.target.new_weight.value;

    const record = records.find(record => record.name === name);
    if (record) {
        record.weight = newWeight;
        updateTable();
        alert('Record updated successfully!');
    } else {
        alert('Record not found.');
    }
    event.target.reset();
});

document.getElementById('deleteForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const name = event.target.id.value;

    const index = records.findIndex(record => record.name === name);
    if (index !== -1) {
        records.splice(index, 1);
        updateTable();
        alert('Record deleted successfully!');
    } else {
        alert('Record not found.');
    }
    event.target.reset();
});

function updateTable() {
    const table = document.getElementById('recordsTable');
    table.innerHTML = `
        <tr>
            <th>Name</th>
            <th>Weight (kg)</th>
            <th>Date</th>
        </tr>
    `;
    
    records.forEach(record => {
        const row = table.insertRow();
        row.insertCell(0).innerText = record.name;
        row.insertCell(1).innerText = record.weight;
        row.insertCell(2).innerText = record.date;
    });
}
</script>

<?php
// Close database connection
$conn->close();
?>
