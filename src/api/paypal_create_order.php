<?php
session_start();
header("Content-Type: application/json");

require "../config/paypal.php";

if (!isset($_SESSION["user_id"])) {
    echo json_encode(["status" => "error", "message" => "Nuk je loguar"]);
    exit;
}

$amount = "4.99";

$ch = curl_init(PAYPAL_BASE_URL . "/v1/oauth2/token");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, PAYPAL_CLIENT_ID . ":" . PAYPAL_CLIENT_SECRET);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Accept: application/json"]);
$response = curl_exec($ch);
$data = json_decode($response, true);
curl_close($ch);

if (!isset($data["access_token"])) {
    echo json_encode(["status" => "error", "message" => "PayPal token error"]);
    exit;
}

$orderData = [
    "intent" => "CAPTURE",
    "purchase_units" => [[
        "description" => "WebChat Premium",
        "amount" => [
            "currency_code" => "USD",
            "value" => $amount
        ]
    ]]
];

$ch = curl_init(PAYPAL_BASE_URL . "/v2/checkout/orders");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($orderData));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer " . $data["access_token"]
]);

echo curl_exec($ch);
curl_close($ch);
?>
