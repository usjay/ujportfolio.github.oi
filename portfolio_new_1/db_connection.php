<?php
function connectDatabase() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "test"; // Change this to your database name

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>
