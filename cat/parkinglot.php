<?php
// Establish database connection
$servername = "localhost";
$username = "EMMANUEL";
$password = "222004496";
$dbname = "car"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//ishimwe EMMANUEL 222004496-->
// Delete Parking Lot
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    $sql_delete = "DELETE FROM parkinglot WHERE parkinglot_id = $delete_id";

    if ($conn->query($sql_delete) === TRUE) {
        echo "Parking Lot deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Update Parking Lot
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_id'])) {
    $update_id = $_POST['update_id'];
    $new_name = $_POST['new_name'];
    $new_address = $_POST['new_address'];
    $new_capacity = $_POST['new_capacity'];

    $sql_update = "UPDATE parkinglot SET name='$new_name', address='$new_address', capacity='$new_capacity' WHERE parkinglot_id=$update_id";

    if ($conn->query($sql_update) === TRUE) {
        echo "Parking Lot updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// View Parking Lots
$sql_view = "SELECT * FROM parkinglot";
$result_view = $conn->query($sql_view);

echo "<h2>Parking Lots</h2>";
echo "<table border='1'>";
echo "<tr><th>Parking Lot ID</th><th>Name</th><th>Address</th><th>Capacity</th><th>Action</th></tr>";

if ($result_view->num_rows > 0) {
    while($row = $result_view->fetch_assoc()) {
        // Output data as table rows
        echo "<tr>";
        echo "<td>" . $row["parkinglot_id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["address"] . "</td>";
        echo "<td>" . $row["capacity"] . "</td>";
        echo "<td>
                <form method='post' style='display:inline;'>
                    <input type='hidden' name='delete_id' value='" . $row["parkinglot_id"] . "'>
                    <button type='submit'>Delete</button>
                </form>
                <form method='post' action='' style='display:inline;'>
                    <input type='hidden' name='update_id' value='" . $row["parkinglot_id"] . "'>
                    <input type='text' name='new_name' placeholder='New Name'>
                    <input type='text' name='new_address' placeholder='New Address'>
                    <input type='text' name='new_capacity' placeholder='New Capacity'>
                    <button type='submit'>Update</button>
                </form>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>0 results</td></tr>";
}
echo "</table>";

$conn->close();
?>
