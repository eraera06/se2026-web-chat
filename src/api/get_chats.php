<?php
session_start();
include "../config/db.php";

header("Content-Type: application/json");

if (!isset($_SESSION["user_id"])) {
    echo json_encode([]);
    exit;
}

$userId = (int) $_SESSION["user_id"];

$sql = "
SELECT 
    c.id,
    c.name,
    c.type,
    MAX(m.created_at) AS last_time,
    SUBSTRING_INDEX(
        GROUP_CONCAT(m.message ORDER BY m.created_at DESC SEPARATOR '|||'),
        '|||',
        1
    ) AS last_message
FROM chats c
JOIN chat_members cm ON c.id = cm.chat_id
LEFT JOIN messages m ON c.id = m.chat_id
WHERE cm.user_id = ?
GROUP BY c.id, c.name, c.type
ORDER BY last_time DESC, c.id DESC
";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode([]);
    exit;
}

$stmt->bind_param("i", $userId);
$stmt->execute();

$result = $stmt->get_result();
$chats = [];

while ($row = $result->fetch_assoc()) {
    if ($row["type"] === "group") {
        $row["name"] = $row["name"] ?: "Group Chat";
    }

    if ($row["last_message"] === null || $row["last_message"] === "") {
        $row["last_message"] = "Asnjë mesazh";
    }

    $chats[] = $row;
}

echo json_encode($chats);
exit;
?>
