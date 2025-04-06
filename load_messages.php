<?php
session_start();
$con = new mysqli("localhost", "Saniya", "", "donate_dilkholke");

$user = $_SESSION['username'] ?? '';
$with = $_GET['with'] ?? '';

if (!$user || !$with) exit();

$sql = "SELECT * FROM messages 
        WHERE (sender = '$user' AND receiver = '$with') 
           OR (sender = '$with' AND receiver = '$user') 
        ORDER BY timestamp ASC";

$result = $con->query($sql);
while ($row = $result->fetch_assoc()) {
    $class = $row['sender'] === $user ? 'sent' : 'received';
    echo "<div class='message $class'>" . htmlspecialchars($row['message']) . "</div>";
}
