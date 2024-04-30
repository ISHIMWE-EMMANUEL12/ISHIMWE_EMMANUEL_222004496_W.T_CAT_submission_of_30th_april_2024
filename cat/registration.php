<?php
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
//ishimwe EMMANUEL 222004496-->
// Insert new record
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form fields are set
    if(isset($_POST['name'], $_POST['phone'], $_POST['address'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['hired_date'])){
        // Collect form data
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hired_date = $_POST['hired_date'];

        // Prepare SQL statement
        $sql = "INSERT INTO registration (name, phone, address, email, username, password, hired_date)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $name, $phone, $address, $email, $username, $password, $hired_date);

        if ($stmt->execute()) {
            echo "New record created successfully";
            header("refresh:2; url=registration.html"); // Redirect after 2 seconds
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// View data
$sql_view = "SELECT * FROM registration";
$result = $conn->query($sql_view);

echo "<table>";
echo "<tr><th>Name</th><th>Phone</th><th>Address</th><th>Email</th><th>Username</th><th>Password</th><th>Hired Date</th><th>Action</th></tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Output data as table rows
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["phone"] . "</td>";
        echo "<td>" . $row["address"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["password"] . "</td>";
        echo "<td>" . $row["hired_date"] . "</td>";
        echo "<td>
                <form method='post' style='display:inline;'>
                    <input type='hidden' name='id_to_delete' value='" . $row["id"] . "'>
                    <button type='submit'>Delete</button>
                </form>
                <form method='post' action='update_registration.php' style='display:inline;'>
                    <input type='hidden' name='id_to_update' value='" . $row["id"] . "'>
                    <button type='submit'>Update</button>
                </form>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8'>0 results</td></tr>";
}
echo "</table>";

// Close database connection
$conn->close();
?>
