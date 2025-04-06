<?php
session_start();
$con = new mysqli("localhost", "Saniya", "", "donate_dilkholke");
if ($con->connect_error) die("Connection Failed: " . $con->connect_error);

// Handle user deletion
if (isset($_POST['delete_user'])) {
    $username = $_POST['username'];
    $con->query("DELETE FROM users WHERE Username='$username'");
}

// Handle user editing
if (isset($_POST['edit_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $con->query("UPDATE users SET Email='$email', MobileNo='$mobile', Address='$address' WHERE Username='$username'");
}

// Get user list
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM users WHERE Username LIKE '%$search%' OR Email LIKE '%$search%'";
$users = $con->query($sql);

// Get user activity
$user_activity = $con->query("
  SELECT u.Username,
         (SELECT COUNT(*) FROM donation_items d WHERE d.Username = u.Username) AS total_donated,
         (SELECT COUNT(*) FROM request r WHERE r.RecieverName = u.Username) AS total_requested
  FROM users u
");

$total_users = $con->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Management - Admin Panel</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background: #fff0f0;
      display: flex;
    }

    .main-content {
      margin-left: 260px;
      padding: 30px;
      width: calc(100% - 260px);
    }

    h1 {
      text-align: center;
      color: #800000;
      margin-bottom: 20px;
    }

    .search-box {
      max-width: 400px;
      margin: auto;
      margin-bottom: 20px;
      display: flex;
      justify-content: center;
    }

    .search-box input {
      width: 100%;
      padding: 10px;
      border: 2px solid #800000;
      border-radius: 6px 0 0 6px;
      outline: none;
    }

    .search-box button {
      background: #800000;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 0 6px 6px 0;
      cursor: pointer;
    }

    .summary {
      text-align: center;
      margin-bottom: 15px;
      font-weight: bold;
      color: #800000;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background: white;
      border-radius: 10px;
      overflow: hidden;
    }

    th, td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: center;
    }

    th {
      background: #800000;
      color: white;
    }

    form.inline {
      display: inline-block;
    }

    input[type="text"], input[type="email"] {
      width: 100%;
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .btn {
      padding: 6px 12px;
      margin-top: 4px;
      font-size: 14px;
      border-radius: 4px;
      border: none;
      cursor: pointer;
    }

    .btn-edit {
      background: #ff9900;
      color: white;
    }

    .btn-delete {
      background: #cc0000;
      color: white;
    }

    .activity {
      margin-top: 40px;
    }

    .activity h2 {
      color: #800000;
      margin-bottom: 10px;
    }

    @media (max-width: 768px) {
      table {
        font-size: 12px;
      }

      .main-content {
        margin-left: 220px;
        width: calc(100% - 220px);
        padding: 20px;
      }
    }
  </style>
</head>
<body>

<?php include 'admin_navbar.php'; ?>

<div class="main-content">

  <h1>User Management</h1>

  <div class="search-box">
    <form method="get">
      <input type="text" name="search" placeholder="Search by username/email" value="<?php echo $search; ?>">
      <button type="submit">Search</button>
    </form>
  </div>

  <div class="summary">
    Total Registered Users: <?php echo $total_users; ?>
  </div>

  <table>
    <tr>
      <th>Username</th>
      <th>Email</th>
      <th>Mobile</th>
      <th>Address</th>
      <th>Actions</th>
    </tr>
    <?php while ($row = $users->fetch_assoc()): ?>
    <tr>
      <form method="post" class="inline">
        <td><input type="hidden" name="username" value="<?php echo $row['Username']; ?>"><?php echo $row['Username']; ?></td>
        <td><input type="email" name="email" value="<?php echo $row['Email']; ?>"></td>
        <td><input type="text" name="mobile" value="<?php echo $row['MobileNo']; ?>"></td>
        <td><input type="text" name="address" value="<?php echo $row['Address']; ?>"></td>
        <td>
          <button name="edit_user" class="btn btn-edit" onclick="return confirm('Save changes?')">Save</button>
          <button name="delete_user" class="btn btn-delete" onclick="return confirm('Delete this user?')">Delete</button>
        </td>
      </form>
    </tr>
    <?php endwhile; ?>
  </table>

  <div class="activity">
    <h2>User Activity Summary</h2>
    <table>
      <tr>
        <th>Username</th>
        <th>Total Donated</th>
        <th>Total Requested</th>
      </tr>
      <?php while ($row = $user_activity->fetch_assoc()): ?>
      <tr>
        <td><?php echo $row['Username']; ?></td>
        <td><?php echo $row['total_donated']; ?></td>
        <td><?php echo $row['total_requested']; ?></td>
      </tr>
      <?php endwhile; ?>
    </table>
  </div>

</div>
</body>
</html>
