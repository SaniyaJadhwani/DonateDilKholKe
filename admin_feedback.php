<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php");
    exit();
}

$con = new mysqli("localhost", "root", "", "donate_dilkholke");

// Mark as resolved
if (isset($_GET['resolve_id'])) {
    $id = intval($_GET['resolve_id']);
    $con->query("UPDATE feedback SET Status='Resolved' WHERE ID=$id");
    header("Location: admin_feedback.php");
    exit();
}

// Fetch feedbacks
$feedbacks = $con->query("SELECT * FROM feedback ORDER BY Timestamp DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Feedback / Contact Messages</title>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background: #f9f9f9;
    }

    .main-content {
      margin-left: 260px;
      padding: 30px;
    }

    h2 {
      color: #800000;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }

    th, td {
      padding: 15px;
      border-bottom: 1px solid #eee;
      text-align: left;
    }

    th {
      background: #800000;
      color: white;
    }

    .actions a {
      margin-right: 10px;
      text-decoration: none;
      color: #800000;
      font-weight: bold;
    }

    .status {
      padding: 5px 10px;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 500;
    }

    .Pending {
      background: #fff0f0;
      color: #b00000;
    }

    .Resolved {
      background: #d4edda;
      color: #155724;
    }
  </style>
</head>
<body>

<?php include 'admin_navbar.php'; ?>

<div class="main-content">
  <h2>User Feedback / Contact Messages</h2>
  <table>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Email</th>
      <th>Message</th>
      <th>Status</th>
      <th>Submitted At</th>
      <th>Actions</th>
    </tr>

    <?php if ($feedbacks->num_rows > 0): ?>
      <?php $count = 1; while ($row = $feedbacks->fetch_assoc()): ?>
        <tr>
          <td><?= $count++ ?></td>
          <td><?= htmlspecialchars($row['Username']) ?></td>
          <td><?= htmlspecialchars($row['Email']) ?></td>
          <td><?= nl2br(htmlspecialchars($row['Message'])) ?></td>
          <td><span class="status <?= htmlspecialchars($row['Status']) ?>"><?= htmlspecialchars($row['Status']) ?></span></td>
          <td><?= htmlspecialchars($row['Timestamp']) ?></td>
          <td class="actions">
            <a href="mailto:<?= htmlspecialchars($row['Email']) ?>?subject=Regarding your feedback">Reply</a>
            <?php if ($row['Status'] !== 'Resolved'): ?>
              <a href="?resolve_id=<?= $row['ID'] ?>" onclick="return confirm('Mark this message as resolved?')">Mark as Resolved</a>
            <?php endif; ?>
          </td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="7">No feedback messages found.</td></tr>
    <?php endif; ?>
  </table>
</div>

</body>
</html>
