<?php
session_start();
header("Content-Type: application/json");

require "../config/db.php";

if (!isset($_SESSION["user_id"])) {
    echo json_encode([]);
    exit;
}

$userId = intval($_SESSION["user_id"]);
$chatId = intval($_GET["chat_id"] ?? 0);
$lastId = intval($_GET["last_id"] ?? 0);

if ($chatId <= 0) {
    echo json_encode([]);
    exit;
}

$check = $conn->prepare("SELECT id FROM chat_members WHERE chat_id = ? AND user_id = ?");
$check->bind_param("ii", $chatId, $userId);
$check->execute();

if ($check->get_result()->num_rows === 0) {
    echo json_encode([]);
    exit;
}

$sql = "
SELECT 
    m.id,
    m.chat_id,
    m.sender_id,
    m.message,
    m.file_name,
    m.created_at,
    u.name,
    u.is_premium
FROM messages m
JOIN users u ON m.sender_id = u.id
WHERE m.chat_id = ?
AND m.id > ?
ORDER BY m.id ASC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $chatId, $lastId);
$stmt->execute();

$result = $stmt->get_result();

$messages = [];

while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

echo json_encode($messages);
?>
