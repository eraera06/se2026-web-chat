<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isLoggedIn(): bool {
    return isset($_SESSION["user_id"]);
}

function requireLogin(): void {
    if (!isLoggedIn()) {
        header("Location: index.php");
        exit;
    }
}

function currentUserId(): int {
    return intval($_SESSION["user_id"] ?? 0);
}

function currentUserName(): string {
    return $_SESSION["name"] ?? "Përdoruesi";
}
?>
