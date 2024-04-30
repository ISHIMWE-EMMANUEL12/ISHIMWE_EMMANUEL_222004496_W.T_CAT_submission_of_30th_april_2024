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
if(isset($_REQUEST['parkingslot_id'])) {
    $parkinglot_id = $_REQUEST['parkingslot_id'];
    
    // Prepare and execute SELECT statement to retrieve customer details
    $stmt = $connection->prepare("SELECT * FROM parkingslot WHERE parkingslot_id = ?");
    $stmt->bind_param("i", $parkingslot_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['parkingslot_id'];
        $z = $row['slot_number'];
        $w = $row['size'];
        $v = $row['status'];
    } else {
        echo "slot not found.";
    }
}

?>

<html>
<head>
    <title>Update parkingslot</title>
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
        <label for="parkingslot_id">ID:</label>
        <input type="number" name="parkinglot_id" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="slot_number">slot_number:</label>
        <input type="text" name="slot_number" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="size">size:</label>
        <input type="text" name="size" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="status">status:</label>
        <input type="text" name="status" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
        
       
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $parkingslot_id = $_POST['parkingslot_id'];
    $slot_number = $_POST['slot_number'];
    $size = $_POST['size'];
    $status = $_POST['status'];
   // Update the customer in the database
    $stmt = $connection->prepare("UPDATE parkingslot SET slot_number=?, size=?, status=? WHERE parkingslot_id=?");
    $stmt->bind_param("ssss", $slot_number, $size, $status, $parkingslot_id);
    
    if ($stmt->execute()) {
          echo "<script>alert('parkingslotupdated successfully.'); window.location.href = 'update_parkingslot.php?id=$parkingslot_id';</script>";

        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating parkingslot: " . $stmt->error;
    }
}
?>
