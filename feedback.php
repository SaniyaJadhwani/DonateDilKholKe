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
$popup = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $feedback = $con->real_escape_string($_POST['feedback']);

    $stmt = $con->prepare("INSERT INTO feedback (username, email, message, status, timestamp) VALUES (?, ?, ?, 'Pending', NOW())");
    $stmt->bind_param("sss", $username, $email, $feedback);
    if ($stmt->execute()) {
        // Send confirmation emails
        $user_subject = "Thank you for your feedback!";
        $user_body = "Dear $username,\n\nThank you for your valuable feedback.\n\nRegards,\nDonation Dilkholke Team";
        $admin_subject = "New Feedback Received";
        $admin_body = "User: $username\nEmail: $email\nFeedback:\n$feedback";

        @mail($email, $user_subject, $user_body);
        @mail("admin@donationdilkholke.com", $admin_subject, $admin_body);

        $popup = "success";
    } else {
        $popup = "error";
    }
}

$feedbacks = $con->query("SELECT message, timestamp, status, admin_reply FROM feedback WHERE username='$username' ORDER BY timestamp DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Feedback</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        .view-reply {
            margin-top: 10px;
            padding: 6px 12px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 13px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .view-reply:hover {
            background-color: #0056b3;
        }

        .status-badge {
            margin-top: 10px;
            font-size: 13px;
            font-weight: bold;
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            background-color: #eee;
        }

        .status-resolved {
            background-color: #c6f6d5;
            color: #276749;
        }

        .status-pending {
            background-color: #fdd;
            color: #a00;
        }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="container">
        <h2>User Feedback</h2>

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
                        <div class="status-badge <?php echo strtolower($row['status']) === 'resolved' ? 'status-resolved' : 'status-pending'; ?>">
                            <?php echo ucfirst($row['status']); ?>
                        </div>
                        <?php if (strtolower($row['status']) === 'resolved' && !empty($row['admin_reply'])): ?>
                            <button class="view-reply" data-reply="<?php echo htmlspecialchars($row['admin_reply']); ?>">
                                View Admin Reply
                            </button>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p style="color: #888;">You haven't submitted any feedback yet.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php if ($popup === "success"): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Thank you!',
            text: 'Your feedback was submitted successfully.',
            confirmButtonColor: '#800000'
        });
    </script>
    <?php elseif ($popup === "error"): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: 'Something went wrong. Please try again.',
            confirmButtonColor: '#800000'
        });
    </script>
    <?php endif; ?>

    <script>
        document.querySelectorAll('.view-reply').forEach(btn => {
            btn.addEventListener('click', () => {
                const reply = btn.getAttribute('data-reply');
                Swal.fire({
                    icon: 'info',
                    title: 'Admin Reply',
                    html: `<p style="text-align:left;">${reply}</p>`,
                    confirmButtonColor: '#800000'
                });
            });
        });
    </script>

</body>
</html>
