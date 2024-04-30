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
// Delete Car
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_age'])) {
    $delete_id = $_POST['delete_age'];

    $sql_delete = "DELETE FROM car WHERE age = $delete_age";

    if ($conn->query($sql_delete) === TRUE) {
        echo "Car deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Update Car
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_age'])) {
    $update_age = $_POST['update_age'];
    $new_name = $_POST['new_name'];
    $new_age = $_POST['new_age'];
    $new_model = $_POST['new_model'];
    $new_manufacturer = $_POST['new_manufacturer'];

    $sql_update = "UPDATE car SET name='$new_name', age='$new_age', model='$new_model', manufacturer='$new_manufacturer' WHERE age=$update_age";

    if ($conn->query($sql_update) === TRUE) {
        echo "Car updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// View Cars
$sql_view = "SELECT * FROM car";
$result_view = $conn->query($sql_view);

echo "<h2>Cars</h2>";
echo "<table border='1'>";
echo "<tr><th>Name</th><th>Age</th><th>Model</th><th>Manufacturer</th><th>Action</th></tr>";

if ($result_view->num_rows > 0) {
    while($row = $result_view->fetch_assoc()) {
        // Output data as table rows
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["age"] . "</td>";
        echo "<td>" . $row["model"] . "</td>";
        echo "<td>" . $row["manufacturer"] . "</td>";
        echo "<td>
                <form method='post' style='display:inline;'>
                    <input type='hidden' name='delete_age' value='" . $row["age"] . "'>
                    <button type='submit'>Delete</button>
                </form>
                <form method='post' action='' style='display:inline;'>
                    <input type='hidden' name='update_age' value='" . $row["age"] . "'>
                    <input type='text' name='new_name' placeholder='New Name'>
                    <input type='text' name='new_age' placeholder='New Age'>
                    <input type='text' name='new_model' placeholder='New Model'>
                    <input type='text' name='new_manufacturer' placeholder='New Manufacturer'>
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
