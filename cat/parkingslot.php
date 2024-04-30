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
// Delete Parking Slot
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_slot_number'])) {
    $delete_slot_number = $_POST['delete_slot_number'];

    $sql_delete = "DELETE FROM parkingslot WHERE slot_number = '$delete_slot_number'";

    if ($conn->query($sql_delete) === TRUE) {
        echo "Parking Slot deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Update Parking Slot
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_slot_number'])) {
    $update_slot_number = $_POST['update_slot_number'];
    $new_size = $_POST['new_size'];
    $new_status = $_POST['new_status'];

    $sql_update = "UPDATE parkingslot SET size='$new_size', status='$new_status' WHERE slot_number='$update_slot_number'";

    if ($conn->query($sql_update) === TRUE) {
        echo "Parking Slot updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// View Parking Slots
$sql_view = "SELECT * FROM parkingslot";
$result_view = $conn->query($sql_view);

echo "<h2>Parking Slots</h2>";
echo "<table border='1'>";
echo "<tr><th>Slot Number</th><th>Size</th><th>Status</th><th>Action</th></tr>";

if ($result_view->num_rows > 0) {
    while($row = $result_view->fetch_assoc()) {
        // Output data as table rows
        echo "<tr>";
        echo "<td>" . $row["slot_number"] . "</td>";
        echo "<td>" . $row["size"] . "</td>";
        echo "<td>" . $row["status"] . "</td>";
        echo "<td>
                <form method='post' style='display:inline;'>
                    <input type='hidden' name='delete_slot_number' value='" . $row["slot_number"] . "'>
                    <button type='submit'>Delete</button>
                </form>
                <form method='post' action='' style='display:inline;'>
                    <input type='hidden' name='update_slot_number' value='" . $row["slot_number"] . "'>
                    <input type='text' name='new_size' placeholder='New Size'>
                    <input type='text' name='new_status' placeholder='New Status'>
                    <button type='submit'>Update</button>
                </form>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>0 results</td></tr>";
}
echo "</table>";

$conn->close();
?>
