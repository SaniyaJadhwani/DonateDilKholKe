<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php");
    exit();
}

$con = new mysqli("localhost", "Saniya", "", "donate_dilkholke");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentPassword = $_POST['current_password'];
    $newPassword     = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    $adminUsername   = $_SESSION['admin_username'];

    // Fetch current password from DB
    $result = $con->query("SELECT password FROM admin WHERE username = '$adminUsername'");
    $row = $result->fetch_assoc();

    if (password_verify($currentPassword, $row['password'])) {
        if ($newPassword === $confirmPassword) {
            $hashedNewPass = password_hash($newPassword, PASSWORD_DEFAULT);
            $con->query("UPDATE admin SET password = '$hashedNewPass' WHERE username = '$adminUsername'");
            $message = "Password successfully changed!";
        } else {
            $message = "New password and confirmation do not match!";
        }
    } else {
        $message = "Current password is incorrect!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <style>
        body { font-family: Poppins, sans-serif; background: #f8f9fa; padding: 50px; }
        .container {
            max-width: 400px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h2 { text-align: center; color: #800000; margin-bottom: 20px; }
        input[type=password], input[type=submit] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type=submit] {
            background-color: #800000;
            color: white;
            cursor: pointer;
        }
        .msg {
            text-align: center;
            color: green;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Change Password</h2>
    <?php if (!empty($message)) echo "<div class='msg'>$message</div>"; ?>
    <form method="POST">
        <input type="password" name="current_password" placeholder="Current Password" required>
        <input type="password" name="new_password" placeholder="New Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
        <input type="submit" value="Change Password">
    </form>
</div>
</body>
</html>
