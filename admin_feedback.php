<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php");
    exit();
}

$con = new mysqli("localhost", "root", "", "donate_dilkholke");

// Mark as resolved and store admin reply
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['reply_id'])) {
    $id = intval($_POST['reply_id']);
    $admin_reply = $con->real_escape_string($_POST['admin_reply']);

    $update = $con->prepare("UPDATE feedback SET Status='Resolved', admin_reply=? WHERE ID=?");
    $update->bind_param("si", $admin_reply, $id);
    $update->execute();

    header("Location: admin_feedback.php");
    exit();
}

// Fetch all feedbacks
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
      vertical-align: top;
      text-align: left;
    }

    th {
      background: #800000;
      color: white;
    }

    .actions a, .actions form input[type="submit"] {
      margin-right: 10px;
      text-decoration: none;
      color: #800000;
      font-weight: bold;
      background: none;
      border: none;
      cursor: pointer;
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

    .admin-reply-box {
      margin-top: 10px;
    }

    .admin-reply-box textarea {
      width: 100%;
      padding: 8px;
      font-size: 14px;
      border-radius: 6px;
      border: 1px solid #ccc;
      resize: vertical;
      margin-top: 5px;
    }

    .admin-reply-box input[type="submit"] {
      margin-top: 8px;
      background-color: #800000;
      color: white;
      padding: 8px 14px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .admin-reply-box input[type="submit"]:hover {
      background-color: #a00000;
    }

    .reply-view {
      margin-top: 8px;
      font-style: italic;
      color: #333;
      background-color: #f0f0f0;
      padding: 8px;
      border-radius: 6px;
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
          <td><?= nl2br(htmlspecialchars($row['Message'])) ?>
            <?php if ($row['Status'] === 'Resolved' && !empty($row['admin_reply'])): ?>
              <div class="reply-view"><strong>Reply:</strong> <?= nl2br(htmlspecialchars($row['admin_reply'])) ?></div>
            <?php endif; ?>
          </td>
          <td><span class="status <?= htmlspecialchars($row['Status']) ?>"><?= htmlspecialchars($row['Status']) ?></span></td>
          <td><?= htmlspecialchars($row['Timestamp']) ?></td>
          <td class="actions">
            <a href="mailto:<?= htmlspecialchars($row['Email']) ?>?subject=Regarding your feedback">Reply via Email</a>
            <?php if ($row['Status'] !== 'Resolved'): ?>
              <form method="POST" class="admin-reply-box">
                <input type="hidden" name="reply_id" value="<?= $row['ID'] ?>">
                <label for="admin_reply">Reply:</label>
                <textarea name="admin_reply" rows="3" placeholder="Write your reply here..." required></textarea>
                <input type="submit" value="Send Reply & Mark Resolved">
              </form>
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
