<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "safex_database";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$BPM = $_POST["data"];
$sql = "INSERT INTO Heart_Beat(BPM) VALUES ('$BPM')";
if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
