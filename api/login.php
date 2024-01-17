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
$username = $conn->real_escape_string($input["username"]);
$password = $conn->real_escape_string($input["password"]);

// Check for duplicate username
$checkuser = "SELECT * FROM users WHERE username='$username' AND  password='$password'";
$res = $conn->query($checkuser); // Execute the query

if ($res) {
    // Check the number of rows returned by the query
    $count = $res->num_rows;

    if ($count > 0) {
        $result = '{"msg" : "1"}'; // Login Success
        echo $result;
    } else {
        $result = '{"msg" : "-1"}'; // Wrong username or password
        echo $result;
    
    }
} else {
    $result = '{"msg" : "0"}'; // Error executing the query
    echo $result;
}

// Close the database connection
$conn->close();
?>