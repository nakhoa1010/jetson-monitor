<?php
$server = "jetson-monitor-db.mysql.database.azure.com";
$user = "jetsonadmin";
$password = "n5UMLqP!SG*b3f#";
$database = "monitor-db";

$conn = mysqli_init();
mysqli_ssl_set($conn,NULL,NULL, "K:\jetson\azure\DigiCertGlobalRootCA.crt.pem", NULL, NULL);
mysqli_real_connect($conn, $server, $user, $password, $database, 3306, MYSQLI_CLIENT_SSL);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM system_stats ORDER BY insertion_time DESC LIMIT 1";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<p>CPU Percent: " . $row['cpu_percent'] . "%</p>";
    echo "<p>Memory Total: " . $row['memory_total'] . " GB</p>";
    echo "<p>Memory Available: " . $row['memory_available'] . " GB</p>";
    echo "<p>Memory Used: " . $row['memory_used'] . " GB</p>";
    echo "<p>Memory Free: " . $row['memory_free'] . " GB</p>";
    echo "<p>Insertion Time: " . $row['insertion_time'] . "</p>";
} else {
    echo "No data available.";
}

$conn->close();
?>
