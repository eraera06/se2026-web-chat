<?php
session_start();
include "../config/db.php";

header("Content-Type: application/json");

if (!isset($_SESSION["user_id"])) {
    echo json_encode(["status" => "error", "message" => "Nuk je loguar"]);
    exit;
}

if (!isset($_POST["name"]) || trim($_POST["name"]) === "") {
    echo json_encode(["status" => "error", "message" => "Shkruaj emrin e grupit"]);
    exit;
}

if (!isset($_POST["members"]) || count($_POST["members"]) < 2) {
    echo json_encode(["status" => "error", "message" => "Zgjidh të paktën 2 anëtarë"]);
    exit;
}

$name = trim($_POST["name"]);
$currentUser = (int) $_SESSION["user_id"];
$members = $_POST["members"];

$stmt = $conn->prepare("INSERT INTO chats (name, type) VALUES (?, 'group')");

if (!$stmt) {
    echo json_encode(["status" => "error", "message" => "Gabim chats: " . $conn->error]);
    exit;
}

$stmt->bind_param("s", $name);
$stmt->execute();

$chatId = $stmt->insert_id;

$stmt = $conn->prepare("INSERT INTO chat_members (chat_id, user_id) VALUES (?, ?)");

if (!$stmt) {
    echo json_encode(["status" => "error", "message" => "Gabim members: " . $conn->error]);
    exit;
}

$stmt->bind_param("ii", $chatId, $currentUser);
$stmt->execute();

foreach ($members as $memberId) {
    $memberId = (int) $memberId;

    if ($memberId === $currentUser) {
        continue;
    }

    $stmt->bind_param("ii", $chatId, $memberId);
    $stmt->execute();
}

echo json_encode([
    "status" => "success",
    "chat_id" => $chatId
]);
exit;
?>
