<?php
session_start();
header("Content-Type: application/json");

require_once "../config/db.php";

$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";

if ($name === "" || $email === "" || $password === "") {
    echo json_encode([
        "status" => "error",
        "message" => "Plotëso të gjitha fushat"
    ]);
    exit;
}

if (strlen($password) < 6) {
    echo json_encode([
        "status" => "error",
        "message" => "Password duhet të ketë minimumi 6 karaktere"
    ]);
    exit;
}

$check = $conn->prepare("SELECT id FROM users WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$res = $check->get_result();

if ($res->num_rows > 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Ky email ekziston"
    ]);
    exit;
}

$hashed = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $hashed);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Llogaria u krijua"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Gabim regjistrimi: " . $conn->error
    ]);
}
?>
