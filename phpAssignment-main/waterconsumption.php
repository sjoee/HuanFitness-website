<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "WaterTrackerDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add Record
if (isset($_POST['Add'])) {
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    $sql = "INSERT INTO water_consumption (amount, date, time) VALUES ('$amount', '$date', '$time')";
    $conn->query($sql);
}

// Update Record
if (isset($_POST['Save'])) {
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    $sql = "UPDATE water_consumption SET amount='$amount' WHERE date='$date' AND time='$time'";
    $conn->query($sql);
}
if (isset($_POST['delete'])) {
    $date = $_POST['date'];
    $time = $_POST['time'];

    $sql = "DELETE FROM water_consumption WHERE date='$date' AND time='$time'";
    $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Water Consumption Management</title>
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
<h1>Water Consumption Tracker</h1>
<body>
   
    <div class="container">

        <h2>Add Water Consumption</h2>
<form id="addForm" method="post">
    <input type="number" name="amount" placeholder="Amount of Water(ml)" required><br>
    <input type="date" name="date" placeholder="Date" required><br>
    <input type="time" name="time" placeholder="Time" required><br>
    <input type="submit" name="Add" value="Add">
</form>
<h2>Update Water Consumption</h2>

<form id="updateForm" method="post">
    <input type="number" name="amount" placeholder="Amount of Water(ml)" required><br>
    <input type="date" name="date" placeholder="Date" required><br>
    <input type="time" name="time" placeholder="Time" required><br>
    <input type="submit" name="Save" value="Save">
</form>
<h2>Delete Water Consumption</h2>

<form id="deleteForm" method="post">
    <input type="date" name="date" placeholder="Date" required><br>
    <input type="time" name="time" placeholder="Time" required><br>
    <input type="submit" name="delete" value="Delete">
</form>

        <h2>Your Water Consumption Records</h2>
    <table id="recordsTable">
        <tr>
            <th>Amount(ml)</th>
            <th>Time</th>
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
            // Display records
            $sql = "SELECT * FROM water_consumption ORDER BY date DESC, time DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['amount']}</td>
                            <td>{$row['time']}</td>
                            <td>{$row['date']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No records found</td></tr>";
            }
            $conn->close();
            ?>
</table>

</body>
</html>

<script>
    // Select the forms and table
const addForm = document.getElementById('addForm');
const updateForm = document.getElementById('updateForm');
const deleteForm = document.getElementById('deleteForm');
const recordsTable = document.getElementById('recordsTable');

// Add water consumption record
addForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const amount = addForm.amount.value;
    const date = addForm.date.value;
    const time = addForm.time.value;

    if (amount && date && time) {
        const row = recordsTable.insertRow(-1); // Insert at the end of the table
        row.insertCell(0).innerText = `${amount} ml`;
        row.insertCell(1).innerText = time;
        row.insertCell(2).innerText = date;

        addForm.reset(); // Clear form fields
    }
});

// Update water consumption record
updateForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const amount = updateForm.amount.value;
    const date = updateForm.date.value;
    const time = updateForm.time.value;
    let updated = false;

    // Search table for matching date and time
    for (let i = 1; i < recordsTable.rows.length; i++) {
        const row = recordsTable.rows[i];
        if (row.cells[1].innerText === time && row.cells[2].innerText === date) {
            row.cells[0].innerText = `${amount} ml`; // Update the amount
            updated = true;
            break;
        }
    }

    if (updated) {
        alert("Record updated successfully!");
    } else {
        alert("Record not found.");
    }

    updateForm.reset();
});

// Delete water consumption record
deleteForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const date = deleteForm.date.value;
    const time = deleteForm.time.value;
    let deleted = false;

    // Search table for matching date and time
    for (let i = 1; i < recordsTable.rows.length; i++) {
        const row = recordsTable.rows[i];
        if (row.cells[1].innerText === time && row.cells[2].innerText === date) {
            recordsTable.deleteRow(i); // Delete the matching row
            deleted = true;
            break;
        }
    }

    if (deleted) {
        alert("Record deleted successfully!");
    } else {
        alert("Record not found.");
    }

    deleteForm.reset();
});

</script>
