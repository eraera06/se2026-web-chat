<?php
session_start();
header("Content-Type: application/json");

require "../config/db.php";
require "../config/paypal.php";

if (!isset($_SESSION["user_id"])) {
    echo json_encode(["status" => "error", "message" => "Nuk je loguar"]);
    exit;
}

$orderId = $_POST["order_id"] ?? "";

$ch = curl_init(PAYPAL_BASE_URL . "/v1/oauth2/token");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, PAYPAL_CLIENT_ID . ":" . PAYPAL_CLIENT_SECRET);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Accept: application/json"]);
$response = curl_exec($ch);
$data = json_decode($response, true);
curl_close($ch);

$token = $data["access_token"] ?? "";

$ch = curl_init(PAYPAL_BASE_URL . "/v2/checkout/orders/" . $orderId . "/capture");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer " . $token
]);

$response = curl_exec($ch);
$result = json_decode($response, true);
curl_close($ch);

if (($result["status"] ?? "") === "COMPLETED") {
    $userId = intval($_SESSION["user_id"]);

    $stmt = $conn->prepare("UPDATE users SET is_premium = 1 WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    $_SESSION["is_premium"] = 1;

    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => "Pagesa nuk u kompletua"]);
}
?>
