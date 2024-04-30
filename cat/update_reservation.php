<?php
// Connection details
$host = "localhost";
$user = "EMMANUEL";
$pass = "222004496";
$database = "car";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
//ishimwe EMMANUEL 222004496-->
// Check if customer_id is set
if(isset($_REQUEST['id'])) {
    $cid = $_REQUEST['id'];
    
    // Prepare and execute SELECT statement to retrieve customer details
    $stmt = $connection->prepare("SELECT * FROM reservation WHERE reservation_id = ?");
    $stmt->bind_param("i", $reservation_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['reservation_id'];
        $z = $row['start_time'];
        $w = $row['end_time'];
        $v = $row['cost'];
    } else {
        echo "reservation not made.";
    }
}

?>

<html>
<head>
    <title>Update Customer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        form {
            background-color: #fff;
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form method="POST">
        <label for="reservation_id">reservation_id:</label>
        <input type="number" name="reservation_id" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="start_time">start_time:</label>
        <input type="text" name="start_time" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="end_time">end_time:</label>
        <input type="text" name="end_time" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="cost">cost:</label>
        <input type="text" name="cost" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
        
       
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $reservation_id = $_POST['reservation_id'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $cost = $_POST['cost'];
   // Update the reservation in the database
    $stmt = $connection->prepare("UPDATE reservation SET start_time=?, end_time=?, cost=? WHERE reservation_id=?");
    $stmt->bind_param("ssss", $start_time, $end_time, $cost, $reservation_id);
    
    if ($stmt->execute()) {
          echo "<script>alert('reservedupdated successfully.'); window.location.href = 'reservation.php?id=$reservation_id';</script>";
           header("refresh:2; url=reservation.html"); // Redirect after 2 seconds

        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating reservation: " . $stmt->error;
    }
}
?>
