<?php
session_start();
header("Content-Type: application/json");

if (isset($_SESSION["user_id"])) {
    echo json_encode([
        "status" => "success",
        "user_id" => $_SESSION["user_id"],
        "name" => $_SESSION["name"] ?? "Perdoruesi",
        "is_premium" => $_SESSION["is_premium"] ?? 0
    ]);
} else {
    echo json_encode([
        "status" => "error"
    ]);
}
?>
