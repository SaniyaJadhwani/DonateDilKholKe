<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel</title>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <style>
    :root {
      --maroon: #800000;
      --light: #fff;
      --dark: #333;
    }

    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      display: flex;
      height: 100vh;
      background: #fff0f0;
    }

    .sidebar {
      width: 250px;
      background: var(--maroon);
      color: var(--light);
      position: fixed;
      height: 100%;
      top: 0;
      left: 0;
      overflow-y: auto;
      transition: width 0.3s ease;
    }

    .sidebar .logo {
      padding: 20px;
      font-size: 22px;
      font-weight: bold;
      text-align: center;
      border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .sidebar ul li {
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .sidebar ul li a {
      display: flex;
      align-items: center;
      padding: 15px 20px;
      color: var(--light);
      text-decoration: none;
      transition: background 0.3s;
    }

    .sidebar ul li a:hover {
      background: #a00000;
    }

    .sidebar ul li a i {
      margin-right: 12px;
      font-size: 18px;
    }

    .sidebar ul li a .badge {
      margin-left: auto;
      background: #fff;
      color: #800000;
      padding: 2px 6px;
      border-radius: 12px;
      font-size: 12px;
    }

    .toggle-btn {
      position: absolute;
      top: 15px;
      left: 260px;
      font-size: 24px;
      cursor: pointer;
      color: var(--maroon);
      transition: left 0.3s ease;
    }

    .collapsed .sidebar {
      width: 70px;
    }

    .collapsed .sidebar ul li a span {
      display: none;
    }

    .collapsed .toggle-btn {
      left: 80px;
    }

    .collapsed .main-content {
      margin-left: 70px !important;
      width: calc(100% - 70px);
    }

    .main-content {
      margin-left: 250px;
      padding: 30px;
      width: calc(100% - 250px);
      transition: margin-left 0.3s ease;
    }

    @media (max-width: 768px) {
      .toggle-btn {
        left: 80px;
      }

      .sidebar {
        width: 70px;
      }

      .sidebar ul li a span {
        display: none;
      }

      .main-content {
        margin-left: 70px !important;
        width: calc(100% - 70px);
      }
    }
  </style>
</head>
<body>

<div class="sidebar">
  <div class="logo">
    Admin Panel
  </div>
  <ul>
    <li><a href="admin_dashboard.php"><i class='bx bxs-dashboard'></i> <span>Dashboard</span></a></li>
    <li><a href="user_management.php"><i class='bx bxs-user'></i> <span>User Management</span></a></li>
    <li><a href="donation_management.php"><i class='bx bxs-box'></i> <span>Donation Management</span></a></li>
    <li><a href="request_management.php"><i class='bx bxs-envelope'></i> <span>Request Management</span></a></li>
    <li><a href="reported_content.php"><i class='bx bxs-flag'></i> <span>Reported Content</span></a></li>
    <li><a href="website_settings.php"><i class='bx bxs-cog'></i> <span>Website Settings</span></a></li>
    <li><a href="feedback.php"><i class='bx bxs-message-rounded-dots'></i> <span>Feedback</span></a></li>
    <li><a href="admin_change_password.php"><i class='bx bxs-lock'></i> <span>Change Password</span></a></li>
    <li><a href="admin_logout.php"><i class='bx bxs-log-out'></i> <span>Logout</span></a></li>
  </ul>
</div>

<i class='bx bx-menu toggle-btn' onclick="toggleSidebar()"></i>

<script>
  function toggleSidebar() {
    document.body.classList.toggle('collapsed');
  }
</script>
