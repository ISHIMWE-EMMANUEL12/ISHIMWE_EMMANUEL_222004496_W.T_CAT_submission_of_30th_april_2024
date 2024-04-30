<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//ishimwe EMMANUEL 222004496-->
// Check if delete request is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Sanitize customer ID
    $customer_id = $_POST['delete'];

    // Prepare SQL statement to delete customer
    $sql = "DELETE FROM customer WHERE customer_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $customer_id);

    // Execute SQL statement
    if ($stmt->execute()) {
        echo "Customer deleted successfully";
        header("refresh:2"); // Refresh after 2 seconds
        exit();
    } else {
        echo "Error deleting customer: " . $conn->error;
    }

    $stmt->close();
}

// Check if form is submitted to update customer
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Collect and sanitize form data
    $customer_id = $_POST['customer_id'];
    $name = isset($_POST['name']) ? $_POST['name'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $phone = isset($_POST['phone']) ? $_POST['phone'] : "";

    // Prepare SQL statement to update customer
    $sql = "UPDATE customer SET name=?, email=?, phone=? WHERE customer_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $phone, $customer_id);

    // Execute SQL statement
    if ($stmt->execute()) {
        echo "Customer updated successfully";
        header("refresh:2"); // Refresh after 2 seconds
        exit();
    } else {
        echo "Error updating customer: " . $conn->error;
    }

    $stmt->close();
}

// Query to fetch all customers
$sql = "SELECT * FROM customer";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output table headers
    echo "<table>";
    echo "<tr><th>Customer ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Action</th></tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["customer_id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["phone"] . "</td>";
        // Adding buttons for delete and update
        echo "<td>
              <form method='post' style='display:inline;'>
                <input type='hidden' name='delete' value='" . $row["customer_id"] . "'>
                <button type='submit'>Delete</button>
              </form>
              <form method='get' action='update_customer.php' style='display:inline;'>
                <input type='hidden' name='customer_id' value='" . $row["customer_id"] . "'>
                <button type='submit'>Update</button>
              </form>
              </td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
