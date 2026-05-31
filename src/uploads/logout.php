<?php
session_start();

require "config/db.php";

if (isset($_SESSION["user_id"])) {
    $userId = intval($_SESSION["user_id"]);
    $conn->query("UPDATE users SET is_online = 0 WHERE id = $userId");
}

session_destroy();

header("Location: index.php");
exit;
?>
