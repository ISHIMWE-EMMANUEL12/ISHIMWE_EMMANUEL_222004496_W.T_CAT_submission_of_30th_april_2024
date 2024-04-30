<?php
session_start();

// Establish database connection
$servername = "localhost";
$username = "EMMANUEL";
$password = "222004496";
$dbname = "car";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare SQL statement to check user credentials
$sql = "SELECT * FROM registration WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User found, set session and redirect to home page
    $_SESSION['username'] = $username;
    $conn->close();
    header("Location: index.html"); // Redirect to index page
    exit();
} else {
    // Invalid credentials, display error message and redirect back to login form
    echo "User not found";
    header("refresh:2; url=login.html"); // Redirect after 2 seconds
    exit();
}
?>
