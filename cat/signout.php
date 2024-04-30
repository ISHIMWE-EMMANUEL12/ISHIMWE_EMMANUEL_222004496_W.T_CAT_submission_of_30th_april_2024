<?php
// Database connection parameters
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

// Process sign-up form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "INSERT INTO registration (username, password)
            VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to signup page with success parameter
        header('Location: signout.html?success=true');
        header("refresh:2; url=index.html"); // Redirect after 2 seconds
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
