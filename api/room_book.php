<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Data fetch from frontend using POST method
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

// Sanitize user input to prevent SQL injection
$idate = $conn->real_escape_string($input["idate"]);
$odate = $conn->real_escape_string($input["odate"]);
$room_type = $conn->real_escape_string($input["room_type"]);

$fname = $conn->real_escape_string($input["fname"]);
$phone = $conn->real_escape_string($input["phone"]);
$address = $conn->real_escape_string($input["address"]);
$email = $conn->real_escape_string($input["email"]);
// Check for duplicate idate
#$checkuser = "INSERT * FROM room_bookings WHERE idate='$idate' AND room_type='$room_type' AND  odate='$odate' ";

$sql="INSERT INTO `room_bookings` (`id`, `room_type`, `idate`, `odate`, `uid`, `phone`, `address`, `email`) VALUES (NULL, '$room_type', '$idate', '$odate', '$fname', '$phone', '$address', '$email')";
#echo $sql;
$res = $conn->query($sql); // Execute the query

if ($res) {
    // Check the number of rows returned by the query
   
        $result = '{"msg" : "2"}'; // Room is available
        echo $result;
    
   
   
   // echo $result;
}

// Close the database connection
$conn->close();
?>