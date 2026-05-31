<?php
session_start();
header("Content-Type: application/json");

require_once "../config/db.php";

$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";

if ($email === "" || $password === "") {
    echo json_encode([
        "status" => "error",
        "message" => "Plotëso email dhe password"
    ]);
    exit;
}

$stmt = $conn->prepare("SELECT id, name, email, password, is_premium FROM users WHERE email = ?");

if (!$stmt) {
    echo json_encode([
        "status" => "error",
        "message" => "Gabim në query: " . $conn->error
    ]);
    exit;
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Ky email nuk ekziston"
    ]);
    exit;
}

$user = $result->fetch_assoc();

if (!password_verify($password, $user["password"])) {
    echo json_encode([
        "status" => "error",
        "message" => "Password gabim"
    ]);
    exit;
}

$_SESSION["user_id"] = $user["id"];
$_SESSION["name"] = $user["name"];
$_SESSION["email"] = $user["email"];
$_SESSION["is_premium"] = $user["is_premium"];

$conn->query("UPDATE users SET is_online = 1 WHERE id = " . intval($user["id"]));

echo json_encode([
    "status" => "success",
    "message" => "Login me sukses",
    "user_id" => $user["id"],
    "name" => $user["name"],
    "is_premium" => $user["is_premium"]
]);
?>
