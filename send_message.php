<?php
session_start();
$con = new mysqli("localhost", "Saniya", "", "donate_dilkholke");

$from = $_SESSION['username'] ?? '';
$to = $_POST['to'] ?? '';
$message = trim($_POST['message'] ?? '');

if ($from && $to && $message !== "") {
    $stmt = $con->prepare("INSERT INTO messages (sender, receiver, message, timestamp) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sss", $from, $to, $message);
    $stmt->execute();
}
