<?php
// Connection details
$servername = "localhost";
$username = "EMMANUEL";
$password = "222004496";
$dbname = "car";

// Create the connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//ishimwe EMMANUEL 222004496-->
// Check if customer_id is set and is a positive integer
if(isset($_GET['customer_id']) && is_numeric($_GET['customer_id']) && $_GET['customer_id'] > 0) {
    $id = $_GET['customer_id']; // No need to escape, prepared statements handle it

    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM customer WHERE customer_id=?");
    if($stmt) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            // Redirect to customer.php after successful deletion
            header('Location: delete_customer.php?msg=Data deleted successfully');
            header("refresh:2; url=customer.html"); // Redirect after 2 seconds
            exit(); // Ensure no other content is sent after redirection
        } else {
            echo "Error executing deletion: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "Invalid customer ID";
    header("refresh:2; url=registration.html"); // Redirect after 2 seconds
}

$conn->close();
?>
