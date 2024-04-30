<?php
// Connection details
$host = "localhost";
$user = "root";
$pass = "";
$database = "car";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if customer_id is set
if(isset($_REQUEST['parkinglot_id'])) {
    $parkinglot_id = $_REQUEST['parkinglot_id'];
    
    // Prepare and execute SELECT statement to retrieve customer details
    $stmt = $connection->prepare("SELECT * FROM parkinglot WHERE parkinglot_id = ?");
    $stmt->bind_param("i", $parkinglot_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['parkinglot_id'];
        $z = $row['name'];
        $w = $row['address'];
        $v = $row['capacity'];
    } else {
        echo "lot not found.";
    }
}

?>

<html>
<head>
    <title>Update parkinglot</title>
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
        <label for="parkinglot_id">ID:</label>
        <input type="number" name="parkinglot_id" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="name">name:</label>
        <input type="text" name="name" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="address">address:</label>
        <input type="text" name="address" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="capacity">capacity:</label>
        <input type="text" name="capacity" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
        
       
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $customer_id = $_POST['parkinglot_id'];
    $name = $_POST['name'];
    $email = $_POST['address'];
    $phone_number = $_POST['capacity'];
   // Update the customer in the database
    $stmt = $connection->prepare("UPDATE parkinglot SET name=?, address=?, capacity=? WHERE parkinglot_id=?");
    $stmt->bind_param("ssss", $name, $address, $capacity, $parkinglot_id);
    
    if ($stmt->execute()) {
          echo "<script>alert('parkinglotupdated successfully.'); window.location.href = 'parkinglot.php?id=$parkinglot_id';</script>";

        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating parkinglot: " . $stmt->error;
    }
}
?>
