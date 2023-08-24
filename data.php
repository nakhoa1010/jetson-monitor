<?php
$server = "jetson.database.windows.net";
$user = "jetson-admin";
$password = "n5UMLqP!SG*b3f#";
$database = "jetson-monitor-database";

$conn = new mysqli($server, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT insertion_time, cpu_percent FROM system_stats ORDER BY insertion_time ASC";
$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

echo json_encode($data);
?>
