<?php
session_start();
include "../config/db.php";

header("Content-Type: application/json");

if (!isset($_SESSION["user_id"])) {
    echo json_encode([]);
    exit;
}

$currentUser = $_SESSION["user_id"];

$q = "";

if (isset($_GET["q"])) {
    $q = trim($_GET["q"]);
}

$sql = "SELECT id, name, email 
        FROM users 
        WHERE id != ?";

$params = [$currentUser];
$types = "i";

if ($q !== "") {
    $sql .= " AND name LIKE ?";
    $params[] = "%$q%";
    $types .= "s";
}

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode([]);
    exit;
}

$stmt->bind_param($types, ...$params);
$stmt->execute();

$result = $stmt->get_result();

$users = [];

while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode($users);
?>
