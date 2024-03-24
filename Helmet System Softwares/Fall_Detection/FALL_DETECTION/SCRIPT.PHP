
<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "safex_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the fall detection data from the HTTP POST request
$fallDetected = $_POST["data"];

// Insert the fall detection data into the database
$sql = "INSERT INTO falldetection_event(Fall_Detected) VALUES ('$fallDetected')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
