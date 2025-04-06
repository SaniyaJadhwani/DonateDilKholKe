<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php");
    exit();
}

$con = new mysqli("localhost", "root", "", "donate_dilkholke");

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentPassword = $_POST['current_password'];
    $newPassword     = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    $adminUsername   = $_SESSION['admin_username'];

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
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Change Password</title>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: #fff0f0;
      display: flex;
    }

    .main-content {
      margin-left: 250px; /* Adjust if your sidebar has a different width */
      padding: 30px;
      width: calc(100% - 250px);
      transition: margin-left 0.3s ease;
    }

    .container {
      max-width: 500px;
      margin: auto;
      background: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #800000;
      margin-bottom: 20px;
    }

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
      font-weight: bold;
    }

    .msg {
      text-align: center;
      color: green;
      margin-bottom: 10px;
    }

    .error-msg {
      text-align: center;
      color: red;
      margin-bottom: 10px;
    }

    @media (max-width: 768px) {
      .main-content {
        margin-left: 70px;
        width: calc(100% - 70px);
      }
    }
  </style>
</head>
<body>

<?php include 'admin_navbar.php'; ?>

<div class="main-content">
  <div class="container">
    <h2>Change Password</h2>
    <?php if (!empty($message)): ?>
      <div class="<?= strpos($message, 'successfully') !== false ? 'msg' : 'error-msg' ?>">
        <?= $message ?>
      </div>
    <?php endif; ?>
    <form method="POST">
      <input type="password" name="current_password" placeholder="Current Password" required>
      <input type="password" name="new_password" placeholder="New Password" required>
      <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
      <input type="submit" value="Change Password">
    </form>
  </div>
</div>

<script>
  function toggleSidebar() {
    document.body.classList.toggle('collapsed');
  }
</script>

</body>
</html>
