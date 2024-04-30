<?php
// Establish database connection
$servername = "localhost";
$username = "EMMANUEL";
$password = "222004496";
$dbname = "car";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//ishimwe EMMANUEL 222004496-->
// Delete Reservation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_reservation_id'])) {
    $delete_reservation_id = $_POST['delete_reservation_id'];

    $sql_delete = "DELETE FROM reservation WHERE reservation_id = $delete_reservation_id";

    if ($conn->query($sql_delete) === TRUE) {
        echo "Reservation deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Update Reservation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_reservation_id'])) {
    $update_reservation_id = $_POST['update_reservation_id'];
    $new_start_time = $_POST['new_start_time'];
    $new_end_time = $_POST['new_end_time'];
    $new_cost = $_POST['new_cost'];

    $sql_update = "UPDATE reservation SET start_time='$new_start_time', end_time='$new_end_time', cost='$new_cost' WHERE reservation_id=$update_reservation_id";

    if ($conn->query($sql_update) === TRUE) {
        echo "Reservation updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// View Reservations
$sql_view = "SELECT * FROM reservation";
$result_view = $conn->query($sql_view);

echo "<h2>Reservations</h2>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Start Time</th><th>End Time</th><th>Cost</th><th>Action</th></tr>";

if ($result_view->num_rows > 0) {
    while($row = $result_view->fetch_assoc()) {
        // Output data as table rows
        echo "<tr>";
        echo "<td>" . $row["reservation_id"] . "</td>";
        echo "<td>" . $row["start_time"] . "</td>";
        echo "<td>" . $row["end_time"] . "</td>";
        echo "<td>" . $row["cost"] . "</td>";
        echo "<td>
                <form method='post' style='display:inline;'>
                    <input type='hidden' name='delete_reservation_id' value='" . $row[" reservation_id"] . "'>
                    <button type='submit'>Delete</button>
                </form>
                <form method='post' action='' style='display:inline;'>
                    <input type='hidden' name='update_reservation_id' value='" . $row["reservation_id"] . "'>
                    <input type='text' name='new_start_time' placeholder='New Start Time'>
                    <input type='text' name='new_end_time' placeholder='New End Time'>
                    <input type='text' name='new_cost' placeholder='New Cost'>
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
