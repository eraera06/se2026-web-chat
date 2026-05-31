<?php
session_start();
include "../config/db.php";

header("Content-Type: application/json");

if (!isset($_SESSION["user_id"])) {
    echo json_encode([
        "status" => "error",
        "message" => "Nuk je loguar"
    ]);
    exit;
}

if (!isset($_POST["user_id"])) {
    echo json_encode([
        "status" => "error",
        "message" => "Mungon user_id"
    ]);
    exit;
}

$me = (int) $_SESSION["user_id"];
$other = (int) $_POST["user_id"];

if ($me === $other) {
    echo json_encode([
        "status" => "error",
        "message" => "Nuk mund të hapësh chat me veten"
    ]);
    exit;
}

/* Kontrollo nëse ekziston chat privat mes këtyre dy userave */
$sql = "
SELECT c.id
FROM chats c
JOIN chat_members cm1 ON c.id = cm1.chat_id
JOIN chat_members cm2 ON c.id = cm2.chat_id
WHERE c.type = 'private'
AND cm1.user_id = ?
AND cm2.user_id = ?
LIMIT 1
";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode([
        "status" => "error",
        "message" => "Gabim prepare: " . $conn->error
    ]);
    exit;
}

$stmt->bind_param("ii", $me, $other);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode([
        "status" => "success",
        "chat_id" => $row["id"]
    ]);
    exit;
}

/* Nëse nuk ekziston, krijo chat të ri */
$stmt = $conn->prepare("INSERT INTO chats (type, name) VALUES ('private', '')");

if (!$stmt) {
    echo json_encode([
        "status" => "error",
        "message" => "Gabim insert chat: " . $conn->error
    ]);
    exit;
}

$stmt->execute();
$chatId = $stmt->insert_id;

/* Shto dy anëtarët */
$stmt = $conn->prepare("INSERT INTO chat_members (chat_id, user_id) VALUES (?, ?), (?, ?)");

if (!$stmt) {
    echo json_encode([
        "status" => "error",
        "message" => "Gabim insert members: " . $conn->error
    ]);
    exit;
}

$stmt->bind_param("iiii", $chatId, $me, $chatId, $other);
$stmt->execute();

echo json_encode([
    "status" => "success",
    "chat_id" => $chatId
]);
exit;
?>
