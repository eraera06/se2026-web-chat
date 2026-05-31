<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$dbname = "webchat";
$port = 3307;

$conn = new mysqli($host, $user, $pass, $dbname, $port);

if ($conn->connect_error) {
    header("Content-Type: application/json");
    echo json_encode([
        "status" => "error",
        "message" => "Nuk u lidh me databazen: " . $conn->connect_error
    ]);
    exit;
}

$conn->set_charset("utf8mb4");
?>
