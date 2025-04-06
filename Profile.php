<?php
session_start();
$uname = $_SESSION['username'];

$con = new mysqli("localhost", "Saniya", "", "donate_dilkholke");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Handle profile picture upload
if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
    $targetDir = "uploads/";
    $fileName = basename($_FILES["profile_pic"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $targetFilePath)) {
        $con->query("UPDATE users SET ProfilePic='$fileName' WHERE Username='$uname'");
    }
}

// Handle settings update
if (isset($_POST['update_profile'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];

    $con->query("UPDATE users SET Email='$email', Password='$password', MobileNo='$mobile', Address='$address' WHERE Username='$uname'");
}

// Handle Accept/Decline action
if (isset($_POST['action']) && isset($_POST['request_id'])) {
    $action = $_POST['action'];
    $requestId = $_POST['request_id'];
    $con->query("UPDATE request SET Status='$action' WHERE RequestId='$requestId'");
}

// Get profile details
$user_result = $con->query("SELECT * FROM users WHERE Username='$uname'");
$user = $user_result->fetch_assoc();
$profilePic = !empty($user['ProfilePic']) ? "uploads/" . $user['ProfilePic'] : "uploads/default.png";

// Received requests
$received_requests = $con->query("SELECT r.*, d.Item, u.Email, u.MobileNo FROM request r JOIN donation_items d ON r.DonationId = d.DonationId JOIN users u ON r.RecieverName = u.Username WHERE r.DonorName='$uname' ORDER BY r.RequestId DESC");

// Sent requests
$sent_requests = $con->query("SELECT r.*, d.Item, u.Email, u.MobileNo FROM request r JOIN donation_items d ON r.DonationId = d.DonationId JOIN users u ON r.DonorName = u.Username WHERE r.RecieverName='$uname' ORDER BY r.RequestId DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Profile</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-color: #fff8f8;
    }

    .container {
      width: 90%;
      max-width: 1000px;
      margin: 40px auto;
      background: white;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }

    .profile-pic {
      display: block;
      margin: 0 auto 25px auto;
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #800000;
    }

    .tabs {
      display: flex;
      justify-content: center;
      margin-bottom: 25px;
    }

    .tab {
      padding: 10px 20px;
      background: #800000;
      color: white;
      margin: 0 10px;
      cursor: pointer;
      border-radius: 5px;
      transition: background 0.3s ease;
    }

    .tab.active {
      background: #a10000;
    }

    .tab-content {
      display: none;
    }

    .tab-content.active {
      display: block;
    }

    label {
      font-weight: 600;
      margin-top: 10px;
      display: block;
    }

    input[type="text"], input[type="password"], input[type="email"], input[type="file"] {
      width: 100%;
      padding: 10px;
      margin: 8px 0 15px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    .btn-update {
      margin-top: 10px;
      padding: 10px 25px;
      background-color: #800000;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
    }

    .notification-box {
      background: #fff3f3;
      border-left: 5px solid #800000;
      margin-bottom: 15px;
      padding: 15px;
      border-radius: 8px;
    }

    .accept-btn, .decline-btn {
      padding: 6px 14px;
      color: white;
      border: none;
      border-radius: 4px;
      margin-right: 8px;
      cursor: pointer;
    }

    .accept-btn { background-color: green; }
    .decline-btn { background-color: red; }

    .section-title {
      font-size: 22px;
      color: #800000;
      margin-bottom: 10px;
      font-weight: bold;
    }

    @media (max-width: 768px) {
      .tab {
        font-size: 0.9rem;
        padding: 8px 14px;
      }

      .btn-update {
        width: 100%;
      }
    }
  </style>
</head>
<body>

  <?php include 'header.php'; ?>

  <div class="container">
    <img src="<?php echo $profilePic; ?>" class="profile-pic" alt="Profile Picture">

    <div class="tabs">
      <div class="tab active" onclick="openTab('settings')">Settings</div>
      <div class="tab" onclick="openTab('notifications')">Notifications</div>
    </div>

    <!-- SETTINGS -->
    <div id="settings" class="tab-content active">
      <form action="" method="POST" enctype="multipart/form-data">
        <label>Username:</label>
        <input type="text" value="<?php echo $user['Username']; ?>" disabled>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $user['Email']; ?>">

        <label>Password:</label>
        <input type="password" name="password" value="<?php echo $user['Password']; ?>">

        <label>Mobile No:</label>
        <input type="text" name="mobile" value="<?php echo $user['MobileNo']; ?>">

        <label>Address:</label>
        <input type="text" name="address" value="<?php echo $user['Address']; ?>">

        <label>Update Profile Picture:</label>
        <input type="file" name="profile_pic">

        <button class="btn-update" type="submit" name="update_profile">Update</button>
      </form>
    </div>

    <!-- NOTIFICATIONS -->
    <div id="notifications" class="tab-content">
      <div class="section-title">📥 Requests Received</div>
      <?php while ($row = $received_requests->fetch_assoc()): ?>
        <div class="notification-box">
          <strong><?php echo $row['RecieverName']; ?></strong> requested <strong><?php echo $row['Item']; ?></strong><br>
          Status: <strong><?php echo $row['Status']; ?></strong>
          <?php if ($row['Status'] == 'Pending'): ?>
            <form method="post" onsubmit="return confirm('Are you sure you want to proceed?');">
              <input type="hidden" name="request_id" value="<?php echo $row['RequestId']; ?>">
              <button type="submit" name="action" value="Accepted" class="accept-btn">Accept</button>
              <button type="submit" name="action" value="Declined" class="decline-btn">Decline</button>
            </form>
          <?php endif; ?>
        </div>
      <?php endwhile; ?>

      <div class="section-title">📤 Requests Sent</div>
      <?php while ($row = $sent_requests->fetch_assoc()): ?>
        <div class="notification-box">
          You requested <strong><?php echo $row['Item']; ?></strong> from <strong><?php echo $row['DonorName']; ?></strong><br>
          Status: <strong><?php echo $row['Status']; ?></strong><br>
          <?php if ($row['Status'] == 'Accepted'): ?>
            📞 Contact Donor: <?php echo $row['MobileNo']; ?> | ✉️ <?php echo $row['Email']; ?>
          <?php endif; ?>
        </div>
      <?php endwhile; ?>
    </div>
  </div>

  <script>
    function openTab(tabId) {
      document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
      document.querySelectorAll('.tab-content').forEach(tc => tc.classList.remove('active'));
      document.getElementById(tabId).classList.add('active');
      document.querySelector(`.tab[onclick="openTab('${tabId}')"]`).classList.add('active');
    }

    setInterval(() => {
      if (document.getElementById("notifications").classList.contains("active")) {
        location.reload();
      }
    }, 30000); // Refresh every 30 sec
  </script>

</body>
</html>
