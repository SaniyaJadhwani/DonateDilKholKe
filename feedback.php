<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$con = new mysqli("localhost", "root", "", "donate_dilkholke");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$username = $_SESSION['username'];

// Get user email
$userQuery = $con->query("SELECT email FROM users WHERE username='$username'");
$user = $userQuery->fetch_assoc();
$email = $user['email'] ?? '';

// Feedback submission logic
$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $feedback = $con->real_escape_string($_POST['feedback']);

    $check = $con->query("SELECT * FROM feedback WHERE username='$username' AND timestamp > NOW() - INTERVAL 1 DAY");
    if ($check->num_rows > 0) {
        $message = "⚠️ You can only submit feedback once every 24 hours.";
    } else {
        $stmt = $con->prepare("INSERT INTO feedback (username, email, message, timestamp) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("sss", $username, $email, $feedback);
        if ($stmt->execute()) {
            // Send confirmation emails
            $user_subject = "Thank you for your feedback!";
            $user_body = "Dear $username,\n\nThank you for your valuable feedback.\n\nRegards,\nDonation Dilkholke Team";
            $admin_subject = "New Feedback Received";
            $admin_body = "User: $username\nEmail: $email\nFeedback:\n$feedback";

            @mail($email, $user_subject, $user_body);
            @mail("admin@donationdilkholke.com", $admin_subject, $admin_body);

            $message = "✅ Thank you for your feedback!";
        } else {
            $message = "❌ Failed to submit feedback. Please try again.";
        }
    }
}

$feedbacks = $con->query("SELECT message, timestamp FROM feedback WHERE username='$username' ORDER BY timestamp DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Feedback</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f5f5f5;
            padding: 30px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: #ffffff;
            padding: 30px 35px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
        }

        h2 {
            text-align: center;
            color: #800000;
            margin-bottom: 25px;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        textarea {
            width: 100%;
            padding: 14px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-top: 10px;
            margin-bottom: 20px;
            resize: vertical;
            font-size: 15px;
        }

        input[type="submit"] {
            background-color: #800000;
            color: #fff;
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #a00000;
        }

        .msg {
            text-align: center;
            margin-bottom: 20px;
            color: #444;
            font-weight: 600;
        }

        .feedback-history {
            margin-top: 35px;
        }

        .feedback-history h3 {
            color: #800000;
            margin-bottom: 15px;
        }

        .feedback-entry {
            background: #fafafa;
            border-left: 5px solid #800000;
            padding: 12px 18px;
            border-radius: 6px;
            margin-bottom: 15px;
            box-shadow: 0 2px 8px rgba(128, 0, 0, 0.05);
        }

        .feedback-entry span {
            font-size: 12px;
            color: #777;
            display: block;
            margin-top: 5px;
        }

        .user-info {
            margin-bottom: 20px;
            background-color: #f9f9f9;
            padding: 12px 15px;
            border-left: 4px solid #800000;
            border-radius: 6px;
        }

        .user-info strong {
            color: #800000;
        }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="container">
        <h2>User Feedback</h2>

        <?php if (!empty($message)) echo "<div class='msg'>$message</div>"; ?>

        <form method="POST">
            <div class="user-info">
                <div><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></div>
                <div><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></div>
            </div>

            <label for="feedback">Your Feedback</label>
            <textarea name="feedback" rows="5" placeholder="Write your feedback here..." required></textarea>

            <input type="submit" value="Submit Feedback">
        </form>

        <div class="feedback-history">
            <h3>Your Previous Feedback</h3>
            <?php if ($feedbacks->num_rows > 0): ?>
                <?php while ($row = $feedbacks->fetch_assoc()): ?>
                    <div class="feedback-entry">
                        <?php echo nl2br(htmlspecialchars($row['message'])); ?>
                        <span>Submitted on: <?php echo date("F j, Y, g:i a", strtotime($row['timestamp'])); ?></span>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p style="color: #888;">You haven't submitted any feedback yet.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
