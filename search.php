<?php
header('Content-Type: application/json');
include_once("config.php");

$conn = new mysqli($host, $username, $password, $databasename);
if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$search = $conn->real_escape_string($_GET['search']);
$query = "SELECT * FROM articles WHERE title LIKE '%$search%' OR body LIKE '%$search%'";
$result = $conn->query($query);

$data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
echo json_encode($data);
$conn->close();
?>
