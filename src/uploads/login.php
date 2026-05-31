<?php
session_start();
header("Content-Type: application/json");
require "../config/db.php";

$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if ($user && password_verify($password, $user["password"])) {
    $_SESSION["user_id"] = $user["id"];
    $_SESSION["name"] = $user["name"];

    mysqli_query($conn, "UPDATE users SET is_online = 1 WHERE id = " . $user["id"]);

    echo json_encode([
        "status" => "success",
        "user_id" => $user["id"],
        "name" => $user["name"]
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Email ose password gabim"
    ]);
}
?>
